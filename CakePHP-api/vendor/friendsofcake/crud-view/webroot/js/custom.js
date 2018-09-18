 $(document).ready(function() {
$('.error').css('color','a94442');
$('.EmpForm').each( function(){

var form = $(this);
console.log('testtt');
form.validate({
            errorElement: "div",
            highlight: function(element) {
                $(element).removeClass("error");
            },
            rules: {
                "title":{
                    required: true,
                    lettersonly: true
                },
                "first_name":{
                    required: true,
                    lettersonly: true
                },
                "last_name":{
                    required: true,
                    lettersonly: true
                },
                "mobile_no": {
                    required: true,
                    number:true
                },
                "extension_no": {
                    required: true,
                    number:true
                },
                "address": {
                    required: true,
                    alphanumeric: true
                },
                "zipcode": {
                    required: true,
                    numbers:true
                },
            },
            messages:{
                "title":{
                    required: "Please enter department title."
                },
                "first_name":{
                    required: "Please enter first name."
                },
                "last_name":{
                    required: "Please enter last name."
                },
                "mobile_no": {
                    required: "Please enter mobile number."
                },
                "extension_no": {
                    required: "Please enter extension no."
                },
                "address": {
                    required: "Please enter address."
                },
                "zipcode": {
                    required: "Please enter zip code."
                },
            }
        });
    });
        
});