<?php

namespace App\Http\Controllers\Client;

use App\Models\Comment;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'destroy']]);
    }

    public function canRateProduct($productVariantId, $userId) {
        $orderItem = OrderItem::where('product_variant_id', $productVariantId)
            ->whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->where('status_order_id', 5);
            })
            ->exists();

        return $orderItem;
    }

    public function storeAjax()
    {
        $data = request()->validate([
            'content' => 'required|string',
            'rate' => 'nullable|integer|min:1|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        $user = auth()->user();
        $canRate = false;

        $product = Product::find($data['product_id']);

        if ($user) {
            $firstVariant = $product->variants->first();
            $canRate = $this->canRateProduct($firstVariant->id, $user->id);
        }

        $comment = new Comment();
        $comment->content = $data['content'];
        $comment->product_id = $data['product_id'];
        $comment->user_id = auth()->id();
        $comment->rate = $data['rate'] ?? null;
        $comment->is_active = true;

        $comment->save();


        $html = view('client.comment-detail', [
            'comment' => $comment,
            'canRate' => $canRate
        ])->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    public function updateAjax($id)
    {
        $data = request()->validate([
            'content' => 'required|string',
            'rate' => 'nullable|integer|min:1|max:5',
        ]);

        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found',
            ], 404);
        }

        if ($comment->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'You do not have permission to update this comment',
            ], 403);
        }
        $canRate = false;

        if (isset($data['product_id'])) {
            $product = Product::find($data['product_id']);
            if ($product) {
                $user = auth()->user();
                if ($user) {
                    $firstVariant = $product->variants->first();
                    $canRate = $this->canRateProduct($firstVariant->id, $user->id);
                }
            }
        }

        $comment->content = $data['content'];
        $comment->rate = $data['rate'];

        $comment->save();

        $html = view('client.comment-detail', [
            'comment' => $comment,
            'canRate' => $canRate
        ])->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    public function destroyAjax($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found',
            ], 404);
        }

        if ($comment->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'You do not have permission to delete this comment',
            ], 403);
        }

        try {
            $comment->delete();

            return response()->json([
                'message' => 'Comment deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred, unable to delete comment',
            ], 500);
        }
    }

    public function showAjax($id)
    {
        $comment = Comment::where('id', $id)
            ->where('is_active', 1)
            ->first();


        if (!$comment) {
            return response()->json([
                'message' => 'Comment not found',
            ], 404);
        }

        if ($comment->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'You do not have permission to delete this comment',
            ], 403);
        }

        return response()->json([
            'comment' => [
                'id' => $comment->id,
                'content' => $comment->content,
                'rate' => $comment->rate,
                'product_id' => $comment->product_id,
                'user_id' => $comment->user_id,
                'is_active' => $comment->is_active,
                'created_at' => $comment->created_at,
                'user_name' => $comment->user->name,
                'avatar' => $comment->user->avatar ? asset('storage/' . $comment->user->avatar) : asset('theme/admin/assets/images/default-avatar.png'),
            ],
        ], 200);
    }

    public function indexAjax(Request $request, $id)
    {
        $comments = Comment::with('user')
            ->where('product_id', $id)
            ->where('is_active', 1)
            ->paginate(2);

        $html = '';
        foreach ($comments as $comment) {
            $html .= view('client.comment-detail', [
                'comment' => $comment,
            ])->render();
        }
        if ($request->ajax()) {
            return response()->json([
                'html' => $html,
                'hasMore' => $comments->hasMorePages()
            ]);
        }

        return view('client.list-comment', [
            'productId' => $id,
            'comments' => $comments,
        ]);
    }


}
