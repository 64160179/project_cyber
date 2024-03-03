<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminPostsController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\User;
use App\Models\Posts;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminPosts()
    {
        $posts = Posts::get(); // ดึงข้อมูลทั้งหมดจากตาราง posts ในฐานข้อมูล
        return view('admin.posts', compact('posts')); // ส่งข้อมูลไปยัง view 'admin.posts.index'
    }

    
    public function adminHome()
    {
        return view('adminHome');
    }
    public function editProfile()
    {
        return view('editProfile');
    }
    public function createImage()
    {
        return view('createImage');
    }

    public function update(Request $request, string $name)
    {
        $request->validate([
            'name' => 'required|max:255|string',

        ]);

        return redirect()->back()->with('name', 'Username has been updated');
    }

}