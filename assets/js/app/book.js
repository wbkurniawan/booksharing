/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){
        loadBook();
        loadPersonalRecommendationBooks();

        $("#eventWrapper").on('click', '#borrowButton', function(e){
            e.preventDefault();
            var bookId = $(this).data('book-id');
            $.ajax({
                method: "POST",
                url: "model/borrow.php",
                data: {bookId:bookId}
            }).done(function( data ) {
                if(!data.error){
                    window.location.href = "success.php?id="+bookId;
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

    function loadBook() {
        var bookId = $('#bookId').val();
        $.ajax({
            method: "GET",
            url: "api/books/"+bookId
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
                $("#breadcrumbCategoryName").attr("href", "/booksharing/list.php?categoryId="+categoryId);
            }
        });
    }

    function loadPersonalRecommendationBooks() {
        $.ajax({
            method: "GET",
            url: "api/books?personal"
        }).done(function( data ) {
            var template = $.templates("#personalRecommendationBooksTemplate");

            var htmlOutput = template.render(data);
            $("#personalRecommendationBooksContainer").html(htmlOutput);

            //execute after books loaded
            OwlCarousel.initOwlCarousel();
        });
    }
}();