<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Auth;
use Alert;

class PostController extends Controller
{
    public function index(){
        $user = User::get();
        return $user;
        $id = auth()->user()->id;
        $posts = Post::
        when(request()->status,function($posts){
            $posts = $posts->where('status', request()->status);
        })
        ->where('user_id', $id)
        ->orderBy('updated_at', 'asc')
        ->get();
        return view('user.post.index',compact('posts'));
    }

    public function create(){
        return view('user.post.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'file|max:10240|mimes:jpg,png',
        ]);
        
        $data = new Post();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = 'waiting';
        $data->user_id = Auth::user()->id;
        if($request->file('image')){
            $image = $request->file('image');
            $image->storeAs('public/post', $image->hashName());
            $data->image = $image->hashName();
        }
        $data->save();

        Alert::success('Congrats', 'You\'ve Successfully Registered');
        return redirect()->route('user.post.index');
        
    }
}
