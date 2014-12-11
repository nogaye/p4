<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	 <title>@yield('title', "Developer's Best Friend")</title>
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

	 @yield('head')

</head>
<body class="container">

  

    <div class="header">
            
 <nav>
        <ul class="nav nav-pills pull-right">
        @if(Auth::check())
            <li><a href='/logout'>Log out {{ Auth::user()->email; }}</a></li>
            <li><a href='/book'>All Books</a></li>
            <li><a href='/book/search'>Search Books (w/ Ajax)</a></li>
            <li><a href='/tag'>All Tags</a></li>
            <li><a href='/book/create'>+ Add Book</a></li>
            <li><a href='/debug/routes'>Routes</a></li>
        @else           
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/users">Users</a></li>
            <li><a href="/loremipsum">Lorem Ipsum</a></li>
             <li><a href='/debug'>Debug</a></li>
              <li><a href='/mood/create'>+ Add Book</a></li>
            <li><a href='/signup'>Sign up</a></li>
            <li><a href='/login'>Log in</a></li>
        @endif
        </ul>
    </nav>

            <h3 class="text-muted"> <span  class="fa fa-heart-o fa-3x"></span> <b>Moods</b>: How are you feeling today?</h3>
            <hr/>
              @if(Session::get('flash_message'))
        <div class='alert alert-warning'>{{ Session::get('flash_message') }}</div>
    @endif
        </div>




 <div class="container body-content">
       
@yield('content')

    </div>



 <div  class="container footer  navbar-fixed-bottom">
    <hr/>
            <p>© Nicholas Ogaye 2014</p>
            @yield('footer')
        </div>


  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js' type='text/javascript'></script>

</body>
</html>


