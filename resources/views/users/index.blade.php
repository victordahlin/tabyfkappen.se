@extends('layouts.master')
@section('content')
    <h1>{{ trans('messages.users') }}</h1>

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
      <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <table class="table">
      <thead>
      <tr>
        <th>{{ trans('messages.first-name') }}</th>
        <th>{{ trans('messages.last-name') }}</th>
        <th>{{ trans('messages.email') }}</th>
        <th>{{ trans('messages.activation-code') }}</th>
        <th>{{ trans('messages.offers-used') }}</th>
        <th></th>
        <th></th>
      </tr>
      </thead>
      <tbody>
      @foreach($users as $key => $user)
        <tr>
          <td>{{ $user->first_name }}</td>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->activation_code }}</td>
          <td>{{ $used_offer[$key] }}</td>
          <td>
            {!! Form::open(['url' => 'users/' . $user->id,'class' => 'pull-right'])
            !!}
            {!! Form::hidden('_method', 'DELETE') !!}
            {!! Form::button('<span class="glyphicon glyphicon-remove"></span>',['class'=>'btn btn-default', 'type'=>'submit']) !!}
            {!! Form::close() !!}
          </td>
          <td>
            {!! Form::open(['url' => 'users/' . $user->id . '/edit']) !!}
            {!! Form::hidden('_method', 'GET') !!}
            {!! Form::button('<span class="glyphicon glyphicon-pencil"></span>',['class'=>'btn btn-default', 'type'=>'submit']) !!}
            {!! Form::close() !!}
          </td>
        </tr>
      @endforeach

      </tbody>
    </table>
@stop
