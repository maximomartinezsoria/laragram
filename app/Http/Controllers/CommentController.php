<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller{
    

    public function __construct(){
        $this->middleware('auth');
    }

    public function new_comment(Request $request){
        /*
        * create new comments
        */

        // validate
        $this->validate($request, [
            'comment'   =>  'required'
        ]);
        
        $content    =   $request->input('comment');
        $image_id   =   $request->input('image_id');
        $user_id    =   \Auth::user()->id;

        // create new comment
        $comment = new Comment();
        $comment->user_id   =   $user_id;
        $comment->content   =   $content;
        $comment->image_id  =   $image_id;
        
        // save comment in the database
        $comment->save();

        return redirect()->Route('image.detail', ['image' => $image_id]);        
    }
}
