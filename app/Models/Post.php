<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status_published',
        'user_id',
        'post_meta'
    ];

    use HasFactory;

    public function Tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function Categorys(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_categorys', 'post_id', 'category_id');
    }

    public function PostMeta(): HasOne
    {
        return $this->hasOne(PostMeta::class, 'post_meta_id', 'id');
    }

    public function User(): HasMany
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}
