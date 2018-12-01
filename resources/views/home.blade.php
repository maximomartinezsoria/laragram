@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        @include('includes/message')

        @if($images)
            @foreach($images as $image_object)
                @foreach($image_object as $image)
                    @include('includes/image')
                @endforeach
            @endforeach
        @else
            <h2 class="text-center mt-5">Your followings don´t have images. <br> Start following people <a class="text-primary" href="{{Route('user.index')}}">here</a>.</h2>
        @endif
        </div>
    </div>
</div>
@endsection
