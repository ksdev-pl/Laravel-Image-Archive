@extends('base')

@section('title')
{{ 'Delete Album' }}
@stop

@section('body')

<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li><a href="/categories/{{ $category->id }}/albums">{{{ $category->name }}}</a></li>
    <li><a href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images">{{{ $album->name }}}</a></li>
    <li class="active">{{{ $image->name }}}</li>
</ol>
<p>
    <a
        href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images/{{ $image->id }}"
        class="img-thumbnail popup"
        title="{{{ $image->description ? $image->description . '. ' : '' }}}Uploaded: {{ $image->created_at }}"
    >
        <img
            src="/categories/{{ $category->id }}/albums/{{ $album->id }}/images/{{ $image->id }}?thumb=true"
            alt="{{{ $image->name }}}"
        >
    </a>
</p>
{{ Form::open([
    'url' => '/categories/' . $category->id . '/albums/' . $album->id . '/images/' . $image->id . '/delete',
    'class' => 'alert alert-danger'
]) }}
    <div class="form-group">
        <p>Are you sure to delete <b>{{{ $image->name }}}</b> image?</p>
    </div>
    <button type="submit" class="btn btn-danger">
        <span class="glyphicon glyphicon-trash"></span> Delete
    </button>
    <a href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images" class="btn btn-default">Cancel</a>
{{ Form::close() }}

@stop