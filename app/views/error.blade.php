@extends('base')

@section('title')
{{ 'Error' }}
@stop

@section('body')
<div class="alert alert-danger">{{ $error }}</div>
@stop