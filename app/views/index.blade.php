@extends('_master')

@section('title')
    Developer's Best Friend
@stop

@section('head')
 
@stop

@section('content')

  
     <div style="text-align:center;">
     
<i style="color: #5cb85c" class="btn fa fa-smile-o fa-5x"></i>
<i style="color: #ec971f" class="btn fa fa-meh-o fa-5x"></i>
<i style="color: #d9534f" class="btn fa fa-frown-o fa-5x"></i>
    </div>

 
   <div style="height:450px; width: 1100px;"> 
    <div id="map-canvas"></div>
  </div>


      <script type="text/javascript">
     
function initialize() {
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644)
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
}

function loadScript() {
  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' +
      'callback=initialize';
  document.body.appendChild(script);
}

window.onload = loadScript;



    </script>
        
@stop

@section('footer')
   
@stop