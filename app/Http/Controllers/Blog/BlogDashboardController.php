<?php

namespace App\Http\Controllers\Blog;

use App\Category;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Btag;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class BlogDashboardController extends Controller
{
    public function index(){
        // $posts = Post::orderBy('created_at', 'DESC')->take(10)->get();
        // $postCount = Post::all()->count();
        $categoryCount = BlogCategory::all()->count();
        $tagCount = Btag::all()->count();
        // $userCount = User::all()->count();


        return view('BlogAdmin.dashboard.index');
    }
}
