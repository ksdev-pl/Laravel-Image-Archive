@extends('base')

@section('title')
{{ 'Edit User' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li><a href="/users">Users</a></li>
    <li class="active">{{{ $user->email }}}</li>
</ol>

{{ Form::open(['url' => '/users/' . $user->id .'/update']) }}
    <div class="form-group">
        {{ Form::label('email', 'User email') }}
        {{ Form::email('email', $user->email, ['class' => 'form-control', 'autofocus', 'required']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'User password') }}
        {{ Form::password('password', ['class' => 'form-control', 'required']) }}
    </div>
    <div class="form-group">
        {{ Form::label('role', 'User role') }}
        {{ Form::select(
            'role', [
                '3' => 'Restricted',
                '2' => 'Normal',
                '1' => 'Admin'
            ],
            $user->role,
            ['class' => 'form-control']
        ) }}
        <p class="help-block">
            <b>Restricted</b> - Upload only / <b>Normal</b> - Upload, Edit &amp; Delete / <b>Admin</b> - Manage Users
        </p>
    </div>
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
    <a href="/users" class="btn btn-default">Cancel</a>
{{ Form::close() }}
@stop