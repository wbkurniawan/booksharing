/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){


        $("#eventWrapper").on('click', '#saveButton', function(e){
            e.preventDefault();
            if($("#passwordInput").val().length==0
                || $("#newPasswordInput").val().length==0
                || $("#retypeNewPasswordInput").val().length==0
            ){
                alertify.error("please feel in all mandatory fields");
                return false;
            }

            if($("#newPasswordInput").val()!=$("#retypeNewPasswordInput").val()){
                alertify.error("password and retyped password don't match");
                return false;
            }

            if($("#newPasswordInput").val().length<5
            || $("#retypeNewPasswordInput").val().length<5
            ){
                alertify.error("please use more secure password");
                return false;
            }

            var data = $("#changePasswordForm").serialize();
            $.ajax({
                method: "POST",
                url: "model/changePassword.php",
                data: data
            }).done(function( data ) {
                if(!data.error){
                    alertify.success("password changed");
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

}();