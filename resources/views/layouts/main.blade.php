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
        // $.post('/monitors/check', {_token: "{{ csrf_token() }}"}, null, 'json')
        //  .done(function(response){
        //    console.log(response);
        // });
        setInterval(function(){
          $.post('/monitors/notification', {_token: "{{ csrf_token() }}"}, null, 'json')
          .done(function(response){
            var notifications = response.result;
            $(".notification-count").html(notifications.length);
            $(".dropdown-toggle span.label-warning").html(notifications.length);
            $("ul.menu").html("");
            var html = "";
            for(var i = 0; i < notifications.length; i++){
              html += "<li monitor_id='"+notifications[i]['monitor_id']+"' class='notification-item'>";
              html +=    "<a href='/monitors/search/"+notifications[i]['monitor_id']+"'>";
              html +=        "<i class='fa fa-users text-aqua'></i>"+ "Monitor <strong>"
                             + notifications[i]['monitor_name'] + "</strong> has " + notifications[i]['count'] +" files.";
              html +=    "</a>";
              html += "</li>";
            }
            $("ul.menu").html(html);
          });
        }, 1000 * 20)

       $('ul.menu').on( 'click', '.notification-item', function () {
         $.post('/monitors/checkedNotification', {_token: "{{ csrf_token() }}", monitor_id: $(this).attr('monitor_id')}, null, 'json')
         .done(function(response){
         });
       });
       setInterval(function(){
         $.post('/monitors/check', {_token: "{{ csrf_token() }}"}, null, 'json')
          .done(function(response){
         });
       }, 60000 * 3)
       setInterval(function(){
         $.post('/monitors/emailCheck', {_token: "{{ csrf_token() }}"}, null, 'json')
         .done(function(response){
         });
       }, 60000)
      });
    </script>
</body>
</html>
