<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory, HasUuids;

    protected $table = "medias";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'media_name',
    ];
}
