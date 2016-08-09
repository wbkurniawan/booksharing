/**
 * Created by William on 8/7/2016.
 */


!function(){

    $(document).ready(function(){
        // loadStats();
        // $('#sky-form1').submit(function( event ) {
        //     alert( "Handler for .submit() called." );
        //     event.preventDefault();
        //
        // });
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
                        window.location.href = decodeURIComponent(referer);
                    }else {
                        alert(data.error_message);
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

    // function loadStats() {
    //     $.ajax({
    //         method: "GET",
    //         url: "model/loadStats.json.php"
    //     }).done(function( data ) {
    //         var template = $.templates("#recommendedBooksTemplate");
    //
    //         var htmlOutput = template.render(data);
    //         $("#recomendedBooksContainer").html(htmlOutput);
    //
    //         //execute after books loaded
    //         OwlCarousel.initOwlCarousel();
    //     });
    // }

}();