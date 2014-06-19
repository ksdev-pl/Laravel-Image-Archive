@extends('base')

@section('title')
{{ 'Edit Category' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="active">{{{ $category->name }}}</li>
</ol>

{{ Form::open(['url' => '/categories/' . $category->id .'/update']) }}
    <div class="form-group">
        {{ Form::label('name', 'Category name') }}
        {{ Form::text('name', $category->name, ['class' => 'form-control', 'autofocus', 'required']) }}
    </div>
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
    <a href="/categories" class="btn btn-default">Cancel</a>
{{ Form::close() }}
@stop