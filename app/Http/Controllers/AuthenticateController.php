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

    public function login(AuthenticateRequest $request){
        $data = $request->all();
        $username = $data['username'];
        $password = $data['password'];
        $account = Account::where('username', $username)->where('password', md5($password))->first();

        if ($account) {
            return response()->json([
                'id' => $account['id'],
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function getUserInfo(Request $request){
        $data = $request->all();
        if ($data == null || $data['id'] == null) {
            return response()->json([
                'error' => 'id is required',
            ], 422);
        }
        $id = $data['id'];
        $account = Account::where('id', $id)->first();

        if ($account) {
            return response()->json([
                'fullname' => $account['fullname'],
                'email' => $account['email'],
                'phone' => $account['phone'],
                'surplus' => $account['surplus'],
            ], 200);
        } else {
            return response()->json(['error' => 'Not found user have this id'], 404);
        }
    }
}
