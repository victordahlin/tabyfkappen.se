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

    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {{ Session::get('error') }}
        </div>
    @endif

    @if (Session::has('status'))
        <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {{ Session::get('status') }}
        </div>
    @endif

    <form class="form-horizontal" method="POST" action="{!! url('/password/email') !!}">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-6">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Återställ lösenordet</button>
            </div>
        </div>
    </form>

@stop
