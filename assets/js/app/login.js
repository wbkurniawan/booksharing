/**
 * Created by William on 8/7/2016.
 */


!function(){

    $(document).ready(function(){
        loadQuotes();
        loadStats();

        $(document).on('click', '#forgot-password-link', function(e){
            e.preventDefault();
            alertify.prompt("Reset Password","Please enter your email. A link to reset your password will be sent.", "",
                function(evt, value ){
                    $.ajax({
                        method: "POST",
                        url: "model/forgotPassword.php",
                        data : {email:value}
                    }).done(function( data ) {
                        if(!data.error){
                            alertify.success('Email has been successfully sent to ' + value + '. Please check to proceed.');
                        }else {
                            alertify.alert(data.error_message);
                        }
                    });
                },
                function(){
                    alertify.error('Cancel');
                });
        });

        $("#sky-form1").validate({
            submitHandler: function(form) {
                var referer = $("#referer").val();
                var data = $("#sky-form1").serialize();
                $.ajax({
                    method: "POST",
                    url: "model/login.php",
                    data : data
                }).done(function( data ) {
                    if(!data.error){
                        if(referer=="" || referer.indexOf("resetPassword.php") != -1){
                            console.log("index.php");
                            window.location.href = "index.php";
                        }
                        else if(referer.indexOf("login.php") == -1){
                            console.log(referer);
                            window.location.href = decodeURIComponent(referer);
                        }else{
                            console.log("index.php");
                            window.location.href = "index.php";
                        }
                    }else {
                        alertify.alert("Access denied",data.error_message);
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
                }
            },

            // Do not change code below
            errorPlacement: function(error, element)
            {
                error.insertAfter(element.parent());
            }
        });
    });

    function loadStats() {
        $.ajax({
            method: "GET",
            url: "model/loadStats.json.php"
        }).done(function( data ) {
            if(!data.error){
                var template = $.templates("#statsTemplate");
                var htmlOutput = template.render(data);
                $("#statsContainer").html(htmlOutput);
            }
        });
    }

    function loadQuotes() {
        $.ajax({
            method: "GET",
            url: "model/loadQuotes.json.php"
        }).done(function( data ) {
            if(!data.error){
                var template = $.templates("#quotesTemplate");
                var htmlOutput = template.render(data);
                $("#quotesContainer").html(htmlOutput);
            }
        });
    }


}();