<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blogpost;
use App\Models\BlogUser;
use App\Models\Btag;
use Illuminate\Http\Request;

class BlogFrontendController extends Controller
{
    public function home(){
        $posts = Blogpost::with('blogcategory', 'user')->orderBy('created_at', 'DESC')->take(5)->get();
        $firstPosts2 = $posts->splice(0, 2);
        $middlePost = $posts->splice(0, 1);
        $lastPosts = $posts->splice(0);

        $footerPosts = Blogpost::with('blogcategory', 'user')->inRandomOrder()->limit(4)->get();
        $firstFooterPost = $footerPosts->splice(0, 1);
        $firstfooterPosts2 = $footerPosts->splice(0, 2);
        $lastFooterPost = $footerPosts->splice(0, 1);

        $recentPosts = Blogpost::with('blogcategory', 'user')->orderBy('created_at', 'DESC')->paginate(9);
        return view('website.home', compact(['posts', 'recentPosts', 'firstPosts2', 'middlePost', 'lastPosts', 'firstFooterPost', 'firstfooterPosts2', 'lastFooterPost']));
    }

    public function about(){
        $user = BlogUser::first();

        return view('website.about', compact('user'));
    }
   
    public function category($slug){
        $category = BlogCategory::where('slug', $slug)->first();
        if($category){
            $posts = Blogpost::where('category_id', $category->id)->paginate(9);

            return view('website.category', compact(['category', 'posts']));
        }else {
            return redirect()->route('website');
        }
    }
   
    public function tag($slug){
        $tag = Btag::where('slug', $slug)->first();
        if($tag){
            $posts = $tag->blogposts()->orderBy('created_at', 'desc')->paginate(9);

            return view('website.tag', compact(['tag', 'posts']));
        }else {
            return redirect()->route('website');
        }
    }
   
    public function contact(){
            return view('website.contact');
    }
   
    public function post($slug){
        $post = Blogpost::with('blogcategory', 'user')->where('slug', $slug)->first();
        $posts = Blogpost::with('blogcategory', 'user')->inRandomOrder()->limit(3)->get();

        // More related posts
        $relatedPosts = Blogpost::orderBy('category_id', 'desc')->inRandomOrder()->take(4)->get();
        $firstRelatedPost = $relatedPosts->splice(0, 1);
        $firstRelatedPosts2 = $relatedPosts->splice(0, 2);
        $lastRelatedPost = $relatedPosts->splice(0, 1);

        $categories = BlogCategory::all();
        $tags = Btag::all();

        if($post){
            return view('website.post', compact(['post', 'posts', 'categories', 'tags', 'firstRelatedPost', 'firstRelatedPosts2', 'lastRelatedPost']));
        }else {
            return redirect('/');
        }
    }

    public function send_message(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'email' => 'required|email|max:200',
            'subject' => 'required|max:255',
            'message' => 'required|min:100',
        ]);

       // $contact = Contact::create($request->all());

        session()->flash('message-send', 'Contact message send successfully');
        return redirect()->back();
    }
}
