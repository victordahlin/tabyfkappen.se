@extends('layouts.master')
@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (Session::has('email'))
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {{ Session::get('error') }}
        </div>
    @endif

    <form class="form-horizontal" method="POST" action="{!! url('/auth/login') !!}">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">{{ trans('messages.email') }}</label>
            <div class="col-sm-6">
                <input type="email" name="email" class="form-control" id="email" placeholder="{{ trans('messages.email') }}" value="{{ old('email') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">{{ trans('messages.password') }}</label>
            <div class="col-sm-6">
                <input type="password" name="password" class="form-control" id="password" placeholder="{{ trans('messages.password') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">{{ trans('messages.login-button') }}</button>
                <a href="{!! url('/password/email') !!}" class="btn btn-danger">{{ trans('messages.password-reminder-button') }}</a>
            </div>
        </div>
    </form>
@stop
