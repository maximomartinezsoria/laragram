<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        /*
        * List the liked photos
        */
        $user_id = \Auth::user()->id;
        $likes = Like::where('user_id', $user_id)
                        ->orderBy('id', 'desc')
                        ->get();

        return view('like.index', [
            'likes' => $likes
        ]);
    }

    public function new_like($image_id){
        /*
        * save new likes
        */

        // if like doesnt exists -
        $user_id = \Auth::user()->id;
        $isset = Like::where('user_id', $user_id)
                        ->where('image_id', $image_id)
                        ->count();

        if ($isset == 0) {
            $like            = new Like();
            $like->image_id  = $image_id;
            $like->user_id   = $user_id;
            
            // - do like 
            $like->save();
        }

        return response()->json([
            'like'  => $like
        ]);
    }

    public function dislike($image_id){
        /*
        * delete lkes
        */
        
        $user_id = \Auth::user()->id;
        $like = Like::where('user_id', $user_id)
                        ->where('image_id', $image_id)
                        ->first();

        if ($like) {
            $like->delete();
        }

        return response()->json([
            'like'  => 'dislike'
        ]);
    }
}
