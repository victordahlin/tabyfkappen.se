@extends('layouts.master')
@section('content')

    <div class="container">
        <a href="{!! url('activation-codes') !!}" class="btn btn-danger">{{ trans('messages.back-button') }}</a>
        <h1>{{ trans('messages.edit') }} {{ $activationCode->code }}</h1>
        <hr>

        @if ($errors->has())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        {!! Form::model($activationCode, array(
        'route' => array('activation-codes.update', $activationCode->id),
        'method' => 'PUT',
        'files' => true)) !!}

        <div class="form-group">
            {!! Form::label('code', trans('messages.activation-code')) !!}
            {!! Form::text('code', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('is_used', trans('messages.is-used')) !!}
            {!! Form::text('is_used', $used, array('class' => 'form-control')) !!}
        </div>

        {!! Form::submit(trans('messages.update-button'),array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
    </div>

@stop
