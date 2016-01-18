@extends('layouts.master')
@section('content')
    <div class="container">
        <a href="{!! url('information') !!}" class="btn btn-danger">{{ trans('messages.back-button') }}</a>
        <hr>

        @if ($errors->has())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        {!! Form::model($info, array(
        'route' => array('information.update', $info->id),
        'method' => 'PUT'))  !!}

        <div class="form-group">
            {!! Form::label('app', trans('messages.information-app')) !!}
            {!! Form::textarea('app', null, array('class' => 'form-control')) !!}
        </div>

        <div class="form-group">
            {!! Form::label('tabyfk', trans('messages.information-tabyfk')) !!}
            {!! Form::textarea('tabyfk', null, array('class' => 'form-control')) !!}
        </div>

        {!! Form::submit('Uppdatera information',array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
    </div>
@stop
