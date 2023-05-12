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
        return view('profile.forum.form')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleUploadRequest $request)
    {
        $forum = new Article();
        $forum->user_id = $request->user()->id;
        $forum->title = $request->title;
        $forum->content = $request->content;
        $forum->category_id = $request->category;

        $forum->save();
        return redirect()->route('dashboard.articles');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $forum)
    {
        $key = 'articleKey_' . $forum->id;
        if (!session()->has($key)) {
            $forum->views = $forum->views + 1;
            $forum->save();
            $view = new Article_View();
            $view->article_id = $forum->id;
            $view->save();
            session()->put($key, 1);
            session()->save();
        }

        return view('forum.article')->with('article', $forum);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $forum)
    {
        $categories = Article_Category::all();
        return view('profile.articles.form')->with('article', $forum)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUploadRequest $request, Article $forum)
    {
        $forum->title = $request->title;
        $forum->content = $request->content;
        $forum->category_id = $request->category;
        $forum->save();
        return redirect()->route('dashboard.articles');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $forum)
    {
        $forum->delete();
        return redirect()->route('dashboard.articles');
    }
}