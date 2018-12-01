<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        
        $following = Follow::where('follower', Auth::user()->id)->get();

        $images = array();

        foreach($following as $follow){
            $image = Image::orderBy('id','desc')
                            ->where('user_id', $follow->followed)
                            ->get();
            array_push($images, $image);
        }

        return view('home', [
            'images' => $images
        ]);
    }
}