/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){
        loadCategory();
        loadBooksRecommended();
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
    function loadBooksRecommended() {
        $.ajax({
            method: "GET",
            url: "model/loadBooks.json.php",
            data: {recommended:1}
        }).done(function( data ) {
            var template = $.templates("#bookTemplate");

            var htmlOutput = template.render(data);
            $("#recomendedBooksContainer").html(htmlOutput);

            //execute after books loaded
            OwlCarousel.initOwlCarousel();
        });
    }
}();