<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blogpost;
use App\Models\Btag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class BlogpostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Blogpost::orderBy('created_at', 'DESC')->paginate(20);
        //dd($posts);
        return view('BlogAdmin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Btag::all();
        $categories = BlogCategory::all();
        return view('Blogadmin.post.create', compact(['categories', 'tags']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request); 
        $this->validate($request, [
            'title' => 'required|unique:blogposts,title',
            'image' => 'required|image',
            'description' => 'required',
            'category' => 'required',
        ]);

        $post = Blogpost::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => 'image.jpg',
            'description' => $request->description,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id,
            'published_at' => Carbon::now(),
        ]);

        $post->btags()->attach($request->tags);

        if($request->hasFile('image')){
            $image = $request->image;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/post/', $image_new_name);
            $post->image = '/storage/post/' . $image_new_name;
            $post->save();
        }

        session()->flash('success', 'Post created successfully');
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Blogpost $post)
    {
        $post = Blogpost::all();
        return view('BlogAdmin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Blogpost $post)
    {
        ///$post = Blogpost::all();
        $tags = Btag::all();
        $categories = BlogCategory::all();
        return view('BlogAdmin.post.edit', compact(['post', 'categories','tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blogpost $post)
    {
        $this->validate($request, [
            'title' => "required|unique:blogposts,title, $post->id",
            'description' => 'required',
            'category' => 'required',
        ]);
        
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->category_id = $request->category;

        $post->btags()->attach($request->tags);

        if($request->hasFile('image')){
            $image = $request->image;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/post/', $image_new_name);
            $post->image = '/storage/post/' . $image_new_name;
        }

        $post->save();

        session()->flash('success', 'Post updated successfully');
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogpost $post)
    {
        if($post){
            if(file_exists(public_path($post->image))){
                unlink(public_path($post->image));
            }

            $post->delete();
            session()->flash('success', 'Category deleted successfully');
        }

        return redirect()->back();
    }
}
