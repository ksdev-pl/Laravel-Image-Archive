@extends('base')

@section('title')
{{ 'Upload Images' }}
@stop

@section('styles')
<link rel="stylesheet" href="/css/dropzone.css">
@stop

@section('scripts')
<script src="/js/dropzone.js"></script>
<script>
    Dropzone.options.imagesDropzone = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        acceptedFiles: "image/*",
        init: function() {
            this.on("totaluploadprogress", function(progress) {
                document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
            });
        }
    };
</script>
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li><a href="/categories/{{ $category->id }}/albums">{{{ $category->name }}}</a></li>
    <li><a href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images">{{{ $album->name }}}</a></li>
    <li class="active">New images</li>
</ol>

<a href="/categories/{{ $category->id }}/albums/{{ $album->id }}/images" class="btn btn-primary">
    <span class="glyphicon glyphicon-ok"></span> Done
</a>
<br><br>
<div id="total-progress" class="progress">
    <div class="progress-bar progress-bar-success" style="width: 0;" data-dz-uploadprogress></div>
</div>

{{ Form::open([
    'url' => '/categories/' . $category->id . '/albums/' . $album->id . '/images/create',
    'class' => 'dropzone',
    'id' => 'imagesDropzone',
    'files' => 'true'
]) }}
{{ Form::close() }}
@stop