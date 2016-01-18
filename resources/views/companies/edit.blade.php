@extends('layouts.master')
@section('content')
    <div class="container">
        <a href="{!! url('companies') !!}" class="btn btn-danger">{{ trans('messages.back-button') }}</a>
        <h1>{{ trans('messages.edit') }} {!! $company->name !!}</h1>
        <hr>

        @if ($errors->has())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        {!! Form::model($company, array(
        'route' => array('companies.update', $company->id),
        'method' => 'PUT',
        'files' => true))  !!}

        <div class="form-group">
            {!! Form::label('category', trans('messages.categories-select')) !!}
            <select name="category_id" id="" class="form-control">
                @foreach($categories as $category)
                    <option value="{!! $category->id !!}" @if($company->category_id === $category->id) selected="selected" @endif>{!! $category->name !!}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <img src="{{ url('images/' . $company->image_file_path) }}" class="img-responsive" alt="">
        </div>

        <div class="form-group">
            {!! Form::label('name', trans('messages.name')) !!}
            {!! Form::text('name', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('url', trans('messages.url')) !!}
            {!! Form::text('url', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('address', trans('messages.address')) !!}
            {!! Form::text('address', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('mobile', trans('messages.mobile')) !!}
            {!! Form::text('mobile', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('opening_hours', trans('messages.opening-hours')) !!}
            {!! Form::textarea('opening_hours', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', trans('messages.email')) !!}
            {!! Form::text('email', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('long_term_deals', trans('messages.long_term_deals')) !!}
            {!! Form::text('long_term_deals', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('image_file_path', trans('messages.upload-image')) !!}
            {!! Form::file('image_file_path', null, array('class' => 'form-control')) !!}
            <p class="help-block">{{ trans('messages.allowed-types') }}</p>
        </div>

        {!! Form::submit('Uppdatera företaget',array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
    </div>
@stop
