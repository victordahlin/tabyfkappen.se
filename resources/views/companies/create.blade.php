@extends('layouts.master')
@section('content')
    <div class="container">
        <a href="{!! url('companies') !!}" class="btn btn-danger">{{ trans('messages.back-button') }}</a>
        <h1>{{ trans('messages.companies-add') }}</h1>
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
        'url' => 'companies',
        'method' => 'POST',
        'files' => true
        ])  !!}

        <div class="form-group">
            {!! Form::label('category', trans('messages.categories-select')) !!}
            <select name="category_id" id="" class="form-control">
                @foreach($categories as $category)
                    <option value="{!! $category->id !!}">{!! $category->name !!}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {!! Form::label('name', trans('messages.name')) !!}
            {!! Form::text('name', old('name'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('url', trans('messages.url')) !!}
            {!! Form::text('url', old('description'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('address', trans('messages.address')) !!}
            {!! Form::text('address', old('address'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('mobile', trans('messages.mobile')) !!}
            {!! Form::text('mobile', old('mobile'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('opening_hours', trans('messages.opening-hours')) !!}
            {!! Form::textarea('opening_hours', old('opening_hours'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', trans('messages.email')) !!}
            {!! Form::text('email', old('email'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('long_term_deals', trans('messages.long_term_deals')) !!}
            {!! Form::text('long_term_deals', old('long_term_deals'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('image_file_path', trans('messages.upload-image')) !!}
            {!! Form::file('image_file_path', null, array('class' => 'form-control')) !!}
            <p class="help-block">{{ trans('messages.allowed-types') }}</p>
        </div>

        {!! Form::submit(trans('messages.companies-add'),array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
    </div>

@stop
