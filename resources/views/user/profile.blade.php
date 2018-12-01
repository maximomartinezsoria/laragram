@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 row justify-content-center mt-3">
            <div class="col-md-4">
                <img src="{{Route('user.image', ['image_path' => $user->image]) }}" class="profile-image-b rounded-circle">
            </div> 
            
            <div class="col-md-8 mb-3">
                <h2>{{$user->fullname}}</h2>
                <p>{{'@'.$user->username}}</p>
                <p><strong>{{count($followers)}}</strong> Followers <strong>{{count($following)}}</strong> Following</p>
                
                @if($user->biography)
                    <p>{{$user->biography}}</p>
                @elseif(Auth::user()->id == $user->id)
                    <p>Complete your biography <a class="text-primary" href="{{Route('user.edit_profile')}}">here</a>.</p>
                @endif
                
                @include('includes/follows')
                @if(Auth::user()->id == $user->id)
                    <a href="{{route('user.edit_profile')}}" class="btn btn-outline-dark">Edit profile</a>
                    <button class="btn btn-outline-dark" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                @endif
            </div>
        </div>

            
        </div>

        <div class="col-md-4 mb-5"></div>
        
        <div class="col-md-8 m-auto">
            @include('includes/message')
            @if(count($user->images) >= 1)
                @foreach($user->images as $image)
                    @include('includes/image')
                @endforeach
            @else
                @if(Auth::user()->id == $user->id)
                    <h2 class="text-center">You dont have any image. <a class="text-primary" href="{{route('new.image')}}">Upload it.</a></h2>
                @else
                    <h2 class="text-center">{{$user->fullname}} doesn´t have any image</h2>
                @endif
            @endif
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@endsection