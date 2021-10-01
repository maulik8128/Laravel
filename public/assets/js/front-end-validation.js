// Common validation

$('form').each(function(index, element) {

    var clsname = element.className.split(' ');

    // "isautovalid" class in exist in form' class

    if(clsname.indexOf('isautovalid') != -1){

      var frmID = element.id;    

      if (frmID != 'cardform') {
        $("#"+frmID).validate({

            errorElement: 'div',

            ignore: [],

            errorPlacement: function(error, element) 

            {

                var text = element[0].className.split(' ');
               
                if(text.indexOf('ckeditor') != -1){
                    error.insertAfter('#cke_'+element.attr("name"));
                    var names = element.attr("name");
                    
                } else if(text.indexOf('SumoUnder') != -1)
                {
                  var text = element[0].className.split(' ');
                  error.insertAfter('.sumo_'+element.attr("id"));
                } else if(text.indexOf('login_field') != -1){
                   error.insertAfter('.input-group-'+element.attr("name"));
                } else if(text.indexOf('select2') != -1){
                  var ids = element.attr('id');
                  var cls = $('#'+ids).next('.select2-container'); 
                  error.insertAfter(cls); 
                }else {
                  error.insertAfter(element);
                }
                var element = $(element);
                element.addClass('is-invalid');
                error.addClass('invalid-feedback');

            }

        });
      }

    }

});

$("#cardform").validate({
    onfocusout: function(element) {
        this.element(element);
    },
});
// admin email exist check

function checkEmailExist(Email)

{

  $.ajax({

    type: "POST",

    url: BASEURL+"home/checkEmailExist",

    data: 'Email=' + Email,

    cache: false,

    success: function(html) {

      if(html > 0){

        $('#EmailExist').show();

        $('#EmailExist').html('This email is already assigned to an account. Please <div class="login-page-link">login</div> instead.');        

        $(".login-page-link").click(function () {

          $(".box-container").toggleClass("log-in");

        });

        $('#sign_up_now').prop("disabled",true);

      } else {

        $('#EmailExist').html("");

        $('#EmailExist').hide();        

        $('#sign_up_now').prop("disabled",false);

      }

    },

    error: function(XMLHttpRequest, textStatus, errorThrown) {                 

      $('#EmailExist').show();

      $('#EmailExist').html(errorThrown);

    }

  });

}

function checkEmailExistMyAcc(Email,UserID)

{

  $.ajax({

    type: "POST",

    url: BASEURL+"my_account/checkEmailExistMyAcc",

    data: 'Email=' + Email+'&UserID=' + UserID,

    cache: false,

    success: function(html) {

      if(html > 0)

      {

        $('#EmailExist').show();

        $('#EmailExist').html('This email is already assigned to an account.');        

        $('#update_profile').prop("disabled",true);

      } 

      else 

      {

        $('#EmailExist').html("");

        $('#EmailExist').hide();        

        $('#update_profile').prop("disabled",false);

      }

    },

    error: function(XMLHttpRequest, textStatus, errorThrown) {                 

      $('#EmailExist').show();

      $('#EmailExist').html(errorThrown);

    }

  });

}


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
    //var newval = val.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();

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

$('#CreditCardNumber').keypress(function(e) {
    //var max = 19;
    var lengthlimit = $('#CreditCardNumber').attr("lengthlimit");
    var max = parseInt(lengthlimit) + parseInt(3);
    if (this.value.length == max) {
        e.preventDefault();
    } else if (this.value.length > max) {
        // Maximum exceeded
        var to_val = parseInt(max) - parseInt(1);
        this.value = this.value.substring(0, parseInt(to_val));
    }
});

$('#card_number').keypress(function(e) {
    //var max = 19;
    var lengthlimit = $('#card_number').attr("lengthlimit");
    var max = parseInt(lengthlimit) + parseInt(3);
    if (this.value.length == max) {
        e.preventDefault();
    } else if (this.value.length > max) {
        // Maximum exceeded
        var to_val = parseInt(max) - parseInt(1);
        this.value = this.value.substring(0, parseInt(to_val));
    }
});

// custom code for max 15 chars credit card
$.validator.addMethod('maxfifteen', function(value,element) {  
  var value = value.replace(/\s/g, '');
  var length = $.isArray( value ) ? value.length : this.getLength($.trim(value), element);
  return this.optional(element) || length <= 15;
}, 'Please enter no more than 15 characters.' );

// custom code for min 15 chars credit card
$.validator.addMethod('minfifteen', function(value,element) {  
  var value = value.replace(/\s/g, '');
  var length = $.isArray( value ) ? value.length : this.getLength($.trim(value), element);
  return this.optional(element) || length >= 15;
}, 'Please enter at least 15 characters.' );

// custom code for max 16 chars credit card
$.validator.addMethod('maxsixteen', function(value,element) {  
  var value = value.replace(/\s/g, '');
  var length = $.isArray( value ) ? value.length : this.getLength($.trim(value), element);
  return this.optional(element) || length <= 16;
}, 'Please enter no more than 16 characters.' );

// custom code for min 16 chars credit card
$.validator.addMethod('minsixteen', function(value,element) {  
  var value = value.replace(/\s/g, '');
  var length = $.isArray( value ) ? value.length : this.getLength($.trim(value), element);
  return this.optional(element) || length >= 16;
}, 'Please enter at least 16 characters.' );

// custom code for min 16 chars credit card
$.validator.addMethod('cardnumber', function(value,element) {  
  var value = value.replace(/\s/g, '');
  return this.optional(element) || /^\d+$/.test(value);
}, 'Please enter only digits.' );


$.validator.addMethod("emailcustom",function(value,element)

{

  return this.optional(element) || /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i.test(value);

},"Please enter valid email address");



// custom password

$.validator.addMethod("passwordcustome",function(value,element)

{

  return this.optional(element) || /^(?=.*[0-9])(?=.*[a-z])[a-zA-Z0-9!@#$%^&*)(]{8,}$/.test(value);

},"Required 8 characters, including lowercase letters and numbers.");



$.validator.addMethod("amazonOrderNumber",function(value,element)

{

  return this.optional(element) || /^([0-9]{17})|([0-9]{3}\-[0-9]{7}\-[0-9]{7})$/i.test(value);

},"Please enter valid Amazon Order Number");



$.validator.addMethod("simNumberValidation",function(value,element)

{

  return this.optional(element) || /^([0-9]{19})([F]{1})$/i.test(value);

},"Please enter 19 numbers with the letter F at the end.");



// custom code for lesser than

jQuery.validator.addMethod('lesserThan', function(value, element, param) {  

  return ( parseInt(value) <= parseInt(jQuery(param).val()) );

}, 'Must be less than' );



// custom code for greater than

$.validator.addMethod("greaterThan", function(value, element, param) {

  return ( parseInt(value) >= parseInt(jQuery(param).val()) );    

}, "Must be greater than");

// end here





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



const formatToAmazonOrderNo = (event) => {

    if(isModifierKey(event)) {return;}



    // I am lazy and don't like to type things more than once

    const target = event.target;

    const input = target.value.replace(/\D/g,'').substring(0,17); // First ten digits of input only

    const zip = input.substring(0,3);

    const middle = input.substring(3,10);

    const last = input.substring(10,17);



    if(input.length > 10){target.value = `${zip}-${middle}-${last}`;}

    else if(input.length > 3){target.value = `${zip}-${middle}`;}

    else if(input.length > 0){target.value = `${zip}`;}

};