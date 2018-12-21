@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">Search users</h1>
    <div class="col-md-6 m-auto">
        <form action="{{route('user.index')}}" id="search" class="row" method="GET">
            <input type="text" id="search-input" name="search-input" class="form-control col-md-7 mr-2">
            <input type="submit" id="search-btn" class="btn btn-outline-dark col-md-4 mb-5" value="Search">
        </form>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 row">
            
            @foreach ($users as $user)
                <div class="col-md-4 mb-5 bg-white p-4">
                    <img src="{{Route('user.image', ['image_path' => $user->image]) }}" class="profile-image-b rounded-circle">
                </div> 
                <div class="col-md-8 mb-5 bg-white p-4">
                    <a href="{{Route('user.profile', ['id' => $user->id])}}" class="text-black"><h2>{{$user->fullname}}</h2></a>
                    <p>{{'@'.$user->username}}</p>
                    <p>{{$user->biography}}</p>
                    @include('includes/follows')
                </div>
            @endforeach

        </div>
    </div>
</div>
@endsection