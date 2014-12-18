@extends('_master')

@section('title')
    Generate Lorem Ipsum
@stop

@section('head')
   
@stop

@section('content')
    <h4>My Moods</h4>
                <p>
                    Here are  recent moods:
                </p>
   

<hr/>

   
<div class="row">
<div class="col-md-4">
<b>Date</b>
</div>
<div class="col-md-4">
<b>Mood</b>
</div>
<div class="col-md-4">
<b>Delete</b>
</div>
</div>

<br/>
 @foreach ($moods as $mood) 


<div class="row">
<div class="col-md-4">
{{ $mood->created_at }}
</div>
<div class="col-md-4">
{{ $mood->mood }}
</div>
<div class="col-md-4">
		<a href='/mood/delete/{{$mood['id']}}'>Delete</a>

</div>
</div>

<br/>

@endforeach

   
@stop

@section('footer')
   
@stop