/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){
        loadBook();
        loadPersonalRecommendationBooks();
    });

    function loadBook() {
        var bookId = $('#bookId').val();
        $.ajax({
            method: "GET",
            url: "model/loadBooks.json.php",
            data: {bookId:bookId}
        }).done(function( data ) {
            var template = $.templates("#bookTemplate");

            var htmlOutput = template.render(data);
            $("#bookContainer").html(htmlOutput);
            var categoryName = "";
            if(!jQuery.isEmptyObject(data["data"][0]["categories"][0]["name"])){
                categoryName = data["data"][0]["categories"][0]["name"];
                $("#breadcrumbCategoryName").text(categoryName);
            }
            var categoryId = "";
            if(!jQuery.isEmptyObject(data["data"][0]["categories"][0]["category_id"])){
                categoryId = data["data"][0]["categories"][0]["category_id"];
                $("#breadcrumbCategoryName").attr("href", "bookList.php?categoryId="+categoryId);
            }
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