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
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {{ Session::get('error') }}
        </div>
    @endif

    <form class="form-horizontal" method="POST" action="{!! url('/password/reset') !!}">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-6">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Lösenord</label>
            <div class="col-sm-6">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Bekräfta lösenord</label>
            <div class="col-sm-6">
                <input type="password" name="password_confirmation" class="form-control" id="password" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Återställ lösenord</button>
            </div>

        </div>
    </form>

@stop
