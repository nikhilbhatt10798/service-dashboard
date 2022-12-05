
(function ($) {
    "use strict";

    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })


    /*==================================================================
    [ Validate after type ]*/
    $('.validate-input .input100').each(function(){
        $(this).on('blur', function(){
            if(validate(this) == false){
                showValidate(this);
            }
            else {
                $(this).parent().addClass('true-validate');
            }
        })    
    })

    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
           $(this).parent().removeClass('true-validate');
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    


})(jQuery);

function customer(){
    var a=document.getElementById('customerData');
    if(a.style.display=='none'){
       a.style.display='block'; 
    }
    else{
        a.style.display='none';
    }
     var b=document.getElementById('serviceProData');
//    if(a.style.display='none'){
//       a.style.display='block'; 
//    }
//    else{
        b.style.display='none';
}
function service(){
    var a=document.getElementById('serviceProData');
    if(a.style.display=='none'){
       a.style.display='block'; 
    }
    else{
        a.style.display='none';
    }
  var b=document.getElementById('customerData');
//    if(a.style.display=='none'){
//       a.style.display='block'; 
//    }
//    else{
        b.style.display='none';
    
}


function evalGroup()
{
var group = document.form.userType;
for (var i=0; i<group.length; i++) {
if (group[i].checked)
var userType = document.getElementById('userType').value;
var userType_value;
if(userType =='customer'){
//    rate_value = document.getElementById('user_data').value;   
//    if(rate_value==""){
//        alert('enter required resouce');}
alert('yo');
    }
break;
}
if (i==group.length){
return alert("No radio button is checked");
alert("Radio Button " + (i+1) + " is checked.");
}
 
}


    








