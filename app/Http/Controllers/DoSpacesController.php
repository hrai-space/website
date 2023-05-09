<?php

namespace App\Http\Controllers;

use App\Http\Requests\DigitalOceanDeleteRequest;
use App\Http\Requests\DigitalOceanStoreRequest;
use App\Models\Game_File;
use App\Models\Game_Image;
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

    public function store(DigitalOceanStoreRequest $request)
    {
        $request->validate([
            'avatar' => ['required', 'dimensions:width=512,height=512'],
        ]);
        $file = $request->ImageFile;
        $fileName = (string) Str::uuid();
        $folder = "images";
        Storage::disk('do')->put(
            "{$folder}/{$fileName}",
            file_get_contents($file),
            ['ACL' => 'public-read'],
        );

        $user = $request->user();
        $user->avatar = $fileName;
        $user->save();

        return Redirect::route('profile.edit');
    }

    public function storeTempFile(DigitalOceanStoreRequest $request)
    {
        if ($request->file('ImageFile') != null) {
            $files = $request->file('ImageFile');
            $folder = "images";
        } else {
            $files = $request->file('GameFile');
            $folder = "files";
        }

        $fileNames = [];

        foreach ($files as $file) {
            $fileName = (string) Str::uuid();
            Storage::disk('do')->put(
                "{$folder}/{$fileName}",
                file_get_contents($file),
                ['ACL' => 'public-read'],
            );
            if (Storage::disk('do')->exists("{$folder}/{$fileName}")) {
                $temp_file = new Temp_File();
                $temp_file->file = $fileName;
                $temp_file->save();
                array_push($fileNames, $fileName);
            } else {
                return response()->json(['errors' => 'Something went wrong, try again later']);
            }
        }

        return response()->json(['success' => $fileNames]);
    }

    public function deleteTempFile(DigitalOceanDeleteRequest $request)
    {
        $fileName = $request->validated()['FileName'];
        $folder = "images";

        Storage::disk('do')->delete("{$folder}/{$fileName}");
        //$this->cdnService->purge($fileName, $folder);

        Temp_File::where('file', $fileName)->delete();
        Game_Image::where('file', $fileName)->delete();

        return response()->json(['message' => 'File deleted'], 200);
    }

    public function deleteTempGameFile(DigitalOceanDeleteRequest $request)
    {
        $fileName = $request->validated()['FileName'];
        $folder = "files";

        Storage::disk('do')->delete("{$folder}/{$fileName}");
        //$this->cdnService->purge($fileName);

        Temp_File::where('file', $fileName)->delete();
        Game_File::where('file', $fileName)->delete();

        return response()->json(['message' => 'File deleted'], 200);
    }
}
