/**
 * Created by William on 8/17/2016.
 */



!function(){

    $(document).ready(function(){
        $("#sky-form4").validate({
            submitHandler: function(form) {
                var data = $("#sky-form4").serialize();
                $.ajax({
                    method: "POST",
                    url: "model/addUser.php",
                    data : data
                }).done(function( data ) {
                    if(!data.error){
                        window.location.href = '/booksharing/index.php';
                    }else {
                        alertify.error(data.error_message);
                    }
                });
            },
            // Rules for form validation
            rules:
            {

                email:
                {
                    required: true,
                    email: true
                },
                password:
                {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                passwordConfirm:
                {
                    required: true,
                    minlength: 3,
                    maxlength: 20,
                    equalTo: '#password'
                },
                firstname:
                {
                    required: true
                },
                lastname:
                {
                    required: true
                },
                invitation:
                {
                    required: true
                },
                terms:
                {
                    required: true
                }
            },

            // Messages for form validation
            messages:
            {

                email:
                {
                    required: 'Please enter your email address',
                    email: 'Please enter a VALID email address'
                },
                password:
                {
                    required: 'Please enter your password'
                },
                passwordConfirm:
                {
                    required: 'Please enter your password one more time',
                    equalTo: 'Please enter the same password as above'
                },
                firstName:
                {
                    required: 'Please select your first name'
                },
                lastName:
                {
                    required: 'Please select your last name'
                },
                invitation:
                {
                    required: 'Please enter the invitation code. Contact +49176888888 to get your code.'
                },
                terms:
                {
                    required: 'You must agree with Terms and Conditions'
                }
            },

            // Do not change code below
            errorPlacement: function(error, element)
            {
                error.insertAfter(element.parent());
            }
        });
    });
}();