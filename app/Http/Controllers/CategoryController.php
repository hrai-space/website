<?php

namespace App\Http\Controllers;

use App\Models\Article_Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Article_Category::get();
        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Article_Category();
        $category->name = $request->name;
        $category->save();

        return redirect(route('category.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Article_Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article_Category $category)
    {
        return view('admin.categories.form')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article_Category $category)
    {
        $category->name = $request->name;
        $category->save();

        return redirect(route('category.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article_Category $category)
    {
        $category->delete();
        return redirect(route('category.index'));
    }
}
