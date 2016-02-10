/**
 * Created by Eleonora on 10.02.2016.
 */
$(document).ready(function(){
    $("#reg_form").validationEngine('attach', {promptPosition : "centerRight", scroll: false});

    function ajaxValidationCallback(status, form, json, options){
       alert(status);
    }

   /* $("#reg_form").validationEngine({
        ajaxFormValidation: true,
        ajaxFormValidationMethod: 'post',
        onAjaxFormComplete: ajaxValidationCallback,
        onValidationComplete: function(form, status){
            alert("The form status is: " +status+", it will never submit");
        },
        ajaxFormValidationURL: "validate"
    });*/
});