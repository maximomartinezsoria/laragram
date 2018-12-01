<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use App\User;
use App\Follow;

class UserController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index($search = null){
        /*
        * list of all users and search through username or fullname
        */

        // get follows for the view
        $follows = Follow::get();
        
       // var_dump($follows);die;

        // if the user doesnt search anything, get all users
        if (is_null($search)) {
            $users = User::orderBy('id', 'desc')->get();
        }else{
            // if the user searchs something, get the search
            $users = User::where('fullname', 'LIKE', '%'.$search.'%')
                            ->orWhere('username', 'LIKE', '%'.$search.'%')
                            ->orderBy('id', 'desc')
                            ->get();
        }

        return view('user.index', [
            'users'     => $users,
            'follows'   => $follows
        ]);
    }

    public function account(){
        return view('user.account');
    }
    
    public function update(Request $request){
        /*
        * list of all users and search through username or fullname
        */

        // get the information of the form
        $user = \Auth::user();
        $id = $user->id;
        $email = $request->input('email');
        $fullname = $request->input('fullname');
        $username = $request->input('username');
        $biography = $request->input('biography');
        $image_path = $request->file('image');

        // validate
        $this->validate($request, [
            'email'     =>  'required|email|max:255|unique:users,email,'.$id,
            'fullname'  =>  'required|string|max:255',
            'username'  =>  'required|max:255|unique:users,username,'.$id,
            ]);
        
        if($image_path){
            $image_name = time().$image_path->getClientOriginalName();
            Storage::disk('users_profile_image')->put($image_name, File::get($image_path));
            $user->image = $image_name;
        }

        // Create a new user
        $user->email     = $email;
        $user->fullname  = $fullname;
        $user->username  = $username;
        $user->biography = $biography;

        // update the database
        $user->update();

        return redirect()->route('user.profile', ['id' => $id])
                         ->with(['message'  =>  'The user has been updated correctly']);
    }

    public function get_image($image){
        /*
        * return the profile image file
        */

        $file = Storage::disk('users_profile_image')->get($image);
        return new Response($file, 200);
    }

    public function profile($id){
        /*
        * Generate the profile view
        */

        // get follows for the view
        $follows = Follow::get();
        $following = Follow::where('follower', $id)->get();
        $followers = Follow::where('followed', $id)->get();

        // find the user through the id
        $user = User::find($id);
        
        return view('user.profile', [
            'user' => $user,
            'follows'   => $follows,
            'following'   => $following,
            'followers'   => $followers,
            ]);
    }
}