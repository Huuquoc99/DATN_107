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

    public function index($productId)
    {
        $product = Product::find($productId);
        $comments = Comment::where('product_id', $productId)->get();

        return view('comments.index', compact('product', 'comments'));
    }

    public function store(Request $request, $productId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->product_id = $productId;
        $comment->user_id = auth()->id();
        $comment->is_active = true; 

        $comment->save();

        return redirect()->route('comments.index', ['productId' => $productId])
                         ->with('message', 'Bình luận đã được gửi thành công!');
    }

    public function edit($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('comments.index', ['productId' => $comment->product_id])
                             ->with('error', 'Bình luận không tìm thấy');
        }

        if ($comment->user_id != auth()->id()) {
            return redirect()->route('comments.index', ['productId' => $comment->product_id])
                             ->with('error', 'Bạn không có quyền sửa bình luận này');
        }

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('comments.index', ['productId' => $comment->product_id])
                             ->with('error', 'Bình luận không tìm thấy');
        }

        if ($comment->user_id != auth()->id()) {
            return redirect()->route('comments.index', ['productId' => $comment->product_id])
                             ->with('error', 'Bạn không có quyền sửa bình luận này');
        }

        $comment->content = $request->content;
        $comment->save();

        return redirect()->route('comments.index', ['productId' => $comment->product_id])
                         ->with('message', 'Bình luận đã được cập nhật!');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return redirect()->route('comments.index', ['productId' => $comment->product_id])
                             ->with('error', 'Bình luận không tìm thấy');
        }

        if ($comment->user_id != auth()->id()) {
            return redirect()->route('comments.index', ['productId' => $comment->product_id])
                             ->with('error', 'Bạn không có quyền xóa bình luận này');
        }

        $comment->delete();

        return redirect()->route('comments.index', ['productId' => $comment->product_id])
                         ->with('message', 'Bình luận đã bị xóa!');
    }
}
