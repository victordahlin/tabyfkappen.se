@extends('layouts.master')
@section('content')

    <div class="container">
        <a href="{!! url('categories') !!}" class="btn btn-danger">{{ trans('messages.back-button') }}</a>
        <h1>{{ trans('messages.categories-add') }}</h1>
        <hr>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::open([
        'url' => 'categories',
        'method' => 'POST',
        'files' => true
        ])  !!}

        <div class="form-group">
            {!! Form::label('name', trans('messages.name')) !!}
            {!! Form::text('name', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('image_file_path',trans('messages.upload-image')) !!}
            {!! Form::file('image_file_path', null, array('class' => 'form-control')) !!}
            <p class="help-block">{{ trans('messages.allowed-types') }}</p>
        </div>

        {!! Form::submit('Lägg till branch',array('class' => 'btn btn-primary')) !!}

        {!! Form::close() !!}

    </div>

@stop
