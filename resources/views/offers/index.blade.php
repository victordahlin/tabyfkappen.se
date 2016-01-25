@extends('layouts.master')
@section('content')
<h1>{{ trans('messages.offers') }}</h1>
<hr>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

<table class="table sortable">
    <thead>
    <tr>
        <th>{{ trans('messages.name') }}</th>
        <th>{{ trans('messages.description') }}</th>
        <th>{{ trans('messages.end-date') }}</th>
        <th>{{ trans('messages.type') }}</th>
        <th>{{ trans('messages.image-url') }}</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($offers as $offer)
        <tr>
            <td>{{ $offer->name }}</td>
            <td>@if(strlen($offer->description)>50) {{ substr($offer->description,0, 50) . '...' }} @else {{ $offer->description }} @endif</td>
            <td>{{ $offer->end_date }}</td>
            <td>@if($offer->is_super_deal) {{ trans('messages.super-deal') }} @else {{ trans('messages.temporary-deal') }} @endif</td>
            <td>{{ $offer->image_file_path }}</td>
            <td>
                {!! Form::open(['url' => 'offers/' . $offer->id,'class' => 'pull-right'])
                !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::button('<span class="glyphicon glyphicon-remove"></span>',['class'=>'btn btn-default', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open(['url' => 'offers/' . $offer->id . '/edit']) !!}
                {!! Form::hidden('_method', 'GET') !!}
                {!! Form::button('<span class="glyphicon glyphicon-pencil"></span>',['class'=>'btn btn-default', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<a href="{!! url('offers/create') !!}" class="btn btn-primary">{{ trans('messages.offers-add') }}</a>
@stop