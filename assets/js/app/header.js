/**
 * Created by William on 8/7/2016.
 */

!function(){
    $(document).ready(function(){
        loadCategory();
        checkNotification();
        // loadUserInfo();
    });
    function loadCategory() {
        $.ajax({
            method: "GET",
            url: "model/loadCategories.json.php"
        }).done(function( data ) {
            var template = $.templates("#categoriesTemplate");

            var htmlOutput = template.render(data);
            $("#categoryContainer").html(htmlOutput);
        });
    }
    function checkNotification() {
        $.ajax({
            method: "GET",
            url: "model/checkNotification.php"
        }).done(function( data ) {
            $("#newNotification").text(data);
            if(data>0){
                $("#newNotification").show();
            }else{
                $("#newNotification").hide();
            }
        });
    }
    function loadUserInfo() {
        $.ajax({
            method: "GET",
            url: "model/loadUserInfo.json.php"
        }).done(function( data ) {
            var template = $.templates("#categoriesTemplate");

            var htmlOutput = template.render(data);
            $("#categoryContainer").html(htmlOutput);
        });
    }
}();