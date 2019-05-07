<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="{{asset("css/materialize.min.css")}}"  media="screen,projection"/>
<link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
<!-- <link rel="stylesheet" type="text/css" href="{{asset("css/bootstrap-dropdownhover.css")}}"> -->
<!-- <link rel="stylesheet" type="text/css" href="{{asset("css/style.css")}}"> -->
<link rel="stylesheet" type="text/css" href="{{asset("css/ie.css")}}">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>hey bro</title>
</head>
<body>
@include('widgets.navbar_links')
@yield('content')
<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="{{asset("js/jquery-2.1.1.min.js")}}"></script>
<script type="text/javascript" src="{{asset("js/materialize.min.js")}}"></script>
<script type="text/javascript" src="{{asset("js/responsive-nav.js")}}"></script>
<script type="text/javascript" src="{{asset("js/app.js")}}"></script>
<script type="text/javascript" src="{{asset("js/bootstrap-dropdownhover.min.js")}}"></script>
<script>
    $('select').material_select();
</script>
</body>
</html>