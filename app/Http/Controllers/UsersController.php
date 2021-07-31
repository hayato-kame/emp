<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追加
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }

    public function show($id)
    {
        $user = Auth::user();
        // $user = User::find($id); // これもいい
        return view('users.show', ['user' => $user]);
    }

}
