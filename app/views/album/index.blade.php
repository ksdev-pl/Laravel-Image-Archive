@extends('base')

@section('title')
{{ 'Albums' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="active">{{{ $category->name }}}</li>
</ol>
<a href="/categories/{{ $category->id }}/albums/create" class="add-btn btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span> Create album
</a>
<table id="albums" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Album name</th>
        <th>Created</th>
        <th>Updated</th>
        @if ((int) Auth::user()->role !== User::RESTRICTED)
        <th class="action">Action</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach ($albums as $album)
    <tr>
        <td>
            <a href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images">{{{ $album->name }}}</a>
        </td>
        <td>
            {{ $album->created_at }}
        </td>
        <td>
            {{ $album->updated_at }}
        </td>
        @if ((int) Auth::user()->role !== User::RESTRICTED)
        <td>
            <a href="/categories/{{ $category->id }}/albums/{{ $album->id }}/update" class="btn btn-primary btn-xs">
                <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <a href="/categories/{{ $category->id }}/albums/{{ $album->id }}/delete" class="btn btn-danger btn-xs">
                <span class="glyphicon glyphicon-trash"></span> Delete
            </a>
        </td>
        @endif
    </tr>
    @endforeach
    </tbody>
</table>
@stop