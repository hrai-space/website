<?php

namespace App\Http\Controllers;

use App\Http\Requests\DigitalOceanDeleteImageRequest;
use App\Http\Requests\DigitalOceanStoreImageRequest;
use App\Http\Requests\DigitalOceanStoreTempImageRequest;
use App\Models\Temp_File;
use App\Providers\CdnService as ProvidersCdnService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DoSpacesController extends Controller
{
    private $cdnService;

    public function __construct(ProvidersCdnService $cdnService)
    {
        $this->cdnService = $cdnService;
    }

    public function store(DigitalOceanStoreImageRequest $request)
    {
        $file = $request->ImageFile;
        $fileName = (string) Str::uuid();
        $folder = "images";
        Storage::disk('do')->put(
            "{$folder}/{$fileName}",
            file_get_contents($file),['ACL' => 'public-read'],
        );

        $user = $request->user();
        $user->avatar = $fileName;
        $user->save();

        return Redirect::route('profile.edit');
    }

    public function storeTempFile(DigitalOceanStoreTempImageRequest $request)
    {
        $files = $request->file('ImageFile');
        $fileNames = [];

        foreach($files as $file){
            $fileName = (string) Str::uuid();
            $folder = "images";
            Storage::disk('do')->put(
                "{$folder}/{$fileName}",
                file_get_contents($file),['ACL' => 'public-read'],
            );
            
            $temp_file = new Temp_File();
            $temp_file->file = $fileName;
            $temp_file->save();
            array_push($fileNames, $fileName);
        }


        return response()->json(['success'=>$fileNames]);
    }

    public function delete(DigitalOceanDeleteImageRequest $request)
    {
        $fileName = $request->validated()['ImageFileName'];
        $folder = "images";

        Storage::disk('do')->delete("{$folder}/{$fileName}");
        $this->cdnService->purge($fileName);

        return response()->json(['message' => 'File deleted'], 200);
    }
}
