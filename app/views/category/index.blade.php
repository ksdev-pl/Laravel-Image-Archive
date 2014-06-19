@extends('base')

@section('title')
{{ 'Categories' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li class="active"><span class="glyphicon glyphicon-home"></span></li>
</ol>
<a href="/categories/create" class="add-btn btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span> Create category
</a>
<table id="categories" class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Category name</th>
        <th>Created</th>
        <th>Updated</th>
        @if ((int) Auth::user()->role !== User::RESTRICTED)
        <th class="action">Action</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach ($categories as $category)
    <tr>
        <td>
            <a href="/categories/{{ $category->id }}/albums">{{{ $category->name }}}</a>
        </td>
        <td>
            {{ $category->created_at }}
        </td>
        <td>
            {{ $category->updated_at }}
        </td>
        @if ((int) Auth::user()->role !== User::RESTRICTED)
        <td>
            <a href="/categories/{{ $category->id }}/update" class="btn btn-primary btn-xs">
                <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <a href="/categories/{{ $category->id }}/delete" class="btn btn-danger btn-xs">
                <span class="glyphicon glyphicon-trash"></span> Delete
            </a>
        </td>
        @endif
    </tr>
    @endforeach
    </tbody>
</table>
@stop