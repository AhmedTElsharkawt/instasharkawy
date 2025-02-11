<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Set variable data
        $input = $request->except('image');

        // Validation
        $request->validate([
            "title" => "required",
        ]);

        // Upload image
        if($request->hasFile('image'))
        {
            $imageFile = $request->image;
            $imageExtension = $imageFile->getClientOriginalExtension();
            $newImageName = date('Y-m-d-') . uniqid() . '.' . $imageExtension;
            $imageFile->move('images/', $newImageName);
            $path = "images/$newImageName";
            $input['image'] = $path;
        }

        // Create data
        Post::create($input);

        // Redirect
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Comment $comment, $id)
    {
        $post = Post::find($id);
        $comments = Comment::where([
            ['user_id', '=', Auth::user()->id],
            ['post_id', '=', $post->id]
        ])->get();

        return view('posts.show',compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post, $id)
    {
        $input = $request->all();

        Post::find($id)->update($input);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, $id)
    {
        $post->find($id)->delete();

        return redirect(route('home'));
    }
}
