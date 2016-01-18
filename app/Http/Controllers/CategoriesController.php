<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = \App\Categories::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
        ];

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('categories/create')
                ->withInput()
                ->withErrors($validator);
        } else {
            if($request->hasFile('image_file_path')) {
                $fileName = \App\ImageHelper::saveImageAndGetName($request);
            }

            $category = new \App\Categories;
            $category->name = $request->input('name');
            $category->image_file_path = empty($fileName) ? '' : $fileName;
            $category->save();

            $request->session()->flash('message', trans('messages.category-created'));

            return redirect('categories');
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
        $category = \App\Categories::find($id);

        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = \App\Categories::find($id);

        return view('categories.edit', compact('category'));
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
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('categories/' . $id . '/edit')
                ->withInput()
                ->withErrors($validator);
        } else {
            $fileName = '';
            if($request->hasFile('image_file_path')) {
                $fileName = \App\ImageHelper::saveImageAndGetName($request);
            }

            $category = \App\Categories::find($id);
            $category->name = $request->input('name');
            $category->image_file_path = empty($fileName) ? $category->image_file_path : $fileName;
            $category->save();

            $request->session()->flash('message', trans('category-created'));

            return redirect('');
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
        $amount_companies = \App\Companies::where('category_id', $id)->count();

        if ($amount_companies > 0) {
            Session::flash('error', trans('messages.category-error').$amount_companies.' företag kvar');
        } else {
            $category = \App\Categories::find($id);
            $category->delete();

            Session::flash('message', trans('messages.category-removed'));
        }
        return redirect('categories');
    }
}
