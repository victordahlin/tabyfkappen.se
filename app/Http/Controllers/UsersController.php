<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::paginate(15);
        $users_tot = \App\User::all()->count();
        $used_offer = [];

        foreach($users as $user) {

            $offers = \App\OffersUsed::where('user_id', $user->id)->count();

            array_push($used_offer, $offers);
        }

        return view('users.index', compact('users','used_offer', 'users_tot'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required',
            'activation_code' => 'required'
        ];

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('users/create')
                ->withInput()
                ->withErrors($validator);
        } else {
            $user = new \App\UsersIos($request->all());
            $user->save();

            $request->session()->flash('message', 'Medlem är nu skapad');

            return redirect('users');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \App\User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::find($id);

        return view('users.edit', compact('user'));
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
        $rules = [
            'email' => 'required|email',
        ];

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('users/' . $id . '/edit')
                ->withInput()
                ->withErrors($validator);
        } else {
            $user = \App\User::find($id);
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            $user->activation_code = $request->input('activation_code');
            $user->save();

            $request->session()->flash('message', 'Medlem är nu uppdaterad');

            return redirect('users');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::find($id);
        $user->delete();

        Session::flash('message', 'Medlem är nu borttagen');

        return redirect('users');

    }
}
