/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){

        loadUser();

        $("#eventWrapper").on('click', '#saveButton', function(e){
            e.preventDefault();
           alertify.alert("todo: submit");
        });
    });

    function loadUser() {
        $.ajax({
            method: "GET",
            url: "model/loadUser.json.php"
        }).done(function( data ) {
            var template = $.templates("#userTemplate");
            var htmlOutput = template.render(data);
            // window.result = data;
            $("#userContainer").html(htmlOutput);
        });
    }
}();