<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $activation_code = new \App\ActivationCodes();
        $activation_codes = array('code' => $activation_code->getNumCodes(),
            'used' => $activation_code->getNumUsedCodes());

        // Get offers for companies
        $company = new \App\Companies();
        $company_stats = $company->getUsedOffersForCompanies();

        return view('pages.statistics',compact('company_stats', 'activation_codes'));
    }

}
