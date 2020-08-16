<?php

namespace App\Http\Controllers;

use App\Model\ApiUser;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($items_per_pag=5)
    {
        $api_users = ApiUser::paginate($items_per_pag);
        return view('api_users.api_users', compact('api_users'));
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
        // return $request->id;
        // return response()->json(['response'=> $request],200);
        $user = ApiUser::findOrNew($request->id);

        if(empty($user->email)){
            $user->id       = $request->id;
            $user->name     = $request->name;
            $user->lastname = $request->lastname;
            $user->email    = $request->email;
            $user->avatar   = $request->avatar;
            $user->save();
        }
        return response()->json(['response'=> $user],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function show(ApiUser $apiUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiUser $apiUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiUser $apiUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\ApiUser  $apiUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiUser $apiUser)
    {
        //
    }
}
