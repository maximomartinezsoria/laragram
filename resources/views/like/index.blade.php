@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

        <div class="card-header bg-primary text-white mb-4">
            <h2 class="m-0">Liked images</h2>
        </div>

        @include('includes/message')

        @foreach($likes as $like)
            @include('includes.image', ['image' => $like->image])
        @endforeach
        </div>
    </div>
</div>
@endsection