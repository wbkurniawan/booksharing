/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){
        loadCategory();
        loadBook();
        loadPersonalRecommendationBooks();
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
    function loadBook() {
        var bookId = $('body').data('book-id');
        $.ajax({
            method: "GET",
            url: "model/loadBooks.json.php",
            data: {bookId:bookId}
        }).done(function( data ) {
            var template = $.templates("#bookTemplate");

            var htmlOutput = template.render(data);
            $("#bookContainer").html(htmlOutput);
        });
    }
    function loadPersonalRecommendationBooks() {
        $.ajax({
            method: "GET",
            url: "model/loadBooks.json.php",
            data: {personal:1}
        }).done(function( data ) {
            var template = $.templates("#personalRecommendationBooksTemplate");

            var htmlOutput = template.render(data);
            $("#personalRecommendationBooksContainer").html(htmlOutput);

            //execute after books loaded
            OwlCarousel.initOwlCarousel();
        });
    }
}();