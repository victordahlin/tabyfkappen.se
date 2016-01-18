@extends('layouts.master')
@section('content')

    <div class="container">
        <a href="{!! url('users') !!}" class="btn btn-danger">{{ trans('messages.back-button') }}</a>
        <h1>{{ trans('messages.edit') }} {!! $user->first_name !!}</h1>
        <hr>

        @if ($errors->has())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT'])  !!}

        <div class="form-group">
            {!! Form::label('first_name', trans('messages.first-name')) !!}
            {!! Form::text('first_name', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('last_name', trans('messages.last-name')) !!}
            {!! Form::text('last_name', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', trans('messages.email')) !!}
            {!! Form::text('email', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('activation_code', trans('messages.activation-code')) !!}
            {!! Form::text('activation_code', null, array('class' => 'form-control')) !!}
        </div>

        {!! Form::submit(trans('messages.users-update'),array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
    </div>

@stop
