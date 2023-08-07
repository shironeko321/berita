<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    protected $table = 'post_metas';
    protected $fillable = [
        'key_meta',
        'content'
    ];

    use HasFactory;
}
