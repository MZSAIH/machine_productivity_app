<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view(
            'admin.user.user',compact('users')
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.user.create_user',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|max:255',
            'username' => 'bail|required|max:10',
            'password' => 'bail|required|min:6',
        ]);
        $data = $request->all();
        $data['status'] = 1;
        $data['is_verified'] = 1;
        $data['password'] = Hash::make($data['password']);
        $data['image'] = 'noimage.png';
        $user = User::create($data);
        $user->roles()->sync($request->input('roles', []));
        return redirect('user')->with('msg','user added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        $productions = DB::table('productions')
        ->leftjoin('operation', 'productions.id', '=', 'operation.production_id')
        ->where('operation.user_id', $id)
        ->get();
        return view('admin.user.show_user',compact('user','productions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::get();
        $user = User::find($id);
        return view('admin.user.edit_user',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'bail|required|max:255',
            'username' => 'bail|required'
        ]);
        $data = $request->all();
        $user = User::find($id);
        if($data['password'] != null)
        {
            $request->validate([
                'password' => 'bail|min:6',
            ]);
            $data['password'] = Hash::make($data['password']);
        }
        else
        {
            $data['password'] = $user->password;
        }
        if($user->id != 1){
            $user->update($data);
        }
        $user->roles()->sync($request->input('roles', []));
        return redirect('user')->with('msg','User Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->id != 1){
            $user->delete();
            return response(['success' => true]);
        }
    }

    /**
     * Change status of a specific user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function change_status(Request $request)
    {
        $data = User::find($request->id);
        if($data->status == 0)
        {
            $data->status = 1;
            $data->save();
            return response(['success' => true]);
        }
        if($data->status == 1)
        {
            $data->status = 0;
            $data->save();
            return response(['success' => true]);
        }
    }
}
