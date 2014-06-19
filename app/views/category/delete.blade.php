@extends('base')

@section('title')
{{ 'Delete Category' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="active">{{{ $category->name }}}</li>
</ol>

{{ Form::open([
    'url' => '/categories/' . $category->id . '/delete',
    'class' => 'alert alert-danger'
]) }}
    <div class="form-group">
        <p>Are you sure to delete <b>{{{ $category->name }}}</b> category?</p>
        <p>This will remove all related albums and images!</p>
    </div>
    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
    <a href="/categories" class="btn btn-default">Cancel</a>
{{ Form::close() }}
@stop