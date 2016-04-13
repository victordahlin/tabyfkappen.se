<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RestController extends Controller
{
    public function __construct()
    {
        // Apply the jwt.auth middleware to all methods in this controller
        // except for the authenticate method. We don't want to prevent
        // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth', ['except' => ['authenticate']]);
    }

    /**
     * @return array of categories
     */
    public function getCategories()
    {
        return response()->json(\App\Categories::all());
    }

    /**
     * @return array of companies
     */
    public function getCompanies()
    {
        return response()->json(\App\Companies::all());
    }

    /**
     * @return array of offers
     */
    public function getOffers()
    {
        $offers = \App\Offers::where('end_date', '>=', new \DateTime('today'))->get();

        $user_id = JWTAuth::parseToken()->authenticate()->id;

        $used_offer_id = \App\OffersUsed::where('user_id', '=', $user_id)->get()->pluck('offer_id');

        foreach($offers as $key => $value) {
            foreach($used_offer_id as $id) {
                if($offers->contains($id)) {
                    $offers->forget($key);
                }
            }
        }

        return response()->json($offers->flatten(), 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function useOffer(Request $request) {

        $user_id = JWTAuth::parseToken()->authenticate()->id;

        $offer_id = $request->input('offer_id');

        $rules = [
            'offer_id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return response()->json($validator->messages(), 404);
        } else if (empty($user_id)) {
            $returnData = array(
                'status' => 'error',
                'message' => trans('messages.users-missing')
            );
            return response()->json($returnData, 401);
        } else {
            $used_offer = \App\OffersUsed::where('user_id', '=', $user_id)->get();

            foreach($used_offer as $used) {
                if((int)$used->offer_id === (int)$offer_id) {
                    $returnData = array(
                        'status' => 'error',
                        'message' => trans('messages.offers-is-used')
                    );
                    return response()->json($returnData, 403);
                }
            }

            $type = \App\Offers::find($offer_id)->is_super_deal ? 'super_deal' : 'temporary_deal';

            $returnData = array(
                'status' => 'error',
                'message' =>  trans('messages.offers-missing')
            );

            $offer = \App\Offers::where('id', '=', $offer_id);

            if(empty($offer)) {
                return response()->json($returnData, 404);
            }

            $offer = new \App\OffersUsed;
            $offer->offer_id = $offer_id;
            $offer->user_id = $user_id;
            $offer->type = $type;
            $offer->save();

            $returnData = array(
                'status' => 'success',
                'message' => trans('messages.offers-is-used')
            );
            return response()->json($returnData, 200);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getInfo() {
        return response()->json(\App\Information::find(1));
    }

    public function isTokenValid() {
        $returnData = array(
            'status' => 'success',
            'message' => 'Token is valid'
        );
        return response()->json($returnData, 200);
    }
}
