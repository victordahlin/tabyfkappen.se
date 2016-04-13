@extends('layouts.master')
@section('content')

    <h1>{{ trans('messages.categories') }}</h1>
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
        <th>{{ trans('messages.image-url') }}</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->image_file_path }}</td>
            <td>
                {!! Form::open(['url' => 'categories/' . $category->id,'class' => 'pull-right']) !!}
                {!! Form::hidden('_method', 'DELETE') !!}
                {!! Form::button('<span class="glyphicon glyphicon-remove"></span>',['class'=>'btn btn-default', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open(['url' => 'categories/' . $category->id . '/edit']) !!}
                {!! Form::hidden('_method', 'GET') !!}
                {!! Form::button('<span class="glyphicon glyphicon-pencil"></span>',['class'=>'btn btn-default', 'type'=>'submit']) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<a href="{!! url('categories/create') !!}" class="btn btn-primary">{{ trans('messages.categories-add') }}</a>
@stop
