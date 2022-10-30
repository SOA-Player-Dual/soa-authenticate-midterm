<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use Illuminate\Http\Request;
use App\Models\Account;

class AuthenticateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(AuthenticateRequest $request)
    {
        $data = $request->all();
        $username = $data['username'];
        $password = $data['password'];
        $account = Account::where('username', $username)->where('password', md5($password))->first();
        if ($account) {
            return response()->json([
                'id' => $account->id,
                'fullname' => $account['fullname'],
                'email' => $account['email'],
                'phone' => $account['phone'],
                'surplus' => $account['surplus'],
            ], 200);
        } else {
            return response()->json(['error' => 'Username or password is incorrect'], 401);
        }
    }

    public function getEmail(Request $request)
    {
        $data = $request->all();
        $email = Account::where('id', $data['user_id'])->first();
        if ($email) {
            return response()->json([
                'email' => $email['email'],
            ], 200);
        } else {
            return response()->json(['error' => 'Can\'t find email of this account'], 401);
        }
    }

    public function getAllUser()
    {
        $users = Account::all();
        if ($users) {
            return response()->json([
                'users' => $users,
            ], 200);
        } else {
            return response()->json(['error' => 'Can\'t find any user'], 401);
        }
    }
}
