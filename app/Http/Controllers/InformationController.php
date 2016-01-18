<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = \App\Information::find(1);
        return view('pages.information', compact('info'));
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
            'app' => 'required',
            'tabyfk' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('information')
                ->withInput()
                ->withErrors($validator);
        } else {

            $info = \App\Information::find($id);
            $info->app = $request->input('app');
            $info->tabyfk = $request->input('tabyfk');
            $info->save();

            $request->session()->flash('message', trans('messages.information-updated'));
            return redirect('information');
        }
    }
}
