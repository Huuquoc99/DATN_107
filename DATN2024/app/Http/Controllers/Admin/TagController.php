<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.tags.';
    public function index()
    {
        $data = Tag::query()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;

        Tag::query()->create($data);

        return redirect()->route('admin.tags.index')->with("success", "Tags created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $tag = Tag::query()->findOrFail($id);

        // return view(self::PATH_VIEW . __FUNCTION__, compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = Tag::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, string $id)
    {
        $tag = Tag::query()->findOrFail($id);

        $data = $request->all();
        $data['status'] = $request->has('status') ? 1 : 0;

        $tag->update($data);

        return redirect()->route('admin.tags.index')->with("success", value: "Tags updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::query()->findOrFail($id);

        $tag->delete();

        return redirect()->route('admin.tags.index');
    }
}
