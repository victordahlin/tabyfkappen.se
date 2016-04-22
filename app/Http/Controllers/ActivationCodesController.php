<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ActivationCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activationCodes = \App\ActivationCodes::paginate(15);
        return view('activationcodes.index', compact('activationCodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activationcodes.create');
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
            'code' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('activation-codes/create')
                ->withInput()
                ->withErrors($validator);
        } else {
            $activationCode = new \App\ActivationCodes;
            $activationCode->code = $request->input('code');
            $activationCode->is_used = 0;
            $activationCode->save();

            $request->session()->flash('message', trans('messages.activation-codes-created'));

            return redirect('activation-codes');
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
        $activationCode = \App\ActivationCodes::find($id);
        $used = "Nej";

        if($activationCode->is_used) {
            $used = "Ja";
        }

        return view('activationcodes.edit', compact('activationCode', 'used'));
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
            'code' => 'required',
            'is_used' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('activation-codes/create')
                ->withInput()
                ->withErrors($validator);
        } else {
            $used = 1;
            if(strcmp(strtolower($request->is_used), 'ja') !== 0) {
                $used = 0;
            }

            $activationCode = \App\ActivationCodes::find($id);
            $activationCode->code = $request->input('code');
            $activationCode->is_used = $used;
            $activationCode->save();

            $request->session()->flash('message', trans('messages.activation-codes-updated'));

            return redirect('activation-codes');
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
        $activationCode = \App\ActivationCodes::find($id);
        $activationCode->delete();

        Session::flash('message', trans('messages.activation-codes-removed'));

        return redirect('activation-codes');
    }
}
