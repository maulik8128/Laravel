// Common validation

$('form').each(function(index, element) {
    var clsname = element.className.split(' ');

    // "isautovalid" class in exist in form' class
    if(clsname.indexOf('isautovalid') != -1){
      var frmID = element.id;
      $("#"+frmID).validate({
          ignore: [],
          errorPlacement: function(error, element)
          {
              var text = element[0].className.split(' ');

              if(text.indexOf('ckeditor') != -1){
                  error.insertAfter('#cke_'+element.attr("id"));
                  var names = element.attr("id");

              } else if(text.indexOf('SumoUnder') != -1)
              {
                var text = element[0].className.split(' ');
                error.insertAfter('.sumo_'+element.attr("id"));
              } else if(text.indexOf('login_field') != -1){
                 error.insertAfter('.input-group-'+element.attr("name"));
              } else {
                error.insertAfter(element);
              }
              var element = $(element);
              element.addClass('is-invalid');
              error.addClass('invalid-feedback');
          }
      });
    }
});
$('#send_multiple_email').validate({
    rules:{
      user_id: {
        required: true,
      },
      send_by_email: {
        required:{
          depends: function(){
            if(!$('#download').is(':checked')){
                return true;
            }
          }
        }
      }
    },
    errorPlacement: function(error, element)
    {
      if (element.attr("id") == "user_id")
      {
        error.insertAfter('.sumo_user_id');
      }
      else
      {
        error.insertAfter(element);
      }
    },
    messages: {
      send_by_email: {
       required: "Please select at least one option",
      }
    },
});
$('#form_donate').validate({
    rules:{
      recurring_schedule: {
        required:{
          depends: function(){
            if($('#recurring').is(':checked')){
                return true;
            }
          }
        }
      },
      cycle_option: {
        required:{
          depends: function(){
            if($('#recurring').is(':checked')){
                return true;
            }
          }
        }
      },
      recurring_date: {
        required:{
          depends: function(){
            if($('#recurring').is(':checked')){
                return true;
            }
          }
        }
      },
      recurring_cycle: {
        required:{
          depends: function(){
            if($('#cycle_option').val() == 1){
                return true;
            }
          }
        }
      },

    }
});
$.validator.addMethod("email",function(value,element)
{
  value = value.trim();
  return this.optional(element) || /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value);
},"Please enter valid email address");
$.validator.addMethod("emailcustom",function(value,element)
{
  value = value.trim();
  return this.optional(element) || /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value);
},"Please enter valid email address");

// custom password strong
$.validator.addMethod("passwordstrong",function(value,element)
{
  return this.optional(element) || /^(?=.*[0-9])(?=.*[!@#$%^&*)(])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*)(]{8,}$/.test(value);
},"Passwords must contain at least 8 characters, including uppercase, lowercase letters, symbols and numbers.");

// custom password mid
$.validator.addMethod("passwordmid",function(value,element)
{
  return this.optional(element) || /^(?=.*\d)(?=.*[a-zA-Z])[A-Za-z\d@$!%*#?&]{6,}$/.test(value);
},"Password must be at least 6 characters long and include at least one letter,and a number.");

// custom password Low
$.validator.addMethod("passwordlow",function(value,element)
{
  return this.optional(element) || /^.{4,}$/.test(value);
},"Password must be at least 4 characters long");
// custom code for lesser than
jQuery.validator.addMethod('lesserThan', function(value, element, param) {
  return ( parseInt(value) <= parseInt(jQuery(param).val()) );
}, 'Must be less than' );

// custom code for greater than
$.validator.addMethod("greaterThan", function(value, element, param) {
  return ( parseInt(value) >= parseInt(jQuery(param).val()) );
}, "Must be greater than");

// custom phone
$.validator.addMethod("phonecustom",function(value,element)
{
  return this.optional(element) || /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/.test(value);
},"Please enter valid phone number.");

$.validator.addMethod("phoneUS",function(value,element)
{
  return this.optional(element) || /^([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})$/i.test(value);
},"Please enter valid number");
const isNumericInput = (event) => {
    const key = event.keyCode;
    return ((key >= 48 && key <= 57) || // Allow number line
        (key >= 96 && key <= 105) // Allow number pad
    );
};

const isModifierKey = (event) => {
    const key = event.keyCode;
    return (event.shiftKey === true || key === 35 || key === 36) || // Allow Shift, Home, End
        (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
        (key > 36 && key < 41) || // Allow left, up, right, down
        (
            // Allow Ctrl/Command + A,C,V,X,Z
            (event.ctrlKey === true || event.metaKey === true) &&
            (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
        )
};

const enforceFormat = (event) => {
    // Input must be of a valid number format or a modifier key, and not longer than ten digits
    if(!isNumericInput(event) && !isModifierKey(event)){
        event.preventDefault();
    }
};

const formatToPhone = (event) => {
    if(isModifierKey(event)) {return;}

    const target = event.target;
    const input = target.value.replace(/\D/g,'').substring(0,10); // First ten digits of input only
    const zip = input.substring(0,3);
    const middle = input.substring(3,6);
    const last = input.substring(6,10);

    if(input.length > 6){target.value = `(${zip}) ${middle}-${last}`;}
    else if(input.length > 3){target.value = `(${zip}) ${middle}`;}
    else if(input.length > 0){target.value = `(${zip}`;}
};

//email with comma
$.validator.addMethod("multiemail", function (value, element) {
    if (this.optional(element)) {
        return true;
    }
    var emails = value.split(','),
        valid = true;

    for (var i = 0, limit = emails.length; i < limit; i++) {
        value = jQuery.trim(emails[i])
        valid = valid && jQuery.validator.methods.email.call(this, value, element);
    }
    return valid;
}, "Invalid email format: please use a comma to separate multiple email addresses.");
//Submit Button Loader
$("form").on("submit", function(){
    if($(this).valid()){
        $(this).find('button[type="submit"]').addClass('submit_loader');
    }
    setTimeout(function(){
        $('form').find('button[type="submit"]').removeClass('submit_loader');
    },5000);
});
function price_format(price)
{
    return '$'+price.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$('.le_custom_editor').blur(function(){
    var ids = $(this).attr('data-id');
    var inner_html_apt = $(this).html();
    $(this).next().html(inner_html_apt);
    if($(this).html() == ''){
       $('#'+ids).removeClass('is-filled');
    }else{
       $('#'+ids).addClass('is-filled');
    }
});
function changeTabColor(tab_id,field_name)
{
    if($(field_name).val() == ''){
       $('#'+tab_id).removeClass('is-filled');
    }else{
       $('#'+tab_id).addClass('is-filled');
    }
}
//Card validation
function checkCardType(value,id){
    var lengthlimit = $('#'+id).attr("lengthlimit");
    var card_number = value.replace(/\s/g, '');
    var target = event.target;
    var key = event.keyCode || event.charCode;
    var position = target.selectionStart;
    var newval = '';
    if (card_number.length > parseInt(lengthlimit)) {
        card_number = card_number.substr( 0, card_number.length - 1 );
    }

    for(var i = 0; i < card_number.length; i++) {
        if(i%4 == 0 && i > 0) newval = newval.concat(' ');
        newval = newval.concat(card_number[i]);
    }
    $('#'+id).val(newval);
    if (newval != '') {
        $('#'+id).removeClass('highlight');
    }
    // setting the target position
    if ((position == 5 || position == 10 || position == 15) && (key !== 37 && key !== 39)) {
        position = position + 1;
    }
    if (newval.length > 15) {
        position = newval.length;
    }
    target.selectionEnd = position;
}
