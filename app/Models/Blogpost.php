<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogpost extends Model
{
    use HasFactory;
    protected $guarded = ['created_at','updated_at'];

    protected $dates = [
        'published_at',
    ];
    public function Blogcategory(){
        return $this->belongsTo(BlogCategory::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo('App\User');
    // }

    public function btags()
    {
        return $this->belongsToMany(Btag::class,  'blogpost_btag', 'blogpost_id', 'btag_id');
    }

}
