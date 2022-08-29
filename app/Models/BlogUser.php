<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogUser extends Model
{
    use HasFactory;
    public function blogposts(){
        return $this->hasOne(Blogpost::class ,'category_id');
    }

}
