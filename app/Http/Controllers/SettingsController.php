<?php

namespace App\Http\Controllers;

use App\ActivationCodes;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = \App\User::find(1);

        return view('pages.settings',compact('admin'));
    }

    /**
     * Store file and insert new codes to the database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $fileName = $request->file('file')->getClientOriginalName();

        // Store file in folder storage
        Storage::put(
            $fileName,
            file_get_contents($request->file('file')->getRealPath())
        );

        // Look in storage for file and open it
        $codes = fopen(storage_path() . '/app/' . $fileName, 'r');

        // Save codes to the database
        if($codes) {
            $index = 0;
            $indexOCR = 0;
            while(($code = fgets($codes)) !== false) {

                // First code after account number
                if($index == 2) {
                    $numbers = explode(' ', $code);
                    $ocr = substr($numbers[15], 0, 10);
                    
		    if(!ActivationCodes::where('code', $ocr)->exists()) {
                        $activationCode = new \App\ActivationCodes;
                        $activationCode->code  = $ocr;
                        $activationCode->is_used = false;
                        $activationCode->save();
                    }

                    $indexOCR = 0;
                }

                // Following codes
                if($indexOCR == 4) {
                    $numbers = explode(' ', $code);

                    if(!empty($numbers[15])){
                        $ocr = substr($numbers[15], 0, 10);
                    	
			if(!ActivationCodes::where('code', $ocr)->exists()) {
                          $activationCode = new \App\ActivationCodes;
                          $activationCode->code  = $ocr;
                          $activationCode->is_used = false;
                          $activationCode->save();
                    	}
		    }
                    $indexOCR = 0;
                }
                $index++;
                $indexOCR++;
            }

            fclose($codes);

            $request->session()->flash('message', 'Filen uppladdad och koderna är nu i databasen');
        } else {
            // Error: Could not open file
           $request->session()->flash('error', 'Filen kunde inte laddas upp');
        }
        return redirect('settings');
    }


    public function update(Request $request)
    {
        if($request->input('password') === $request->input('repeatPassword')) {

            $rules = [
                'password' => 'required',
                'repeatPassword' => 'required'
            ];

            $validator = Validator::make($request->all(),$rules);

            // process the login
            if ($validator->fails()) {
                return redirect('settings')
                    ->withInput()
                    ->withErrors($validator);
            } else {
                $admin = \App\User::find(1);
                $admin->password = bcrypt($request->input('password'));
                $admin->save();

                $request->session()->flash('message', 'Lösenordet är nu uppdaterat');

                return redirect('settings');
            }

        } else {

            $request->session()->flash('error', 'Lösenordet matchar inte varandra');

            return redirect('settings');

        }

    }
}
