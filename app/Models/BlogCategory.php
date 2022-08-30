<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'deleted_at', 'updated_at'];

    public function blogposts(){
        return $this->hasMany(Blogpost::class ,'category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function children()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

}
