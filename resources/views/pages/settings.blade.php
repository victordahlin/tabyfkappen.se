@extends('layouts.master')
@section('content')

    <h1>{{ trans('messages.settings') }}</h1>
    <hr>

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {{ Session::get('message') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {{ Session::get('error') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h3>{{ trans('messages.upload-codes')}}</h3>
    <br>

    {!! Form::open([
    'url' => 'settings/store',
    'class' => 'form-horizontal',
    'method' => 'POST',
    'files' => true
    ])  !!}
        <div class="form-group">
            <label for="file" class="col-sm-1 control-label"></label>
            <div class="col-sm-6">
                <input type="file" id="file" name="file">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-6">
                <button type="submit" class="btn btn-primary">Ladda upp fil</button>
            </div>
        </div>
    {!! Form::close() !!}

    <hr>
    <h3>{{ trans('messages.password-update')}}</h3>
    <br>

    {!! Form::open([
    'url' => 'settings/update',
    'class' => 'form-horizontal',
    'method' => 'POST',
    ])  !!}
    <div class="form-group">
            <label for="password" class="col-sm-1 control-label">{{ trans('messages.password')}}</label>
            <div class="col-sm-6">
                <input type="password" name="password" class="form-control" id="password" placeholder="{{ trans('messages.password')}}">
            </div>
        </div>
        <div class="form-group">
            <label for="repeatPassword" class="col-sm-1 control-label">{{ trans('messages.password')}}</label>
            <div class="col-sm-6">
                <input type="password" name="repeatPassword" class="form-control" id="repeatPassword" placeholder="{{ trans('messages.password')}}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-6">
                <button type="submit" class="btn btn-primary">{{ trans('messages.password-button')}}</button>
            </div>
        </div>
    </form>

@stop
