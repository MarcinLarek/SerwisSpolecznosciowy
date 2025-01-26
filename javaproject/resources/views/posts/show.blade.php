@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                        <div csass="pr-3">
                            <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px">
                        </div>

                        <div>
                            <div class="font-weight-bold">
                            <a href="/profile/{{ $post->user->id }}">
                            <span class="text-dark">
                            {{ $post->user->username }}
                            </span>
                            </a>
                            @if($follows)
                            <a href="/follow/{{ $post->user->id }}" class="pl-3">{{ __('posts.unfollow') }}</a>
                            @else
                            <a href="/follow/{{ $post->user->id }}" class="pl-3">{{ __('posts.follow') }}</a>
                            @endif
                            </div>
                        </div>
                </div>

                <hr>

                <p><span class="font-weight-bold">
                <a href="/profile/{{ $post->user->id }}">
                <span class="text-dark">
                {{ $post->user->username }}
                </span>
                </a>
                </span>
                {{ $post->caption }}
                </p>

                <hr>
            </div>
            <form action="/p/{{$post->id}}/comment" enctype="multipart/form-data" method="post">
              @csrf
            <div class="form-group row pt-2">
              <label for="description"><b>{{ Auth::user()->username }}</b></label>
                <p><input type="textfield" class="form-control" name="description" placeholder="{{ __('posts.comment') }}"></p>
                <button class="pull-right btn btn-sm btn-primary">{{ __('posts.publish') }}</button>
                @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="row pt-2">
              <div class="pb-1">
                @foreach($comments as $comment)
                <a href="/profile/{{ $comment->getUser()->id }}"><b>{{$comment->getUser()->username}}</b></a> </br>
                {{$comment->description}}
                @endforeach
              </div>
            </div>

          </form>
        </div>
    </div>
</div>
@endsection
