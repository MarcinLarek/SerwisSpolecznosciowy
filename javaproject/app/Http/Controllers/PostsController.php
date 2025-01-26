<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Post;
use App\Models\Comment;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ()
    {
        $posts = Post::latest()->paginate(5);
        //dd($posts);
        return view('posts.index', compact('posts'));
    }

   public function create()
   {
       return view('posts.create');
   }

   public function store()
   {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image', 'max:5000'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::read(public_path("storage/{$imagePath}"));//->fit(1200, 1200);
        $image->cover(1200, 1200);
        //dd($image);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
   }

    public function show(\App\Models\Post $post)
    {
      $comments = $post->comments();
      $follows = (auth()->user()) ? auth()->user()->following->contains($post->user->profile->id) : false;
        return view ('posts.show', compact('post', 'follows', 'comments'));
    }

    public function following()
    {
      $users = auth()->user()->following()->pluck('profiles.user_id');
      $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
      return view('posts.index', compact('posts'));
    }

    public function comment(Post $post){
        $description = request()->validate([
            'description' => ['required', 'max:1000'],
        ]);

        $comment = new Comment;
        $comment->fill([
            'description' => request()->description,
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
        ]);
        $comment->save();
        return redirect()->back();
        }
}
