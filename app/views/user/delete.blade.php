@extends('base')

@section('title')
{{ 'Delete User' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li><a href="/users">Users</a></li>
    <li class="active">{{{ $user->email }}}</li>
</ol>

{{ Form::open([
    'url' => '/users/' . $user->id . '/delete',
    'class' => 'alert alert-danger'
]) }}
    <div class="form-group">
        <p>Are you sure to delete <b>{{{ $user->email }}}</b> user?</p>
    </div>
    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
    <a href="/users" class="btn btn-default">Cancel</a>
{{ Form::close() }}
@stop