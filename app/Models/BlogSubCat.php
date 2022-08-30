<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogSubCat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
