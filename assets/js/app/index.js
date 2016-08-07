/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){
        loadRecommendedBooks();
        loadLatestBooks();
    });

    function loadRecommendedBooks() {
        $.ajax({
            method: "GET",
            url: "model/loadBooks.json.php",
            data: {recommended:1}
        }).done(function( data ) {
            var template = $.templates("#recommendedBooksTemplate");

            var htmlOutput = template.render(data);
            $("#recomendedBooksContainer").html(htmlOutput);

            //execute after books loaded
            OwlCarousel.initOwlCarousel();
        });
    }

    function loadLatestBooks() {
        $.ajax({
            method: "GET",
            url: "model/loadBooks.json.php",
            data: {latest:1}
        }).done(function( data ) {
            var template = $.templates("#latestBooksTemplate");

            var htmlOutput = template.render(data);
            $("#latestBooksContainer").html(htmlOutput);

            //execute after books loaded
            OwlCarousel.initOwlCarousel();
        });
    }
}();