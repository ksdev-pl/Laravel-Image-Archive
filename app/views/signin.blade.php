@extends('base')

@section('title')
{{ 'Sign In' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="active">Sign In</li>
</ol>

{{ Form::open(['url' => '/signin']) }}
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', Input::old('email'), ['class' => 'form-control', 'autofocus', 'required']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', ['class' => 'form-control', 'required']) }}
    </div>
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Sign In</button>
{{ Form::close() }}
@stop