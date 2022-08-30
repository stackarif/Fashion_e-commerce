<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Btag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class TagController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags =Btag::orderBy('created_at', 'DESC')->paginate(20);
        return view('Blogadmin.tag.index', compact('tags'),['navItem' => 'blogtag']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Blogadmin.tag.create',['navItem' => 'blogtag']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
      //dd($request);

        //validation
        // $this->validate($request, [
        //     'name' => 'required',
        // ]);

        $tag              = Btag::create();
        $tag->name        = $request->name;
        $tag->slug        = $request->name;
        $tag->description = $request->description;
        
        $tag->save();
        
        session()->flash('success', 'Data Update Successfully!!');
        return redirect(route('tag.index'),['navItem' => 'blogtag']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Btag $tag)
    {
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Btag $tag)
    {
        return view('Blogadmin.tag.edit', compact('tag'),['navItem' => 'blogtag']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Btag $tag)
    {
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name, '-');
        $tag->description = $request->description;
        $tag->save();

        session()->flash('success', 'Data Update Successfully!!');
        return redirect(route('tag.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Btag $tag)
    {
        if($tag){
            $tag->delete();

           session()->flash('success', 'Tag deleted successfully');
        }

        return redirect()->back();
    }
}
