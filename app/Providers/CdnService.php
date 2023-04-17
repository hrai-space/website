<?php

namespace App\Providers;

interface CdnService
{
    public function purge($fileName, $folder);
}