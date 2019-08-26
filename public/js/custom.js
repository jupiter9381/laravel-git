$(document).ready(function(){
  console.log("sdfsdf");
  $(".other-checkbox").on('ifChecked', function(){
    $(".other").css('display', 'block');
  });
  $(".other-checkbox").on('ifUnchecked', function(){
    $(".other").css('display', 'none');
  });
});
