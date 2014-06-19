@extends('base')

@section('title')
{{ 'Create Category' }}
@stop

@section('body')
<ol class="breadcrumb">
    <li><a href="/categories"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="active">New category</li>
</ol>

{{ Form::open(['url' => '/categories/create']) }}
    <div class="form-group">
        {{ Form::label('name', 'Category name') }}
        {{ Form::text('name', Input::old('name'), ['class' => 'form-control', 'autofocus', 'required']) }}
    </div>
    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
    <a href="/categories" class="btn btn-default">Cancel</a>
{{ Form::close() }}
@stop