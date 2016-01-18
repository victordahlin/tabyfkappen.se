@extends('layouts.master')
@section('content')

    <div class="container">
        <a href="{!! url('categories') !!}" class="btn btn-danger">{{ trans('messages.back-button') }}</a>
        <h1>{{ trans('messages.edit') }} {{ $category->name }}</h1>
        <hr>

        @if ($errors->has())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        {!! Form::model($category, array(
        'route' => array('categories.update', $category->id),
        'method' => 'PUT',
        'files' => true)) !!}

        <div class="form-group">
            <img src="{{ url('images/' . $category->image_file_path) }}" class="img-responsive" alt="">
        </div>

        <div class="form-group">
            {!! Form::label('name', trans('messages.name')) !!}
            {!! Form::text('name', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('image_file_path',trans('messages.upload-image')) !!}
            {!! Form::file('image_file_path', null, array('class' => 'form-control')) !!}
            <p class="help-block">{{ trans('messages.allowed-types') }}</p>
        </div>

        {!! Form::submit('Uppdatera branch',array('class' => 'btn btn-primary')) !!}

        {!! Form::close() !!}

    </div>

@stop
