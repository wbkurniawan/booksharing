/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){

        loadAuthors();

        $("#eventWrapper").on('click', '.edit-button', function(e){
            e.preventDefault();
            var authorId = $(this).data("author-id");
            var name = $(this).data("name");
            alertify.prompt("Edit Author","Name", name,
                function(evt, value ){
                    $.ajax({
                        method: "POST",
                        url: "model/saveAuthor.php",
                        data: { authorId: authorId,
                            name: value }
                    }).done(function( data ) {
                        if(!data.error){
                            loadAuthors();
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
        $("#eventWrapper").on('click', '#addButton', function(e){
            e.preventDefault();
            alertify.prompt("Add Author","Name", "",
                function(evt, value ){
                    if(value.trim()==""){
                        alertify.error("Name can't be empty");
                    }else{
                        $.ajax({
                            method: "POST",
                            url: "model/saveAuthor.php",
                            data: { authorId: 0,
                                name: value }
                        }).done(function( data ) {
                            if(!data.error){
                                loadAuthors();
                            }else {
                                if(data.error_code == 403){
                                    console.log(data);
                                    window.location.href = "login.php";
                                }else{
                                    alertify.error(data.error_message);
                                }
                            }
                        });
                    }
                },
                function(){
                    alertify.error('Cancel');
                })
            ;
        });

        $("#eventWrapper").on('click', '.delete-button', function(e){
            e.preventDefault();
            var authorId = $(this).data("author-id");
            var name = $(this).data("name");
            alertify.confirm("Delete Author","Are you sure you want to delete " + name,
                function(){
                    $.ajax({
                        method: "POST",
                        url: "model/deleteAuthor.php",
                        data: { authorId: authorId }
                    }).done(function( data ) {
                        if(!data.error){
                            loadAuthors();
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
                });
        });
    });

    function loadAuthors() {
        $.ajax({
            method: "GET",
            url: "api/authors"
        }).done(function( data ) {
            var template = $.templates("#authorTemplate");
            var htmlOutput = template.render(data);
            // window.result = data;
            $("#authorContainer").html(htmlOutput);
        });
    }
}();