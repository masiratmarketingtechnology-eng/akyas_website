<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'tagline',
        'file_path',
        'file_type',
        'thumbnail_path',
        'sort_order',
    ];
}
