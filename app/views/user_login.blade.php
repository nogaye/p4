@extends('_master')

@section('title')
Log in
@stop

@section('content')

<div class="container">
<div class="panel panel-primary">
<div class="panel-heading">
<h3 class="panel-title"><span class="glyphicon glyphicon-lock"></span>Log In</h3>

</div>
<div class="panel-body">

{{ Form::open(array('url' => '/login')) }}

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

</div>
</div>

<br/>
<br/>
{{ Form::submit('Log In', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
</div>
<div class="panel-footer">
</div>

</div>
</div>
@stop