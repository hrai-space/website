<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleUploadRequest;
use App\Http\Requests\CommentRequest;
use App\Models\Article;
use App\Models\Article_Category;
use App\Models\Article_View;
use App\Models\Comment;
use App\Models\Comment_Like;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
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
    public function create(Article_Category $category)
    {
        return view('forum.post')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleUploadRequest $request)
    {
        $post = new Article();
        $post->user_id = $request->user()->id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category;

        $post->save();
        $client = new Client();
        $URI = 'https://clownfish-app-ke89z.ondigitalocean.app/newart';
        $params['query'] = array('id' => $post->id, 'name' => $post->title, 'url' => route('forum.show', $post->id));
        
        try {
            $response = $client->post($URI, $params);   
        }
        catch (ServerException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
        }
        return redirect()->route('forum.show', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $post)
    {
        $key = 'articleKey_' . $post->id;
        if (!session()->has($key)) {
            $post->views = $post->views + 1;
            $post->save();
            $view = new Article_View();
            $view->article_id = $post->id;
            $view->save();
            session()->put($key, 1);
            session()->save();
        }

        return view('forum.post')->with('post', $post)->with('category', $post->category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $post)
    {
        return view('forum.post')->with('post', $post)->with('category', $post->category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUploadRequest $request, Article $post)
    {
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category;
        $post->save();
        $client = new Client();
        $URI = 'https://clownfish-app-ke89z.ondigitalocean.app/redart';
        $params['query'] = array('id' => $post->id, 'name' => $post->title, 'url' => route('forum.show', $post->id));
        
        try {
            $response = $client->post($URI, $params);   
        }
        catch (ServerException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
        }
        return redirect()->route('forum.show', $post);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $post)
    {
        $post->delete();
        return redirect()->route('forum');
    }

    public function storeComment(CommentRequest $request)
    {
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->parent_id = $request->parent_id;
        $comment->user_id = auth()->user()->id;
        $comment->text = $request->text;
        $comment->save();

        return back();
    }

    public function like(Request $request){
        $comment = Comment::where('id', $request->comment)->first();
        $like = Comment_Like::where('comment_id', $request->comment)->where('user_id', auth()->user()->id)->first();
        if($like != null){
            $like->delete();
            $comment->likes = $comment->likes - 1;
            $comment->save();
            return ['state' => '0', 'likes' => $comment->likes];
        }
        $comment->likes = $comment->likes + 1;
        $like = new Comment_Like();
        $like->user_id = $request->user()->id;
        $like->comment_id = $request->comment;
        $like->save();
        $comment->save();
        return ['state' => '1', 'likes' => $comment->likes];
    }
}