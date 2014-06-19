@extends('base')

@section('title')
{{ 'Edit Image' }}
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
    'url' => '/categories/' . $category->id . '/albums/' . $album->id . '/images/' . $image->id . '/update'
]) }}
    <div class="form-group">
        {{ Form::label('description', 'Image description') }}
        {{ Form::text('description', $image->description, ['class' => 'form-control', 'autofocus']) }}
    </div>
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
    <a href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images" class="btn btn-default">Cancel</a>
{{ Form::close() }}

@stop