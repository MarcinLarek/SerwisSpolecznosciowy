@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}"  class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">

        <div class="d-flex justify-content-between align-items-baseline">
            <div class="d-flex align-items-center pb-3">
                <div class="h4">{{$user->name}}</div>
                 <div id ="app2">
                   <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                 </div>

            </div>

            @can('update',$user->profile)
            <a href="/p/create">{{ __('profile.addpost') }}</a>
            @endcan

        </div>
         @can('update',$user->profile)
            <a href="/profile/{{ $user->id }}/edit">{{ __('profile.editprofile') }}</a>
        @endcan

        <div class="d-flex">
            <div class="pr-5"><strong>{{ $postCount }}</strong> {{ __('profile.postsnumber') }}</div>
            <div class="pr-5"><strong>{{ $followerCount }}</strong> {{ __('profile.followersnumber') }}</div>
            <div class="pr-5"><strong>{{ $followingCount }}</strong> {{ __('profile.followingnumber') }}</div>
        </div>
        <div class="pt-4"><strong>{{ $user->profile->title}}</strong></div>
        <div>{{ $user->profile->description}}</div>
        <div><a href="{{$user->profile->url}}">{{$user->profile->url}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-5">
            <a href ="/p/ {{ $post->id }}">
            <img src="/storage/{{ $post->image }}"; class="w-100">
            </a>
        </div>
        @endforeach
    </div>


</div>
@endsection
