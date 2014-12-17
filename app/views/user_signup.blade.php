@extends('_master')

@section('title')
	Log in
@stop

@section('content')
<!--<h1>Sign up</h1>



{{ Form::open(array('url' => '/signup')) }}

 	{{ Form::label('First Name') }}
    {{ Form::text('first_name') }}

    {{ Form::label('Last Name') }}
    {{ Form::text('last_name') }}

    {{ Form::label('email') }}
    {{ Form::text('email') }}

    {{ Form::label('password') }}
    {{ Form::password('password') }}
    <small>Min 6 characters</small>

    {{ Form::submit('Submit') }}

{{ Form::close() }}
-->

<div class="container">
    @foreach($errors->all() as $message)
    <div class='alert alert-danger'>{{ $message }}</div>
@endforeach
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><span class="glyphicon glyphicon-user"></span>Sign Up</h3>

</div>
<div class="panel-body">

{{ Form::open(array('url' => '/signup')) }}

<div class="row">
<div class="col-md-6">
{{ Form::label('first_name','First Name', array('class' => 'col-md-6 control-label')) }}:
</div>
<div class="col-md-6">
{{ Form::text('first_name','', array('class' => 'col-md-6 form-control')) }}
</div>
</div>

<br/>
<br/>

<div class="row">
<div class="col-md-6">
{{ Form::label('last_name','Last Name', array('class' => 'col-md-6 control-label')) }}:
</div>
<div class="col-md-6">
{{ Form::text('last_name','', array('class' => 'col-md-6 form-control')) }}
</div>
</div>

<br/>
<br/>

<div class="row">
<div class="col-md-6">
{{ Form::label('email','Email Address', array('class' => 'col-md-6 control-label')) }}:
</div>
<div class="col-md-6">
{{ Form::text('email','', array('class' => 'col-md-6 form-control')) }}
</div>
</div>

<br/>
<br/>

<div class="row">
<div class="col-md-6">
{{ Form::label('password','Password', array('class' => 'col-md-6 control-label')) }}: 
</div>
<div class="col-md-6">
{{ Form::password('password','', array('class' => 'col-md-6 form-control')) }}
 <small>Min 6 characters</small>
</div>
</div>

<br/>
<br/>
{{ Form::submit('Sign Up', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
</div>
<div class="panel-footer">
</div>

</div>
</div>







@stop