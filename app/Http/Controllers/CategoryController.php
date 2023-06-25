<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query()->paginate(10);

        return $request->wantsJson() ? $categories : Inertia::render('Category/List', ["categories" => $categories]);
    }

    public function store(CategoryRequest $request)
    {
        Category::firstOrCreate([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'organization_id' => $request->organization_id,
            'description' => $request->description,
            'photo' => $request->photo,
        ]);

        return redirect()->back();
    }

    public function show($id)
    {
        $category = Category::query()->find($id);

        return Inertia::render('Category/Detail', ["category" => $category]);
    }

    public function update(CategoryRequest $request)
    {
        $category = Category::query()->find($request->id);

        $category->update([
            "name" => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'organization_id' => $request->organization_id,
            'description' => $request->description,
            'photo' => $request->photo,
        ]);

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $category = Category::query()->find($request->id);
        $category->delete();

        return redirect()->back();
    }
}
