<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;

class DOCdnService implements CdnService
{

    public function purge($fileName, $folder)
    {
        Http::asJson()->delete(
            config('filesystems.do.cdn_endpoint') . '/cache',
            [
                'files' => ["{$folder}/{$fileName}"],
            ]
        );
    }
}