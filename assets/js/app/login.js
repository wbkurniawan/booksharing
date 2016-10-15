/**
 * Created by William on 8/7/2016.
 */


!function(){

    $(document).ready(function(){
        loadQuotes();
        loadStats();
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
                        if(referer==""){
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