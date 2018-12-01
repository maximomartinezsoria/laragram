<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;

class FollowController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function follow($follower, $followed){        
        $follow = new Follow();
        $follow->follower = $follower;
        $follow->followed = $followed;
        
        $follow->save();
        
        return redirect()->route('user.index');
    }
    
    public function unfollow($follower, $followed){
        $follow = Follow::where('follower', $follower)
                        ->where('followed', $followed)
                        ->first();

        $follow->delete();

        return redirect()->route('user.index');
    }        
}
