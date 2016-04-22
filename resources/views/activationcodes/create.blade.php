@extends('layouts.master')
@section('content')

    <div class="container">
        <a href="{!! url('activation-codes') !!}" class="btn btn-danger">{{ trans('messages.back-button') }}</a>
        <h1>{{ trans('messages.activation-codes-add') }}</h1>
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
        'url' => 'activation-codes',
        'method' => 'POST',
        'files' => true
        ])  !!}

        <div class="form-group">
            {!! Form::label('code', trans('messages.activation-code')) !!}
            {!! Form::text('code', null, array(
                'class' => 'form-control',
                'placeholder' => '10101..'

            )) !!}
        </div>

        {!! Form::submit(trans('messages.activation-codes-add'),array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}

    </div>

@stop
