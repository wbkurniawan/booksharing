/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){

        loadUser();

        $("#eventWrapper").on('click', '#saveButton', function(e){
            e.preventDefault();
            if(!validateEmail($("#emailInput").val())){
                alertify.error("email invalid");
                return false;
            }
            if($("#passwordInput").val()!=$("#retypePasswordInput").val()){
                alertify.error("password and retyped password don't match");
                return false;
            }
            if($("#firstNameInput").val().length==0
            || $("#lastNameInput").val().length==0
            || $("#passwordInput").val().length==0
            ){
                alertify.error("please feel in all mandatory fields");
                return false;
            }

            var data = $("#updatePersonalDataForm").serialize();
            $.ajax({
                method: "POST",
                url: "model/saveUser.php",
                data: data
            }).done(function( data ) {
                if(!data.error){
                    alertify.success("personal data updated");
                }else {
                    if(data.error_code == 403){
                        console.log(data);
                        window.location.href = "login.php";
                    }else{
                        alertify.error(data.error_message);
                    }
                }
            });

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
    function validateEmail(email){
        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var valid = emailReg.test(email);

        if(!valid) {
            return false;
        } else {
            return true;
        }
    }
}();