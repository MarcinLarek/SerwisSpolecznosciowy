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
                </span>
                {{ $post->caption }}
                </p>

                <hr>
            </div>
            <form action="/p/{{$post->id}}/comment" enctype="multipart/form-data" method="post">
              @csrf
            <div class="form-group row pt-2">
                <input type="textfield" class="form-control" name="description" placeholder="{{ __('posts.comment') }}"></br>
                <button class="pull-right btn btn-sm btn-primary">{{ __('posts.publish') }}</button>
                @error('description')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            </form>

            <div class="lead">
              <hr>
              {{ __('posts.comments') }}
            </div>

            <div class="pt-2">
              @foreach($comments as $comment)
              <div class="pb-3">
                <span><a href="/profile/{{ $comment->getUser()->id }}"><b>{{$comment->getUser()->username}}</b></a> </span>
                <span></br>{{$comment->description}}</span>
              </div>
              @endforeach
            </div>


        </div>
    </div>
</div>
@endsection
