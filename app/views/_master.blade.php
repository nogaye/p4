<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	 <title>@yield('title', "Moods")</title>
	   <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css" />
    <!-- Google fonts-->
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine" />
	 <link rel='stylesheet' href='{{ asset('css/site.css') }}'>

    <style type="text/css">
      html, body, #map-canvas { height: 100%; margin: 0; padding: 0;}
    </style>

     <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js' type='text/javascript'></script>

	 @yield('head')

</head>
<!-- <body  class="container">-->
<body style="margin:20px">

  

    <div class="header">
            
 <nav>
        <ul class="nav nav-pills pull-right">
            <li class="active"><a href="/">Home</a></li>
            <li><a href='/debug'>Debug</a></li>
        @if(Auth::check())
           <!-- 
            <li><a href='/book'>All Books</a></li>
            <li><a href='/book/search'>Search Books (w/ Ajax)</a></li>
            <li><a href='/tag'>All Tags</a></li>
            <li><a href='/book/create'>+ Add Book</a></li>
            <li><a href='/debug/routes'>Routes</a></li>
        -->
        <li><a href='/mymood'>My Moods</a></li>
        <li><a href='/logout'>Log Out: {{ Auth::user()->first_name; }}</a></li>
        @else           
            
           <!-- <li><a href="/users">Users</a></li>
            <li><a href="/loremipsum">Lorem Ipsum</a></li>
            <li><a href='/debug'>Debug</a></li>
            <li><a href='/mood/create'>+ Add Book</a></li> -->
            <li><a href='/signup'>Sign Up</a></li>
            <li><a href='/login'>Log In</a></li>
        @endif
        </ul>
    </nav>

             <h3 class="text-muted" style="color:#2d6ca2"> <span  class="fa fa-users fa-3x"></span>
             <b style="color:#5cb85c">M</b>oo<b style="color:#ec971f">d</b><b style="color:#d9534f">s</b>: How are you feeling today?</h3>
            <hr/>
              @if(Session::get('flash_message'))
        <div class='alert alert-warning'>{{ Session::get('flash_message') }}</div>
    @endif
        <div style="display:none" id="info_flash" class='alert alert-warning'></div>
        </div>




 <div id="content_container" class="body-content" >
       <!-- <div id="content_container" class="container body-content">-->
@yield('content')

    </div>



 <div  style="margin:20px" class="footer  navbar-fixed-bottom">
    <hr/>
            <p>© Nicholas Ogaye 2014</p>
            @yield('footer')
        </div>


 

 

</body>
</html>


