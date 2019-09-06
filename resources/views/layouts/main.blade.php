<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ url('/')}}/libs/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/')}}/libs/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ url('/')}}/libs/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ url('/')}}/plugins/iCheck/all.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('/')}}/css/AdminLTE.min.css">

    <link rel="stylesheet" href="{{ url('/')}}/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="{{ url('/')}}/css/custom.css"
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    @include('templates.navbar')
    @include('templates.sidebar')
    @yield('content')
    @include('templates.footer')
  </div>

    @include('templates.common_js')

    <script>
    //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass   : 'iradio_flat-green'
        })
    </script>

    <script>
      $(document).ready(function(){
        setInterval(function(){

        }, 3000);
         $.post('/monitors/check', {_token: "{{ csrf_token() }}"}, null, 'json')
         .done(function(response){
           console.log(response)
         });
      });
    </script>
</body>
</html>
