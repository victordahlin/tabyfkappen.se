@extends('layouts.master')
@section('content')

    <h1>{{ trans('messages.activation-codes') }}</h1>
    <hr>

    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <table class="table sortable">
        <thead>
        <tr>
            <th>{{ trans('messages.name') }}</th>
            <th>{{ trans('messages.is-used') }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($activationCodes as $ocr)
            <tr>
                <td>{{ $ocr->code }}</td>
                <td>@if($ocr->is_used) Ja @else Nej @endif</td>
                <td>
                    {!! Form::open(['url' => 'activation-codes/' . $ocr->id,'class' => 'pull-right']) !!}
                    {!! Form::hidden('_method', 'DELETE') !!}
                    {!! Form::button('<span class="glyphicon glyphicon-remove"></span>',
                                    ['class'=>'btn btn-default', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
                <td>
                    {!! Form::open(['url' => 'activation-codes/' . $ocr->id . '/edit']) !!}
                    {!! Form::hidden('_method', 'GET') !!}
                    {!! Form::button('<span class="glyphicon glyphicon-pencil"></span>',['class'=>'btn btn-default', 'type'=>'submit']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination"> {!! $activationCodes->render()  !!} </div>
    <br>

    <a href="{!! url('activation-codes/create') !!}" class="btn btn-primary">{{ trans('messages.activation-codes-add') }}</a>
@stop
