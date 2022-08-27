<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Btag extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at', 'deleted_at'];

    public function blogposts(){
        return $this->belongsToMany(Blogpost::class,  'blogpost_btag', 'blogpost_id', 'btag_id');
    }

}
