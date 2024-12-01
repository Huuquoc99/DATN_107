<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalogue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogueRequest;
use Illuminate\Support\Facades\Storage;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listCatalogue = Catalogue::withCount("products")->orderBy('created_at', 'desc')->paginate(7);
        return view("admin.catalogues.index", compact('listCatalogue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.catalogues.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatalogueRequest $request)
    {
        if ($request->isMethod("POST")) {
            $param = $request->except("_token");

            if ($request->hasFile("cover")) {
                $filepath = $request->file("cover")->store("uploads/catalogues", "public");
            } else {
                $filepath = null;
            }

            $param["cover"] = $filepath;
            $param['is_active'] = $request->has('is_active') ? 1 : 0;
            $catalogue = Catalogue::create($param);
            // $catalogue->is_active == 0 ? $catalogue->hide() : $catalogue->show();

            return redirect()->route("admin.catalogues.index")->with("success", "Catalogue created successfully");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $catalogue = Catalogue::query()->findOrFail($id);
        return view("admin.catalogues.show", compact('catalogue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $catalogue = Catalogue::findOrFail($id);
        return view("admin.catalogues.edit", compact("catalogue"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CatalogueRequest $request, string $id)
    {
        if ($request->isMethod("PUT")) {
            $param = $request->except("_token", "_method");
            $catalogue = Catalogue::findOrFail($id);
            if ($request->hasFile("cover")) {
                if ($catalogue->cover && Storage::disk("public")->exists($catalogue->cover)) {
                    Storage::disk("public")->delete($catalogue->cover);
                }
                $filepath = $request->file("cover")->store("uploads/catalogues", "public");
            } else {
                $filepath = $catalogue->cover;
            }

            $param["cover"] = $filepath;
            $catalogue->is_active = $request->has('is_active') ? 1 : 0;
            $catalogue->update($param);

            // $catalogue->is_active == 0 ? $catalogue->hide() : $catalogue->show();
            return redirect()->route("admin.catalogues.index")->with("success", "Catalogue updated successfully");

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catalogue = Catalogue::findOrFail($id);
        $catalogue->delete();
        if ($catalogue->cover && Storage::disk("public")->exists($catalogue->cover)) {
            Storage::disk("public")->delete($catalogue->cover);
        }

        return redirect()->route("admin.catalogues.index")->with("success", "Catalogue deleted successfully");

    }
}
