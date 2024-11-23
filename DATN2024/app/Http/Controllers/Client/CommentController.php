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

//    public function index($productId)
//    {
//        $product = Product::find($productId);
//        $comments = Comment::where('product_id', $productId)->get();
//
//        return view('client.product-detail', compact('product', 'comments'));
//    }
//
//    public function store(Request $request, $productId)
//    {
//        $request->validate([
//            'content' => 'required|string',
//        ]);
//
//        $comment = new Comment();
//        $comment->content = $request->content;
//        $comment->product_id = $productId;
//        $comment->user_id = auth()->id();
//        $comment->is_active = true;
//        $comment->save();
//
//        $product = Product::find($productId);
//
//        return redirect()->route('product.detail', ['slug' => $product->slug])
//            ->with('message', 'Bình luận đã được gửi thành công!');
//    }
//
//    public function edit($id)
//    {
//        $comment = Comment::find($id);
//
//        if (!$comment) {
//            return redirect()->route('comments.index', ['productId' => $comment->product_id])
//                ->with('error', 'Bình luận không tìm thấy');
//        }
//
//        if ($comment->user_id != auth()->id()) {
//            return redirect()->route('comments.index', ['productId' => $comment->product_id])
//                ->with('error', 'Bạn không có quyền sửa bình luận này');
//        }
//
//        return view('comments.edit', compact('comment'));
//    }
//
//    public function update(Request $request, $id)
//    {
//        $request->validate([
//            'content' => 'required|string',
//        ]);
//
//        $comment = Comment::find($id);
//
//        if (!$comment) {
//            return redirect()->route('comments.index', ['productId' => $comment->product_id])
//                ->with('error', 'Bình luận không tìm thấy');
//        }
//
//        if ($comment->user_id != auth()->id()) {
//            return redirect()->route('comments.index', ['productId' => $comment->product_id])
//                ->with('error', 'Bạn không có quyền sửa bình luận này');
//        }
//
//        $comment->content = $request->content;
//        $comment->save();
//
//        return redirect()->route('comments.index', ['productId' => $comment->product_id])
//            ->with('message', 'Bình luận đã được cập nhật!');
//    }
//
//    public function destroy($id)
//    {
//        $comment = Comment::find($id);
//
//        if (!$comment) {
//            return redirect()->route('comments.index', ['productId' => $comment->product_id])
//                ->with('error', 'Bình luận không tìm thấy');
//        }
//
//        if ($comment->user_id != auth()->id()) {
//            return redirect()->route('comments.index', ['productId' => $comment->product_id])
//                ->with('error', 'Bạn không có quyền xóa bình luận này');
//        }
//
//        $comment->delete();
//
//        return redirect()->route('comments.index', ['productId' => $comment->product_id])
//            ->with('message', 'Bình luận đã bị xóa!');
//    }

    public function storeAjax()
    {
//        dd(1);
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
