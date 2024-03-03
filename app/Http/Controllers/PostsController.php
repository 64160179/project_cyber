<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Posts;

class PostsController extends Controller
{
    // Create Index
    public function index()
    {
        $posts = Posts::get();
        return view('posts.index', compact('posts'));   
    }

    // Create Post
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'topic' => 'required|max:100|string',
            'details' => 'required',
            'post_pic' => 'nullable|image|mimes:jpeg,png,jpg',

        ]);

        if($request->has('post_pic')){

            $file = $request->file('post_pic');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'uploads/posts/';
            $file->move($path, $filename);
        }

        Posts::create([
            'topic' => $request->topic,
            'details' => $request->details,
            'post_pic' => $path.$filename,
            'users_id' => auth()->user()->id,
            'users_name' => auth()->user()->name,
        ]);

        return redirect('posts/create')->with('status','Posts Created Successfully');

        
    }

    public function edit(int $id)
    {
        $posts = Posts::findOrFail($id);
        return view('posts.edit', compact('posts'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'topic' => 'required|max:100|string',
            'details' => 'required',
            'post_pic' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);

        $posts = Posts::findOrFail($id);

        if($request->has('post_pic')){

            $file = $request->file('post_pic');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'uploads/posts/';
            $file->move($path, $filename);

            if(File::exists($posts->post_pic)){
                File::delete($posts->post_pic);
            }
        }

        $posts->update([
            'topic' => $request->topic,
            'details' => $request->details,
            'post_pic' => $path.$filename,
        ]);

        return redirect()->back()->with('status','Post Update');
    }

    public function destroy(int $id)
    {
        $posts = Posts::findOrFail($id);
        if(File::exists($posts->image)){
            File::delete($posts->image);
        }

        $posts->delete();

        return redirect()->back()->with('status','Posts Deleted');
    }
}
