@extends('_master')

@section('title')
    Moods
@stop

@section('head')
 
@stop

@section('content')

  
     <div style="text-align:center;">
     
<i style="color: #5cb85c" class="btn fa fa-smile-o fa-5x" data-toggle="tooltip" data-placement="bottom" title="Happy" onclick="moodSelected('happy')"></i>
<i style="color: #ec971f" class="btn fa fa-meh-o fa-5x" data-toggle="tooltip" data-placement="bottom" title="Meh" onclick="moodSelected('meh')"></i>
<i style="color: #d9534f" class="btn fa fa-frown-o fa-5x" data-toggle="tooltip" data-placement="bottom" title="Sad" onclick="moodSelected('sad')"></i>
    </div>
 <!--
   <form id="form-moods" method='post' action='/mood'>
    <i style="color: #d9534f" class="btn fa fa-frown-o fa-5x" onclick="moodSelected('sad'); document.getElementById('form_moods').submit(); return false;"></i>
  </form>



 <div id="panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <button onclick="changeRadius()">Change radius</button>
      <button onclick="changeOpacity()">Change opacity</button>
    </div>
-->
 <div style="display:none" id="info_flash" class='alert alert-info'></div>
<div id="current_location"></d>
    <div id="parent_container" style="width:100%; height:100%" >
      
   <!--<div style="height:450px; width: 1100px;"> </div>-->
    <div id="map-canvas"></div>
  </div>


      <script type="text/javascript">

var _map, _heatMap,_locations;
var _happy = 'happy';
var _sad = 'sad';
var _meh = 'meh';

var _sadgradient = [
'rgba(255, 0, 0, 0)',
'rgba(255, 0, 0, 0.1)',
'rgba(255, 0, 0, 0.2)',
'rgba(255, 0, 0, 0.3)',
'rgba(255, 0, 0, 0.4)',
'rgba(255, 0, 0, 0.5)',
'rgba(255, 0, 0, 0.6)',
'rgba(255, 0, 0, 0.7)',
'rgba(255, 0, 0, 0.8)',
'rgba(255, 0, 0, 0.9)',
'rgba(255, 0, 0, 1)'
  ];

   var _happygradient = [
'rgba(0, 255, 0, 0)',
'rgba(0, 255, 0, 0.1)',
'rgba(0, 255, 0, 0.2)',
'rgba(0, 255, 0, 0.3)',
'rgba(0, 255, 0, 0.4)',
'rgba(0, 255, 0, 0.5)',
'rgba(0, 255, 0, 0.6)',
'rgba(0, 255, 0, 0.7)',
'rgba(0, 255, 0, 0.8)',
'rgba(0, 255, 0, 0.9)',
'rgba(0, 255, 0, 1)'
  ];

   var _mehgradient = [
'rgba(255, 255, 0, 0)',
'rgba(255, 255, 0, 0.1)',
'rgba(255, 255, 0, 0.2)',
'rgba(255, 255, 0, 0.3)',
'rgba(255, 255, 0, 0.4)',
'rgba(255, 255, 0, 0.5)',
'rgba(255, 255, 0, 0.6)',
'rgba(255, 255, 0, 0.7)',
'rgba(255, 255, 0, 0.8)',
'rgba(255, 255, 0, 0.9)',
'rgba(255, 255, 0, 1)'
  ];


   var _defaultgradient = [
'rgba(0, 255, 0, 0)',
'rgba(0, 255, 0, 0.1)',
'rgba(0, 255, 0, 0.2)',
'rgba(0, 255, 0, 0.3)',
'rgba(0, 255, 0, 0.4)',
'rgba(0, 255, 0, 0.5)',
'rgba(0, 255, 0, 0.6)',
'rgba(0, 255, 0, 0.7)',
'rgba(0, 255, 0, 0.8)',
'rgba(0, 255, 0, 0.9)',
'rgba(0, 255, 0, 1)'
  ];





//(function($){ })(jQuery);
window.onload = loadScript;
//google.maps.event.addDomListener(window, 'load', initialize);

/*-----------------
resize window
--------------------*/
  $(window).resize(function () {
       //resizeMap();
    });


 $(document).ready(function () {
        
       resizeMap();

        //drawCustomMap(cLatLng.lat(), cLatLng.lng(), 3);
       
       
    });

/*-----------------
resizeMap
--------------------*/
function resizeMap()
{
   var height = $(window).height()-300;
    $("#parent_container").height(height);
}

/*-----------------
loadScript
--------------------*/
function loadScript() { 

  var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=visualization&' + 'callback=initialize';

  //script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&' + 'callback=initialize';

  document.body.appendChild(script);
}


     
/*-----------------
initialize
--------------------*/     
function initialize() {

var australia = new google.maps.LatLng(-25, 133);
var chicago = new google.maps.LatLng(41.948766, -87.691497);
var sanFrancisco  = new google.maps.LatLng(37.774546, -122.433523);

var mapcenter = sanFrancisco;

  //var mapOptions = {
   // zoom: 3,
   // center: mapcenter,
   //  mapTypeId: google.maps.MapTypeId.ROADMAP
    //mapTypeId: google.maps.MapTypeId.SATELLITE
 // };



  //_map = new google.maps.Map(document.getElementById('map-canvas'),
      //mapOptions);

  drawCustomMap(mapcenter.lat(), mapcenter.lng(), 3);


//wait for a second, then set heatmap
 sleep(1000, function () { 
getMoods();
        });



//render mood 
//renderMood(); 
//renderMood(_meh);
//renderMood(_happy);
 
 
}





 var _happylocations = [];
  var _sadlocations = [];
  var _mehlocations = [];

function getMoods()
{
 

  _locations = [];
  _happylocations = [];
  _sadlocations = [];
  _mehlocations = [];

 
   $.ajax({
     type: "get",
     dataType: 'json',
     url: '/mood',
           data: '',          
           success: function(data) {

                for (var mood in data.moods) 
                {
                  
                  var loc = data.moods[mood];
                //console.log(data.moods[mood]);

                var pos = new google.maps.LatLng(loc.lat, loc.lng);
                _locations.push({location: pos, weight: 1, mood: loc.mood});


                if(loc.mood == _happy)
                {
                  _happylocations.push(pos);
                }
                 if(loc.mood == _meh)
                {
                  _mehlocations.push(pos);
                }
                 if(loc.mood == _sad)
                {
                  _sadlocations.push(pos);
                }

               //var posArray  = [ { location:pos, weight: 1}];

                //setHeatMaps(loc.mood,posArray);
                     
                }

//we do thi in groups since individualy takes too long
                setHeatMaps(_sad,_sadlocations);
                 setHeatMaps(_meh,_mehlocations);
                 setHeatMaps(_happy,_happylocations);
              },
              error: function(xhr, status, error){               
              alert(error);
              }
            });



}

/*
function renderMood(mood)
{

//getdata
var data = getData(mood);
//sethetmaps
setHeatMaps(mood,data);

//fusion table
  //setFusionTableLayer();
}
*/
var currentlocationdiv = document.getElementById("current_location");

function getLocation() {
    if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(goToLocation);
    } else {
        currentlocationdiv.innerHTML = "Geolocation is not supported by this browser.";
    }
}

var _currentlocation;
function goToLocation(position) {

//var currentlocation = new google.maps.LatLng(-25, 133);
  _currentlocation  = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    //currentlocationdiv.innerHTML = "Latitude: " + position.coords.latitude +  "<br>Longitude: " + position.coords.longitude;

  _currentlocation = getRandomLocation().location;
 var data  = [ { location:_currentlocation, weight: 1}];
 _map.panTo(_currentlocation);

 //wait for a second, then set heatmap
 sleep(1000, function () { 
    //_map.setZoom(1);
    _map.setZoom(3);
        //sethetmaps
setHeatMaps(_mood,data); 

//save mood
saveMood();
        });

 
}

function getRandomLocation() {


  var locations= [
  //chicago
{location: new google.maps.LatLng(41.948766, -87.691497), weight: 1, mood: _happy},

 //los angels
{location: new google.maps.LatLng(34.052234, -118.243684), weight: 1, mood: _happy},

//brazil
{location: new google.maps.LatLng(-16.97274101999902 , -48.1640625), weight: 1, mood: _happy},

  //mexico
{location: new google.maps.LatLng(41.948766, -87.691497), weight: 1, mood: _happy},

//nairobi
{location: new google.maps.LatLng(-1.0546279422758742 , 39.375), weight: 1, mood: _happy},

//germany
{location: new google.maps.LatLng(52.511467, 13.447179), weight: 1, mood: _happy},

//san fransisco
{location: new google.maps.LatLng(37.785, -122.437), weight: 1, mood: _happy},


//chenai
{location: new google.maps.LatLng(15.623036831528264 , 78.22265625), weight: 1, mood: _happy},

 //moscow
{location: new google.maps.LatLng(50.736455137010665 , 25.751953125), weight: 1, mood: _happy},

 //london
{location: new google.maps.LatLng(52.482780222078205 , -1.7578125), weight: 1, mood: _happy},

 //new york
{location: new google.maps.LatLng(40.714352, -74.005973), weight: 1, mood: _happy},

 //spain
{location: new google.maps.LatLng(40.44694705960048 , -1.58203125), weight: 1, mood: _happy},

 //australia
  {location: new google.maps.LatLng(-25, 133), weight: 1, mood: _happy}

];


   return locations[Math.floor(Math.random() * _locations.length)];


}



//jQuery( document ).ready( function( $ ) {
 

 
//});


function saveMood()
{
    $.ajax({
     type: "post",
     dataType: 'json',
     url: '/mood/create',
           data: {"mood":_mood, "lat":_currentlocation.lat(),"lng":_currentlocation.lng()},          
           success: function(data) {
                //alert(data.data.lat);
              },
              error: function(xhr, status, error){               
              alert(error);
              }
            });
}

//moodSelected
var _mood;
var _minutes;
var _moodchange = 0;
function moodSelected(mood)
{


_moodchange = _moodchange +1;


var curdate = new Date();
var minutes = curdate.getMinutes();

if(_minutes)
{

var wait = minutes - _minutes;

if(wait<2 && _moodchange>3)
{

$("#info_flash").html("Research shows that a human being can only change their mood 3 times in 1 minute. Yeah, I made that up to avoid spam. Refresh your browser if you find this an interesting game. Only your most recent mood will be shown.");
$("#info_flash").show();
   return;
}

}
else
{
  _minutes  = minutes;
}

var msg = '';
switch(mood){
case 'happy': 
msg = 'Happy Like a room without a roof! Login to view and manage your mood history.';
break;
case 'sad': 
msg = 'Do not reply when you are angry, do not decide when you are sad. Hang in there buddy! Login to view and manage your mood history.';
break;
case 'meh': 
msg = 'Really? Login to view and manage your mood history.';
break;
default: 
msg = '';
break;
}

$("#info_flash").html(msg);
$("#info_flash").show();
 



_mood = mood;

getLocation();

  

}
   function sleep(millis, callback) {
        setTimeout(function ()
        { callback(); }
        , millis);
    }

function getGoogleLocation(lat, lon,weight)
{
return  {location: new google.maps.LatLng(lat, lon), weight: weight};
}

/*
function getData(mood)
{

    
var saddata  = [

//sanfransisco
  getGoogleLocation(37.782, -122.447), 
 {location: new google.maps.LatLng(37.782, -122.443), weight: 1},
  {location: new google.maps.LatLng(37.782, -122.441), weight: 1},
  {location: new google.maps.LatLng(37.782, -122.439), weight: 1}, 
  {location: new google.maps.LatLng(37.782, -122.435), weight: 1},
  {location: new google.maps.LatLng(37.785, -122.447), weight: 1},
  {location: new google.maps.LatLng(37.785, -122.445), weight: 1},
 
  {location: new google.maps.LatLng(37.785, -122.441), weight: 1},
 
  {location: new google.maps.LatLng(37.785, -122.437), weight: 1},
  {location: new google.maps.LatLng(37.785, -122.435), weight: 1},

  //moscow
{location: new google.maps.LatLng(50.736455137010665 , 25.751953125), weight: 1},

 //london
{location: new google.maps.LatLng(52.482780222078205 , -1.7578125), weight: 1},

 //new york
{location: new google.maps.LatLng(40.714352, -74.005973), weight: 1},

 //spain
{location: new google.maps.LatLng(40.44694705960048 , -1.58203125), weight: 1},


  ];


var  happydata= [
  //chicago
{location: new google.maps.LatLng(41.948766, -87.691497), weight: 1},

 //los angels
{location: new google.maps.LatLng(34.052234, -118.243684), weight: 1},

//brazil
{location: new google.maps.LatLng(-16.97274101999902 , -48.1640625), weight: 1},

  //mexico
{location: new google.maps.LatLng(41.948766, -87.691497), weight: 1},

//nairobi
{location: new google.maps.LatLng(-1.0546279422758742 , 39.375), weight: 1},

//germany
{location: new google.maps.LatLng(52.511467, 13.447179), weight: 1},

//san fransisco
{location: new google.maps.LatLng(37.785, -122.437), weight: 1},


//chenai
{location: new google.maps.LatLng(15.623036831528264 , 78.22265625), weight: 1}
];

var mehdata = [
 
 //australia
  {location: new google.maps.LatLng(-25, 133), weight: 1}
  
];

var data = happydata;

switch(mood){
case 'happy': 
data = happydata;
break;
case 'sad': 
data = saddata;
break;
case 'meh': 
data = mehdata;
break;
default: 
data = happydata;
break;
}

return data;

}*/

function drawCustomMap(lat, long, zoom) {
        var MY_MAPTYPE_ID = 'custom_style';
        var featureOpts = [
          {
              stylers: [
                //{ hue: '#890000' },
                { hue: 300 },
                { visibility: 'simplified' },
                { gamma: 1 },
                { weight: 0 }
              ]
          },
          {
              elementType: 'labels',
              stylers: [
                { visibility: 'on' }
                //, { color: '#A82828' }
              ]
          }
          ,
          {
              featureType: 'water',
              stylers: [
                //{ color: '#890000' }
              { color: '#D4D4D4' }

              ]
          }

        , {
            featureType: 'landscape',
            stylers: [
              //{ color: '#890000' }
            { color: '#E5E3DF' }

            ]
        }
        ];

        var mapOptions = {
            zoom: zoom,
            minZoom: 2,
            center: new google.maps.LatLng(lat, long),
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID],
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
            mapTypeId: MY_MAPTYPE_ID
            , disableDefaultUI: true
            ,zoomControl: true,
           
        };

        _map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        var styledMapOptions = {
            name: 'Custom Style'
        };

        var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

        _map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

    }



/*-----------------
setHeatMaps
--------------------*/

var _heatmap;

function setHeatMaps(mood,data)
{

_heatmap = new google.maps.visualization.HeatmapLayer({
 data: data
});



var gradient = _defaultgradient;

switch(mood){
case 'happy': 

gradient = _happygradient;
break;     
case 'sad': 
gradient = _sadgradient;
break;
case 'meh': 
gradient = _mehgradient;
break;
default: 
gradient = _defaultgradient;
break;
}

_heatmap.set('gradient',  gradient);
_heatmap.set('radius',  25);
_heatmap.setMap(_map);

}


function setFusionTableLayer()
{
  layer = new google.maps.FusionTablesLayer({
    query: {
      select: 'geometry',
      from: '1ertEwm-1bMBhpEwHhtNYT47HQ9k2ki_6sRa-UQ'
    },
    styles: [{
      polygonOptions: {
        fillColor: '#DDDDDD',
        fillOpacity: 0.3
      }
    }, {
      where: 'birds > 300',
      polygonOptions: {
        fillColor: 'red'
      }
    }, {
      where: 'population > 5',
      polygonOptions: {
        fillColor: '#000000',
        fillOpacity: 1.0
      }
    }]
  });
  
  layer.setMap(_map);
}

/*-----------------
toggleHeatmap
--------------------*/
function toggleHeatmap() {
  _heatmap.setMap(_heatmap.getMap() ? null : _map);
}

/*-----------------
changeGradient
--------------------*/
function changeGradient() {
  
  var gradient = [
    'rgba(0, 255, 255, 0)',
    'rgba(0, 255, 255, 1)',
    'rgba(0, 191, 255, 1)',
    'rgba(0, 127, 255, 1)',
    'rgba(0, 63, 255, 1)',
    'rgba(0, 0, 255, 1)',
    'rgba(0, 0, 223, 1)',
    'rgba(0, 0, 191, 1)',
    'rgba(0, 0, 159, 1)',
    'rgba(0, 0, 127, 1)',
    'rgba(63, 0, 91, 1)',
    'rgba(127, 0, 63, 1)',
    'rgba(191, 0, 31, 1)',
    'rgba(255, 0, 0, 1)'
  ]



  _heatmap.set('gradient', _heatmap.get('gradient') ? null : gradient);
}

/*-----------------
changeRadius
--------------------*/
function changeRadius() {
  _heatmap.set('radius', _heatmap.get('radius') ? null : 60);
}

/*-----------------
changeOpacity
--------------------*/
function changeOpacity() {
  _heatmap.set('opacity', _heatmap.get('opacity') ? null : 0.2);
}








    </script>
        
@stop

@section('footer')
   
@stop