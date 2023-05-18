<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::get();
        return view('admin.banners.index')->with('banners', $banners);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $banner = new Banner();
        $banner->title = $request->title;
        $banner->link = $request->link;
        $banner->description = $request->description;

        $file = $request->file;
        if($file != null){
            $fileName = (string) Str::uuid();
            $folder = "images";
            Storage::disk('do')->put(
                "{$folder}/{$fileName}",
                file_get_contents($file),
                ['ACL' => 'public-read'],
            );
            $banner->file = $fileName;
        }
        
        $banner->save();

        return redirect(route('banner.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.form')->with('banner', $banner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $banner->title = $request->title;
        $banner->link = $request->link;
        $banner->description = $request->description;
        $file = $request->file;
        if($file != null){
            $fileName = (string) Str::uuid();
            $folder = "images";
            Storage::disk('do')->put(
                "{$folder}/{$fileName}",
                file_get_contents($file),
                ['ACL' => 'public-read'],
            );
            $banner->file = $fileName;
        }
        
        $banner->save();

        return redirect(route('banner.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect(route('banner.index'));
    }
}
