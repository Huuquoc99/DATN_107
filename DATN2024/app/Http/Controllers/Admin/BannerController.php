<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listBanner = Banner::paginate(5);
        return view("admin.banners.index", compact('listBanner'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.banners.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        if($request->isMethod("POST"))
        {
            $param = $request->except("_token");

            if($request->hasFile("image"))
            {
                $filepath = $request->file("image")->store("uploads/banners", "public");
            }else{
                $filepath = null;
            }
            

            $param["image"] = $filepath;
            $param['is_active'] = $request->has('is_active') ? 1 : 0;
            $banner = Banner::create($param);
            $banner->is_active == 0 ? $banner->hide() : $banner->show();
            return redirect()->route("admin.banners.index")->with("success", "Banner created successfully");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $banner = Banner::query()->findOrFail($id);
        return view("admin.banners.show", compact('banner'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view("admin.banners.edit", compact("banner"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            $request->validate([
                'title'       => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'link'        => 'required|url',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ], [
                'title.required'       => 'The title field is required.',
                'title.string'         => 'The title must be a string.',
                'title.max'            => 'The title may not be greater than 255 characters.',
                'description.string'   => 'The description must be a string.',
                'description.max'      => 'The description may not be greater than 500 characters.',
                'link.url'             => 'The link must be a valid URL.',
                'image.image'          => 'The file must be an image.',
                'image.mimes'          => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
                'image.max'            => 'The image size may not be greater than 2MB.',
            ]);

            $param = $request->except("_token", "_method");
            $banner = Banner::findOrFail($id);

            if ($request->hasFile("image")) {
                if ($banner->image && Storage::disk("public")->exists($banner->image)) {
                    Storage::disk("public")->delete($banner->image);
                }
                $filepath = $request->file("image")->store("uploads/banners", "public");
            } else {
                $filepath = $banner->image;
            }

            $param["image"] = $filepath;

            $banner->is_active = $request->has('is_active') ? 1 : 0;
            $banner->update($param);
            $banner->is_active == 0 ? $banner->hide() : $banner->show();

            return redirect()->route("admin.banners.index")->with("success", "Banner updated successfully");
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        if($banner->image && Storage::disk("public")->exists($banner->image))
        {
            Storage::disk("public")->delete($banner->image);
        }

        return redirect()->route("admin.banners.index")->with("success", "Banner deleted successfully");

    }
}
