/**
 * Created by William on 8/6/2016.
 */


!function(){


    $(document).ready(function(){
        var myHelpers = {dateFormat: dateFormat};
        $.views.helpers(myHelpers);

        loadBorrowedBook();
        loadBooks("");

        $("#eventWrapper").on('click', '#addButton', function(e){
            e.preventDefault();
            window.location.href = "edit.php?id=0";
        });

        $("#eventWrapper").on('submit', '#search-form', function(e){
            e.preventDefault();
            var search = $("#search-input").val();
            loadBooks(search);
        });

        $("#eventWrapper").on('click', '.acceptButton', function(e) {
            var bookId = $(this).data("book-id");
            var buttonDiv = $(this).closest("div");
            var type = "BORROW_REQUEST";
            $.ajax({
                method: "POST",
                url: "model/approveRequest.php",
                data: { bookId: bookId,
                    type : type}
            }).done(function( data ) {
                if(!data.error){
                    buttonDiv.hide();
                    alertify.success("Request has been accepted");
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
        $("#eventWrapper").on('click', '.rejectButton', function(e) {
            var bookId = $(this).data("book-id");
            var type = "BORROW_REQUEST";
            var buttonDiv = $(this).closest("div");
            alertify.prompt("Reject Request","Reason", "",
                function(evt, value ){
                    $.ajax({
                        method: "POST",
                        url: "model/rejectRequest.php",
                        data: { bookId: bookId,
                            type: type,
                            message: value }
                    }).done(function( data ) {
                        if(!data.error){
                            buttonDiv.hide();
                            alertify.success("Request has been rejected");
                        }else {
                            if(data.error_code == 403){
                                console.log(data);
                                window.location.href = "login.php";
                            }else{
                                alertify.error(data.error_message);
                            }
                        }
                    });
                },
                function(){
                    alertify.error('Cancel');
                })
            ;
        });
        $("#eventWrapper").on('click', '.returnButton', function(e) {
            var bookId = $(this).data("book-id");
            var buttonDiv = $(this).closest("div");
            $.ajax({
                method: "POST",
                url: "model/return.php",
                data: { bookId: bookId}
            }).done(function( data ) {
                if(!data.error){
                    buttonDiv.hide();
                    alertify.success("Book has been returned");
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
        $("#eventWrapper").on('click', '.cancelRequestButton', function(e){
            e.preventDefault();
            var bookId = $(this).data('book-id');

            alertify.confirm("Cancel request","Do you want to cancel your request?",
                function(){
                    $.ajax({
                        method: "POST",
                        url: "model/cancel.php",
                        data: {bookId:bookId}
                    }).done(function( data ) {
                        if(!data.error){
                            window.location.href = "list.php";
                        }else {
                            if(data.error_code == 403){
                                console.log(data);
                                window.location.href = "login.php";
                            }else{
                                alert(data.error_message);
                            }
                        }
                    });
                },
                function(){
                    alertify.error('Cancel');
                });
        });
    });

    function dateFormat(value) {
        var day = new Date(value);
        return day.toLocaleString();
    }

    function loadBorrowedBook(search) {
        var categoryId = $('#categoryId').val();
        var userId = $('#userId').val();

        if(categoryId!="-1"){
            return false;
        }else if(userId!="0"){
            $.ajax({
                method: "GET",
                url: "model/loadBorrowedBook.json.php"
            }).done(function( data ) {
                var template = $.templates("#borrowedBooksTemplate");
                var htmlOutput = template.render(data);
                $("#borrowedBookContainer").html(htmlOutput);
            });
        }
    }
    function loadBooks(search) {
        var categoryId = $('#categoryId').val();
        var userId = $('#userId').val();
        var authorId = $('#authorId').val();
        var url ="";
        var filter = "";
        if(categoryId!="-1"){
            url = "api/books?categoryId="+categoryId+"&search="+search;
            filter = "CATEGORY";
        }else if(authorId!="-1"){
            url = "api/books?authorId="+authorId;
            filter = "AUTHOR";
        }else if(userId!="0"){
            url = "api/books?userId="+userId;
            filter = "USER";
        }
        $.ajax({
            method: "GET",
            url: url
        }).done(function( data ) {
            var template = $.templates("#bookListTemplate");
            data["filter"]=filter;
            data["categoryId"]=categoryId;
            data["authorId"]=authorId;
            data["search"]=search;
            var htmlOutput = template.render(data);
            $("#bookListContainer").html(htmlOutput);
            if(filter=="CATEGORY") {
                if (parseInt(categoryId) == 0) {
                    $("#breadcrumbCategoryName").text("All Books");
                    $("#breadcrumbCategoryName").attr("href", "/booksharing/list.php?categoryId=" + 0);
                } else {
                    var categoryName = "";
                    if (!jQuery.isEmptyObject(data["data"][0]["categories"][0]["name"])) {
                        categoryName = data["data"][0]["categories"][0]["name"];
                        $("#breadcrumbCategoryName").text(categoryName);
                    }
                    var loadedCategoryId = "";
                    if (!jQuery.isEmptyObject(data["data"][0]["categories"][0]["category_id"])) {
                        loadedCategoryId = data["data"][0]["categories"][0]["category_id"];
                        $("#breadcrumbCategoryName").attr("href", "/booksharing/list.php?categoryId=" + loadedCategoryId);
                    }
                }
            }else if(filter=="AUTHOR"){
                if (!jQuery.isEmptyObject(data["data"][0]["authors"])) {
                    var authorName = data["data"][0]["authors"];
                    $("#breadcrumbCategoryName").text(authorName);
                }
            }else{
                $("#breadcrumbCategoryName").text("My Books");
            }
        });
    }
}();