/*!
 * Password Element v0.10
 */
$(".toggle-password").click(function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
//custome password with blur function
$('.custom_password input').blur(function(){
    if($(this).hasClass('error')){
      $(this).parent().find('.field-icon').hide();
    }else{
      $(this).parent().find('.field-icon').show();
    }
});
//custom password with form submit 
$("form").on("submit", function(){
    if($(this).valid()){
        $(this).parent().find('.field-icon').show();
    }else{
        if($('.custom_password input').hasClass('is-invalid')){
          $(this).parent().find('.field-icon').hide();
        }else{
          $(this).parent().find('.field-icon').show();
        }
    } 
});