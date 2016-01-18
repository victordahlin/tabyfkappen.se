<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use DateTime;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = \App\Offers::all();
        return view('offers.index', compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = \App\Companies::all();
        return view('offers.create', compact('companies'));
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
            'name' => 'required',
            'end_date' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {

            return redirect('offers/create')
                ->withInput()
                ->withErrors($validator);
        } else {
            if($request->hasFile('image_file_path')) {
                $fileName = \App\ImageHelper::saveImageAndGetName($request);
            }

            $offers = new \App\Offers;
            $offers->company_id = $request->input('company_id');
            $offers->name = $request->input('name');
            $offers->description = $request->input('description');
            $offers->end_date = $request->input('end_date');

            if($request->input('is_super_deal') === 'is_super_deal') {
                $offers->is_super_deal = true;
            } else {
                $offers->is_super_deal = false;
            }

            $offers->image_file_path = empty($fileName) ? '' : $fileName;
            $offers->save();

            $request->session()->flash('message', trans('messages.offer-created'));

            return redirect('offers');
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
        return \App\Offers::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = \App\Offers::find($id);
        $companies = \App\Companies::all();

        return view('offers.edit', compact('offer','companies'));
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
            'name' => 'required',
            'end_date' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('offers/' . $id . '/edit')
                ->withInput()
                ->withErrors($validator);
        } else {
            $fileName = '';
            if($request->hasFile('image_file_path')) {
                $fileName = \App\ImageHelper::saveImageAndGetName($request);
            }

            $offers = \App\Offers::find($id);
            $offers->company_id = $request->input('company_id');
            $offers->name = $request->input('name');
            $offers->description = $request->input('description');
            $offers->end_date = $request->input('end_date');

            if($request->input('is_super_deal') === 'is_super_deal') {
                $offers->is_super_deal = true;
            } else {
                $offers->is_super_deal = false;
            }

            $offers->image_file_path = empty($fileName) ? $offers->image_file_path : $fileName;
            $offers->save();

            $request->session()->flash('message', trans('messages.offer-updated'));
            return redirect('offers');
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
        $offer = \App\Offers::find($id);
        $offer->delete();

        Session::flash('message', trans('messages.offer-removed'));
        return redirect('offers');
    }
}
