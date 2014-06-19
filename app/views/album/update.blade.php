@extends('base')

@section('title')
{{ 'Edit Album' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li><a href="/categories/{{ $category->id }}/albums">{{{ $category->name }}}</a></li>
    <li class="active">{{{ $album->name }}}</li>
</ol>

{{ Form::open(['url' => '/categories/' . $category->id . '/albums/' . $album->id . '/update']) }}
    <div class="form-group">
        {{ Form::label('name', 'Album name') }}
        {{ Form::text('name', $album->name, ['class' => 'form-control', 'autofocus', 'required']) }}
    </div>
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
    <a href="/categories/{{ $category->id }}/albums" class="btn btn-default">Cancel</a>
{{ Form::close() }}
@stop