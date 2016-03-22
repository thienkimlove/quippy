<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Custom Fonts -->
    <link href="{{ url('/css/admin.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/css/select2.min.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>

<body>
<style type="text/css">
    body{
        background-color:rgb(57, 122, 183);
    }
    #wrapper{
        padding:15px;
    }
    h1{
        color: white;
    }

</style>

<div id="wrapper">

    {{--@include('admin.nav')--}}

    <div id="page-wrapper">
        {{--@include('flash::message')--}}
        @yield('content')
    </div>


</div>
<script>
    var Config = {};
    window.baseUrl = '{{url('/')}}';
</script>

<script src="{{url('/js/admin.js')}}"></script>
<script src="{{url('/bower_components/ckeditor/ckeditor.js')}}"></script>
<script src="{{url('/js/select2.min.js')}}"></script>
@yield('footer')
</body>

</html>
