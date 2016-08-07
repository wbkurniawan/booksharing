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

                var data = $("#sky-form1").serialize();
                $.ajax({
                    method: "GET",
                    url: "model/login.php",
                    data : data
                }).done(function( data ) {
                    if(data==1){

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