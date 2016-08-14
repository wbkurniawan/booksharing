/**
 * Created by William on 8/7/2016.
 */

!function(){
    $(document).ready(function(){
        loadCategory();
        checkNotification();
        loadUserInfo();
    });
    function loadCategory() {
        $.ajax({
            method: "GET",
            url: "api/categories"
        }).done(function( data ) {
            var template = $.templates("#categoriesTemplate");

            var htmlOutput = template.render(data);
            $("#categoryContainer").html(htmlOutput);
        });
    }
    function checkNotification() {
        var token=$('body').data("token");
        if(token.length!=0) {
            $.ajax({
                method: "GET",
                url: "model/checkNotification.php"
            }).done(function (data) {
                $("#newNotification").text(data);
                if (data > 0) {
                    $("#newNotification").show();
                } else {
                    $("#newNotification").hide();
                }
            });
        }
    }
    function loadUserInfo() {
        var token=$('body').data("token");
        if(token.length!=0){
            $(".loader-popup-img").show();
            $("#login-popup-ul").hide();
            $.ajax({
                method: "GET",
                url: "model/loadUserInfo.json.php"
            }).done(function( data ) {
                if(!data.error){
                    // $.views.settings.allowCode(true);
                    var template = $.templates("#userInfoTemplate");
                    var htmlOutput = template.render(data);
                    $("#userInfoContainer").html(htmlOutput);
                }
            });
            $(".loader-popup-img").show();
        }
    }
}();