<!-- jQuery 3 -->
<script src="{{url('/')}}/libs/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('/')}}/libs/jquery-ui/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>


<script src="{{url('/')}}/libs/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="{{url('/')}}/plugins/iCheck/icheck.min.js"></script>

<!-- AdminLTE App -->
<script src="{{url('/')}}/js/adminlte.js"></script>

<script src="{{url('/')}}/js/custom.js"></script>

<script>
$(document).ready(function(e){
  $("#monitor-form button").click(function(e){
    console.log("sdfsdf");
  })
});
</script>
