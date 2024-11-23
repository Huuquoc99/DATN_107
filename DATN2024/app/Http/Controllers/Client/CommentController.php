<?php

namespace App\Http\Controllers\Client;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['edit', 'destroy']]);
    }

    public function storeAjax()
    {
        //    dd(1);
        $data = request()->validate([
            'content' => 'required|string',
            'rate' => 'required|integer|min:1|max:5',
            'product_id' => 'required|exists:products,id',
        ]);

        if ($data['rate'] == 0) {
            return response()->json([
                'error' => 'Rating cannot be zero. Please provide a rating between 1 and 5.',
            ], 422);
        }

        $comment = new Comment();
        $comment->content = $data['content'];
        $comment->product_id = $data['product_id'];
        $comment->user_id = auth()->id();
        $comment->rate = $data['rate'];
        $comment->is_active = true;

        $comment->save();


        $html = view('client.comment-detail', [
            'comment' => $comment,
        ])->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    public function updateAjax($id)
    {
        $data = request()->validate([
            'content' => 'required|string',
            'rate' => 'required|integer|min:1|max:5',
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

        $comment->content = $data['content'];
        $comment->rate = $data['rate'];

        $comment->save();

        $html = view('client.comment-detail', [
            'comment' => $comment,
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
        $comments = Comment::with('user')->where('product_id', $id)
            ->where('is_active', true)
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
