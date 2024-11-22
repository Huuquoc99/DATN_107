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

    public function store()
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

    
}
