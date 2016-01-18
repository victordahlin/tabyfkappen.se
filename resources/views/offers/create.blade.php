@extends('layouts.master')
@section('content')

    <div class="container">
        <a href="{!! url('offers') !!}" class="btn btn-danger">{{ trans('messages.back-button') }}</a>
        <h1>{{ trans('messages.offers-add') }}</h1>
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

        {!! Form::open(array('url' => 'offers'))  !!}

        <div class="form-group">
            {!! Form::label('company', trans('messages.companies-select')) !!}
            <select name="company_id" id="" class="form-control">
                @foreach($companies as $company)
                    <option value="{!! $company->id !!}">{!! $company->name !!}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {!! Form::label('name', trans('messages.name')) !!}
            {!! Form::text('name', old('name'), array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', trans('messages.description')) !!}
            {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('end_date', trans('messages.end-date')) !!}
            {!! Form::text('end_date', null, array('class' => 'form-control', 'id' => 'datepicker')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('is_super_deal', trans('messages.super-deal')) !!}
            {!! Form::radio('is_super_deal') !!}
            <br>
            {!! Form::label('is_super_deal', trans('messages.temporary-deal')) !!}
            {!! Form::radio('is_super_deal') !!}
        </div>

        <div class="form-group">
            {!! Form::label('image_file_path', trans('messages.upload-image')) !!}
            {!! Form::file('image_file_path', null, array('class' => 'form-control')) !!}
            <p class="help-block">{{ trans('messages.allowed-types') }}</p>
        </div>

        <div class="form-group">
            <br>
            {!! Form::submit(trans('messages.offers-add'),array('class' => 'btn btn-primary')) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop
