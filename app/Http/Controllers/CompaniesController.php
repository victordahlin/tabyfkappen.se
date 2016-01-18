<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = \App\Companies::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Categories::all();
        return view('companies.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'mobile' => 'required',
        ];

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('companies/create')
                ->withInput()
                ->withErrors($validator);
        } else {
            if($request->hasFile('image_file_path')) {
                $fileName = \App\ImageHelper::saveImageAndGetName($request);
            }

            $company = new \App\Companies;
            $company->category_id = $request->input('category_id');
            $company->name = $request->input('name');
            $company->url = $request->input('url');
            $company->address = $request->input('address');
            $company->mobile = $request->input('mobile');
            $company->opening_hours = $request->input('opening_hours');
            $company->email = $request->input('email');
            $company->long_term_deals = $request->input('long_term_deals');
            $company->image_file_path = empty($fileName) ? '' : $fileName;
            $company->save();

            $request->session()->flash('message', trans('messages.company-created'));
            return redirect('companies');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return \App\Companies::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = \App\Companies::find($id);
        $categories = \App\Categories::all();

        return view('companies.edit', compact('company', 'categories', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'mobile' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('companies/' . $id . '/edit')
                ->withInput()
                ->withErrors($validator);
        } else {
            $fileName = '';
            if($request->hasFile('image_file_path')) {
                $fileName = \App\ImageHelper::saveImageAndGetName($request);
            }

            $company = \App\Companies::find($id);
            $company->category_id = $request->input('category_id');
            $company->name = $request->input('name');
            $company->url = $request->input('url');
            $company->address = $request->input('address');
            $company->mobile = $request->input('mobile');
            $company->opening_hours = $request->input('opening_hours');
            $company->email = $request->input('email');
            $company->long_term_deals = $request->input('long_term_deals');
            $company->image_file_path = empty($fileName) ? $company->image_file_path : $fileName;
            $company->save();

            $request->session()->flash('message', trans('messages.company-updated'));
            return redirect('companies');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $amount_offers = \App\Offers::where('company_id', $id)->count();

        if ($amount_offers > 0) {
            Session::flash('error', trans('messages.company-error').$amount_offers.' kuponger kvar');
        } else {
            $company = \App\Companies::find($id);
            $company->delete();

            Session::flash('message', trans('messages.company-removed'));
        }
        return redirect('companies');
    }
}
