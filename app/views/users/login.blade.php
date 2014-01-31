@extends('layouts.master')

@section('sidebar')
@parent

<p>Here's some radical sidebar content</p>

@stop

@section('content')

<div class="row">
    <div class="small-12">
        {{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin')) }}
        <h2 class="form-signin-heading">Please Login</h2>

        {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
        {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}

        {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
        {{ Form::close() }}
    </div>
</div>

@stop