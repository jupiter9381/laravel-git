$(document).ready(function(){
  $(".other-checkbox").on('ifChecked', function(){
    $(".other").css('display', 'block');
    $(".other").attr('disabled', false);
  });
  $(".other-checkbox").on('ifUnchecked', function(){
    $(".other").css('display', 'none');
    $('.other').attr('disabled', true);
  });

  $(".link").click(function(e){
    var url = $(this).attr('url');
    $(".code_field").html("");
    $.ajax({
			url : '/monitors/search_code',
      type : 'post',
      dataType : 'json',
      data: {url: url, "_token": $('meta[name="csrf-token"]').attr('content')},
      success: function(data){
      	$(".code_field").html(data.result);
      }
		})
  })
});
