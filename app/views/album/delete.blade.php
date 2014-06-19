@extends('base')

@section('title')
{{ 'Delete Album' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li><a href="/categories/{{ $category->id }}/albums">{{{ $category->name }}}</a></li>
    <li class="active">{{{ $album->name }}}</li>
</ol>

{{ Form::open([
    'url' => '/categories/' . $category->id . '/albums/' . $album->id . '/delete',
    'class' => 'alert alert-danger'
]) }}
    <div class="form-group">
        <p>Are you sure to delete <b>{{{ $album->name }}}</b> album?</p>
        <p>This will remove all related images!</p>
    </div>
    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
    <a href="/categories/{{ $category->id }}/albums" class="btn btn-default">Cancel</a>
{{ Form::close() }}
@stop