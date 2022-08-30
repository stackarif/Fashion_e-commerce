<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blogpost;
use App\Models\Btag;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class BlogDashboardController extends Controller
{
    public function index(){
        $posts = Blogpost::orderBy('created_at', 'DESC')->take(10)->get();
        $postCount = Blogpost::all()->count();
        $categoryCount = BlogCategory::all()->count();
        $tagCount = Btag::all()->count();
        $userCount = Btag::all()->count();


        return view('Blogadmin.dashboard.index',['navItem' => 'blogcdashboard'],  compact(['posts', 'postCount', 'categoryCount', 'tagCount', 'userCount']));
    }
}
