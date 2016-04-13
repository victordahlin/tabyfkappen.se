@extends('layouts.master')
@section('content')
    <h1>{{ trans('messages.statistic') }}</h1>
    <hr>

    <table class="table sortable">
        <thead>
        <tr>
            <th>{{ trans('messages.companies') }}</th>
            <th>{{ trans('messages.total-deal') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($company_stats as $key => $company)
            <tr>
                <td>
                    <a href="{{ '#'.preg_replace('/\s+&/', '', $key) }}" data-toggle="collapse" aria-expanded="false">{{ $key }}</a>
                    <div class="collapse" id="{{ preg_replace('/\s+&/', '', $key) }}">
                        <table class="table sortable">
                            <thead>
                            <th>{{ trans('messages.offers') }}</th>
                            <th>{{ trans('messages.offers-used') }}</th>
                            </thead>
                            <tbody>
                            @foreach($company_stats[$key]['offers'] as $offer)
                                <tr>
                                    <td class="col-md-6">{{ $offer['name'] }}</td>
                                    <td class="col-md-6">{{ $offer['used'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </td>
                <td>{{ $company['total_deals'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <table class="table">
        <thead>
        <tr>
            <th>{{ trans('messages.amount-activation-code') }}</th>
            <th>{{ trans('messages.used-activation-code') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $activation_codes['code'] }}</td>
            <td>{{ $activation_codes['used'] }}</td>
        </tr>
        </tbody>
    </table>
@stop
