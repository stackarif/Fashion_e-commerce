<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\BlogUser;
use Illuminate\Http\Request;

class BlogUserController extends Controller
{
    public function index(){
        $users = BlogUser::latest()->paginate(20);

        return view('Blogadmin.user.index', compact('users'),['navItem' => 'bloguser']);
    }

    public function create(){
        return view('Blogadmin.user.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:blog_users,email',
            'password' => 'required|min:8',
        ]);

        $user = BlogUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'description' => $request->description,
        ]);

        session()->flash('success', 'User created successfully');
        return redirect()->back();
    }

    public function edit(BlogUser $user){
        return view('admin.user.edit', compact('user'),['navItem' => 'bloguser']);
    }

    public function update(Request $request, BlogUser $user){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:blog_users,email, $user->id",
            'password' => 'sometimes|nullable|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->description = $request->description;
        $user->save();

        session()->flash('success', 'User updated successfully');
        return redirect()->back();
    }

    public function destroy(BlogUser $user){
        if($user){
            $user->delete();
            session()->flash('success', 'User deleted successfully');
        }
        return redirect()->back();
    }

    public function profile(){
        $user = auth()->user();

        return view('Blogadmin.user.profile', compact('user'),['navItem' => 'bloguser']);
    }

    public function profile_update(Request $request){
        $user = auth()->user();

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:blog_users,email, $user->id",
            'password' => 'sometimes|nullable|min:8',
            'image'=> 'sometimes|nullable|image|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->description = $request->description;

        if($request->has('password') && $request->password !== null){
            $user->password = bcrypt($request->password);
        }

        if($request->hasFile('image')){
            $image = $request->image;
            $image_new_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move('storage/user/', $image_new_name);
            $user->image = '/storage/user/' . $image_new_name;
        }
       // $user->save();

        session()->flash('success', 'User profile updated successfully');
        return redirect()->back();
    }
}
