<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleUploadRequest;
use App\Models\Article;
use App\Models\Article_Category;
use App\Models\Article_View;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Article_Category::all();
        return view('profile.articles.form')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleUploadRequest $request)
    {
        $article = new Article();
        $article->user_id = $request->user()->id;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category;

        $article->save();
        return redirect()->route('dashboard.articles');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $key = 'articleKey_' . $article->id;
        if (!session()->has($key)) {
            $article->views = $article->views + 1;
            $article->save();
            $view = new Article_View();
            $view->article_id = $article->id;
            $view->save();
            session()->put($key, 1);
            session()->save();
        }

        return view('article')->with('article', $article);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $categories = Article_Category::all();
        return view('profile.articles.form')->with('article', $article)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUploadRequest $request, Article $article)
    {
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category;
        $article->save();
        return redirect()->route('dashboard.articles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('dashboard.articles');
    }
}