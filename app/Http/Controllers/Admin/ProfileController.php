<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function edit(){
        $id = Auth::user()->id;
        $data = User::findOrFail($id);

        return view('admin.profile.edit', compact('data'));
    }

    public function update(Request $request) {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);
        $data->email = $request->email;
        $data->name = $request->name;
        $data->address = $request->address;
        $data->save();

        return back();
    }

}
