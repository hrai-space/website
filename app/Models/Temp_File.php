<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_File extends Model
{
    use HasFactory;

    protected $fillable = ['file'];
}
