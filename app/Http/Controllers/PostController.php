<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //to proteced my project by perevent user to access any page before login
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index()
    {   //to show for user his post
        //$posts = Post::where('user_id', Auth::id())->get();
        //to show for user all posts for his or anyone
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    public function postsToTrashed()
    {
        $posts = Post::onlyTrashed()->where('user_id', Auth::id())->get();
        return view('posts.trashed')->with('posts', $posts);
    }


    public function create()
    {
        $tags = Tag::all();
        if ($tags->count() == 0) {
            redirect()->route('tag.create');
        };
        return view('posts.create')->with('tags', $tags);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            //to prevent the hacker from changing the type
            'photo' => 'required |image',
            //to required tags
            'tags' => 'required',
        ]);

        //to allow the user upload the images

        $photo = $request->photo;
        //TO change the name og images
        $newPhoto = time() . $photo->getClientOriginalName();
        //to move the image in the right path
        $photo->move('uploads/posts',  $newPhoto);

        $post = Post::create([
            //to auth the id user when he login
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'photo' => 'uploads/posts/' .  $newPhoto,
            //to genrate the title randomely
            'slug' => str_slug($request->title),
        ]);
        //to allows user store the tag
        $post->tag()->attach($request->tags);

        return redirect()->back();
    }

    public function show($slug)
    {
        //to get the slug for user and show it first
        $post = Post::where('slug', $slug)->first();
        //to show tags
        $tags = Tag::all();
        return view('posts.show')->with('post', $post);
    }


    public function edit($id)
    {    //to defind the tag
        $tags = Tag::all();
        //to find the user by id
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post)->with('tags', $tags);
    }


    public function update(Request $request,  $id)
    {

        $post = Post::find($id);
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            //to prevent the hacker from changing the type
            // 'photo' => 'required |image',
        ]);
        //if user need to change the image
        if ($request->has('photo')) {
            $photo = $request->photo;
            //TO change the name og images
            $newPhoto = time() . $photo->getClientOriginalName();
            //to move the image in the right path
            $photo->move('uploads/posts',  $newPhoto);
            $post->photo = 'uploads/posts/' .  $newPhoto;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        //to allow the user update tags
        $post->tag()->sync($request->tags);
        return redirect()->back();
    }


    public function destroy($id)
    {
        //to find the user by id
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }

    public function hdelete($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        return redirect()->back();
    }
}
