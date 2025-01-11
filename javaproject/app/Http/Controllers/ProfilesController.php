<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfilesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->profile->id) : false;
        $postCount = Cache::remember(
        'count.posts' . $user->id,
        now()->addSeconds(30),
        function () use ($user) {
            return $user->posts->count();
        });

        $followerCount = Cache::remember(
        'count.followers' . $user->id,
        now()->addSeconds(30),
        function () use ($user) {
            return $user->profile->followers->count();
        });

        $followingCount = Cache::remember(
        'count.following' . $user->id,
        now()->addSeconds(30),
        function () use ($user) {
            return $user->following->count();
        });


        return view('profiles.index', compact ('user', 'follows', 'postCount', 'followerCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }

     public function update(User $user)
     {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => ['required','max:100'],
            'description' => ['required','max:500'],
            'url' => ['url', 'max:1000'],
            'image' => '',

        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::read(public_path("storage/{$imagePath}"))->cover(1000, 1000);
            $image->save();


        auth()->user()->profile->update(array_merge(
            $data,
            ['image' => $imagePath]
        ));
        }

        else {
            auth()->user()->profile->update($data);
        }

        return redirect("/profile/{$user->id}");

     }

     public function findprofile()
     {
       $id = auth()->user()->profile->user_id;
       return redirect("/profile/{$id}");
     }

     public function follow (User $user){
       auth()->user()->following()->toggle($user->profile);
       return redirect()->back();
     }


}
