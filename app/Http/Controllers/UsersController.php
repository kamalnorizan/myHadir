<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::pluck('name','name');
        $users=User::all();
        return view('users.index',compact('users','roles'));

    }

    public function assignrole(Request $request) 
    {
        $user=User::find($request->user_id)->syncRoles($request->roles);
        dd($user);
        flash('Tugasan telah ditetapkan dengan jayanya.')->success()->important();
        return redirect('users');
    }


}
