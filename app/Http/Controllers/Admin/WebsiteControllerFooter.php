<?php

namespace App\Http\Controllers\Admin;

use App\Actions\File;
use App\Models\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WebsiteFooter;

class WebsiteControllerFooter extends Controller
{
    public function index()
    {
        $website = WebsiteFooter::first();
       //dd($website);
        return view('Backend.website_footer.index', ['navItem' => 'website_footer'], compact('website'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $web              = WebsiteFooter::find($id);
        $web->email       = $request->email;
        $web->address     = $request->address;
        $web->phone     = $request->phone;
        $web->fb     = $request->fb;
        $web->tw     = $request->tw;
        $web->ins     = $request->ins;
        $web->link     = $request->link;
        $web->footer_1     = $request->footer_1;
        $web->footer_2     = $request->footer_2;
        $web->save();
        
        session()->flash('success', 'Data Update Successfully!!');
        return redirect()->route('admin.website_footer.index');
    }
}
