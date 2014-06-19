@extends('base')

@section('title')
{{ 'Manage Users' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="active">Users</li>
</ol>
<a href="/users/create" class="add-btn btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create user</a>
<table id="users" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>User email</th>
        <th>Role</th>
        <th>Created</th>
        <th>Updated</th>
        <th class="action">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
    <tr>
        <td>
            {{{ $user->email }}}
        </td>
        <td>
            @if ($user->role == User::ADMIN)
            {{ 'Admin' }}
            @elseif ($user->role == User::NORMAL)
            {{ 'Normal ' }}
            @elseif ($user->role == User::RESTRICTED)
            {{ 'Restricted' }}
            @endif
        </td>
        <td>
            {{ $user->created_at }}
        </td>
        <td>
            {{ $user->updated_at }}
        </td>
        <td>
            <a href="/users/{{ $user->id }}/update" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
            <a href="/users/{{ $user->id }}/delete" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span> Delete</a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop