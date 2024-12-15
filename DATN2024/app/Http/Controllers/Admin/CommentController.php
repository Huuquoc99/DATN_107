<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $comments = Comment::orderBy('created_at', 'desc')->paginate(7);  
    //     return view('admin.comments.index', compact('comments'));
    // }

    public function index(Request $request)
    {
        $query = Comment::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })
            ->orWhere('content', 'like', "%$search%");
        }

        $comments = $query->with(['user', 'product'])->paginate(10);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);
    
        if ($request->has('is_active')) {
            $request->validate([
                'is_active' => 'required|boolean',
            ]);
    
            $comment->is_active = $request->input('is_active');
        } else {
            $comment->is_active = 0;
        }
    
        $comment->save();
    
        return redirect()->route('admin.comments.index')->with('success', 'Bình luận đã được cập nhật thành công.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('admin.comments.index')->with('success', 'Bình luận đã được xóa thành công.');
    }
}
