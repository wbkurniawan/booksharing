/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){

        loadBooks();

        // $("#eventWrapper").on('click', '#borrowButton', function(e){
        //     e.preventDefault();
        //     var bookId = $(this).data('book-id');
        //     $.ajax({
        //         method: "POST",
        //         url: "model/borrow.php",
        //         data: {bookId:bookId}
        //     }).done(function( data ) {
        //         if(!data.error){
        //             window.location.href = "success.php?id="+bookId;
        //         }else {
        //             if(data.error_code == 403){
        //                 console.log(data);
        //                 window.location.href = "login.php";
        //             }else{
        //                 alert(data.error_message);
        //             }
        //         }
        //     });
        // });
    });

    function loadBooks() {
        var categoryId = $('#categoryId').val();
        var userId = $('#userId').val();
        var url ="";
        var filter = ""
;        if(categoryId>0){
            url = "api/books?categoryId="+categoryId;
            filter = "CATEGORY";
        }else if(userId>0){
            url = "api/books?userId="+userId;
            filter = "USER";
        }
        $.ajax({
            method: "GET",
            url: url
        }).done(function( data ) {
            var template = $.templates("#bookListTemplate");
            data["filter"]=filter;
            var htmlOutput = template.render(data);
            $("#bookListContainer").html(htmlOutput);
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
}();