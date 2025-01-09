@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('post.store') }}" enctype="multipart/form-data" method="post">
    @csrf

    <div class="row">
        <div class="col-8 offset-2">

            <div class="row">
                <h1>{{ __('posts.addnewpost') }}</h1>
            </div>

             <div class="form-group row">
                  <label for="caption" class="col-md-4 col-form-label">{{ __('posts.postcaption') }}</label>


                      <input id="caption"
                            name="caption"
                            type="text"
                            class="form-control @error('caption') is-invalid @enderror"
                            value="{{ old('caption') }}"
                            required autocomplete="caption"
                            autofocus>

                      @error('caption')
                           <span class="invalid-feedback" role="alert">
                                           <strong>{{ $message }}</strong>
                                       </span>
                      @enderror

             </div>

             <div class="row">
                <label for="image" class="col-md-4 col-form-label">{{ __('posts.postimage') }}</label>
                <input type="file" class="form-control-file" id="image" name="image">

                 @error('image')

                                           <strong>{{ $message }}</strong>

                      @enderror
             </div>

             <div class="row pt-4">
                <button class="btn btn-primary">{{ __('posts.addnewpost') }}</button>
             </div>

        </div>
   </div>

    </form>
</div>
@endsection
