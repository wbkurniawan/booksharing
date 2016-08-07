/**
 * Created by William on 8/7/2016.
 */

!function(){
    $(document).ready(function(){
        loadCategory();
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
}();