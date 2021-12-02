<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Price;
use Auth;
use Alert;
use Storage;

class PostController extends Controller
{
    //
    public function index(){


        $users = User::get();
        // return $users;

        //$posts = Post::get();

        $posts = Post::
        when(request()->user_id,function($posts){
            $posts = $posts->where('user_id', request()->user_id);
        })->
        when(request()->status,function($posts){
            $posts = $posts->where('status', request()->status);
        })->get();
        // return auth()->user()->id;
        // return Auth::user()->id;
        return view('admin.post.index',compact('posts','users'));
    }

    public function create(){
        return view('admin.post.create');
    }

    public function store(Request $request)
    {

        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'file|max:10240|mimes:jpg,png',
        ]);
        
        $data = new Post();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        if($request->file('image')){
            $image = $request->file('image');
            $image->storeAs('public/post', $image->hashName());
            $data->image = $image->hashName();
        }
        $data->save();

        $price = new Price();
        $price->post_id = $data->id;
        $price->price = $request->price;
        $price->save();

        Alert::success('Congrats', 'You\'ve Successfully Registered');
        return redirect()->route('admin.post.index');
        
    }

    public function edit($id)
    {
        //
        $data=Post::findOrFail($id);
        return view('admin.post.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
   //     dd($request->all());
   
        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'file|max:10240|mimes:jpg,png',
        ]);
        
        $data=Post::findOrFail($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->user_id = Auth::user()->id;
        if($request->file('image')){
            $image = $request->file('image');
            $image->storeAs('public/post', $image->hashName());
            $data->image = $image->hashName();
        }

        $data->save();

        Alert::success('Congrats', 'You\'ve Successfully Update Data');
        return redirect()->route('admin.post.index');        
    }

    public function destroy(Post $id)
    {
        // $book = Book::findOrFail($id);
        Storage::disk('local')->delete('public/post/'.basename($id->image));
        $id->delete();

        Alert::error('Congrats', 'You\'ve Successfully Delete Data');
       
        return redirect()->route('admin.post.index');
    }

    public function approve(Request $request, $id){
        $data = Post::findOrFail($id);
        $data->status = 'approve';
        $data->save();

        Alert::success('Congrats', $data->title. '.You\'ve Successfully Approve Data');
       
        return redirect()->route('admin.post.index');
    }

    public function reject(Request $request, $id){
        $data = Post::findOrFail($id);
        $data->status = 'reject';
        $data->save();

        Alert::success('Congrats', $data->title. '.You\'ve Successfully Reject Data');
       
        return redirect()->route('admin.post.index');
    }

}
