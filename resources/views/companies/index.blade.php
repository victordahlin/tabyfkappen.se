@extends('layouts.master')
@section('content')
    <h1>{{ trans('messages.companies') }}</h1>
    <hr>

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>{{ trans('messages.name') }}</th>
            <th>{{ trans('messages.url') }}</th>
            <th>{{ trans('messages.address') }}</th>
            <th>{{ trans('messages.mobile') }}</th>
            <th>{{ trans('messages.opening-hours') }}</th>
            <th>{{ trans('messages.email') }}</th>
            <th>{{ trans('messages.long_term_deals') }}</th>
            <th>{{ trans('messages.image-url') }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->url }}</td>
                <td>{{ $company->address }}</td>
                <td>{{ $company->mobile }}</td>
                <td>@if(strlen($company->opening_hours)>10) {{ substr($company->opening_hours, 0, 5) . '...' }} @else {{ $company->opening_hours }} @endif</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->long_term_deals }}</td>
                <td>{{ $company->image_file_path }}</td>
                <td>
                    {!! Form::open(['url' => 'companies/' . $company->id,'class' => 'pull-right'])
                    !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button('<span class="glyphicon glyphicon-remove"></span>',['class'=>'btn btn-default', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
                <td>
                    {!! Form::open(['url' => 'companies/' . $company->id . '/edit']) !!}
                    {!! Form::hidden('_method', 'GET') !!}
                    {!! Form::button('<span class="glyphicon glyphicon-pencil"></span>',['class'=>'btn btn-default', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{!! url('companies/create') !!}" class="btn btn-primary">{{ trans('messages.companies-add') }}</a>
@stop
