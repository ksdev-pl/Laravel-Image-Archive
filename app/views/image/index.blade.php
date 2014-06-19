@extends('base')

@section('title')
{{ 'Images' }}
@stop

@section('body')

<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li><a href="/categories/{{ $category->id }}/albums">{{{ $category->name }}}</a></li>
    <li class="active">{{{ $album->name }}}</li>
</ol>

<a href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images/create" class="add-btn btn btn-primary">
    <span class="glyphicon glyphicon-plus"></span> Upload new images
</a>
<div class="row">
    @foreach ($images as $image)
    <div class="col-xs-4 col-md-3">

        <a
            href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images/{{ $image->id }}"
            class="thumbnail popup"
            title="{{{ $image->description ? $image->description . '. ' : '' }}}Uploaded: {{ $image->created_at }}"
        >
            <img
                src="/categories/{{ $category->id }}/albums/{{ $album->id }}/images/{{ $image->id }}?thumb=true"
                alt="{{{ $image->name }}}"
            >
        </a>

        @if ((int) Auth::user()->role !== User::RESTRICTED)
        <div class="img-btn pull-right">
            <a
                href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images/{{ $image->id }}"
                class="btn btn-primary btn-xs"
                download="{{{ $image->name }}}"
            >
                <span class="glyphicon glyphicon-download"></span> Download
            </a>
            <a
                href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images/{{ $image->id }}/update"
                class="btn btn-primary btn-xs"
            >
                <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
            <a
                href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images/{{ $image->id }}/delete"
                class="btn btn-danger btn-xs"
            >
                <span class="glyphicon glyphicon-trash"></span> Delete
            </a>
        </div>
        @endif

    </div>
    @endforeach
</div>

@stop