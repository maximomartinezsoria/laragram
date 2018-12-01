<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;
use Illuminate\Http\Response;

class ImageController extends Controller{
    
    public function new_image(){
        /*
        * new image view
        */
        return view('/image/new_image');
    }

    public function upload(Request $request){
        /*
        * upload images
        */

        $image_path = $request->file('image');
        $description= $request->input('description');

        //validation
        $this->validate($request, [
            "description"   =>   "required",
            "image"         =>   "required",
        ]);

        // create an object with the model
        $user               =   \Auth::user();
        $image              =   new Image;
        $image->user_id     =   $user->id;  
        $image->description =   $description;

        if($image_path){
            $image_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_name, File::get($image_path));
            $image->image_path = $image_name;
        }
        
        //save in the database
        $image->save();

        return redirect()->Route('home')->with(['message' => 'The image has been upload succesfully']);
    }

    public function get_image($image_path){
        /*
        * Return the image file 
        */
    
        $image = Storage::disk('images')->get($image_path);

        return response($image, 200);
    }

    public function detail($id){
        /*
        * Generate the single page of each image
        */

        $image = Image::find($id);

        return view('image.detail', ['image'=>$image]);
    }

    public function delete($id){
        /*
        * Delete images
        */

        $user = \Auth::user();
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();
        $image = Image::find($id);

        // delete comments from the database
        if (count($comments) >= 1) {
            foreach($comments as $comment){
                $comment->delete();
            }
        }

        // delete likes from the database
        if (count($likes) >= 1) {
            foreach($likes as $like){
                $like->delete();
            }
        }

        // delete image from the storage
        Storage::disk('images')->delete($image->image_path);

        // delete image from the database
        $image->delete();

        // Go to profile
        return redirect()->route('user.profile',['id' => $user->id])
                         ->with(['message' => 'The image has been deleted']);
    }
}
