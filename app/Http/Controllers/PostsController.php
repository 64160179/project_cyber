<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Posts;
use App\Models\Comment;

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

        $path = ''; // Initialize path as empty string
        $filename = ''; // Initialize filename as empty string

        if($request->hasFile('post_pic')){

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
    
        if($request->hasFile('post_pic')){
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
        ]);

        $updateData = [
            'topic' => $request->topic,
            'details' => $request->details,
        ];
    
        if(isset($filename)){
            $updateData['post_pic'] = $path.$filename;
        }
    
        $posts->update($updateData);
        

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

    public function comment(Posts $post)
    {
        $comments = $post->comments; // ดึงความคิดเห็นของโพสต์ที่กำหนดมา
        return view('posts.comment', compact('comments')); // แก้เป็น 'comments' แทน 'comment'
    }

    public function searchpost()
    {
        $search_text = $_GET['query'];
        $posts = Posts::where('topic', 'LIKE', '%' . $search_text . '%')
              ->orWhere('users_name', 'LIKE', '%' . $search_text . '%')
              ->get();


        return view('posts.index',compact('posts'));
    }

}
