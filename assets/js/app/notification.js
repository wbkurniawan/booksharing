/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){

        loadNotification();

        $("#notificationContainer").on('click', '.approveButton', function(e) {
            var bookId = $(this).data("book-id");
            var notificationId = $(this).data("notification-id");
            var type = $(this).data("type");
            $("#actionButtonDiv-"+notificationId).append("<img src='assets/img/loading.gif'>");
            $.ajax({
                method: "POST",
                url: "model/approveRequest.php",
                data: { bookId: bookId,
                        notificationId: notificationId,
                        type : type}
            }).done(function( data ) {
                if(!data.error){
                    $("#actionButtonDiv-"+notificationId).hide();
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

        $("#notificationContainer").on('click', '.returnButton', function(e) {
            var bookId = $(this).data("book-id");
            var notificationId = $(this).data("notification-id");
            var type = $(this).data("type");
            $("#actionButtonDiv-"+notificationId).append("<img src='assets/img/loading.gif'>");
            $.ajax({
                method: "POST",
                url: "model/return.php",
                data: { bookId: bookId,
                        notificationId: notificationId,
                        type : type}
            }).done(function( data ) {
                if(!data.error){
                    $("#actionButtonDiv-"+notificationId).hide();
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

        $("#notificationContainer").on('click', '.readNotificationButton', function(e) {
            var notificationId = $(this).data("notification-id");
            $("#actionButtonDiv-"+notificationId).append("<img src='assets/img/loading.gif'>");
            $.ajax({
                method: "POST",
                url: "model/readNotification.php",
                data: { notificationId: notificationId}
            }).done(function( data ) {
                if(!data.error){
                    $("#actionButtonDiv-"+notificationId).hide();
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

        $("#notificationContainer").on('click', '.rejectButton', function(e) {
            var bookId = $(this).data("book-id");
            var notificationId = $(this).data("notification-id");
            var type = $(this).data("type");
            alertify.prompt("Reject Request","Reason", "",
                function(evt, value ){
                    $("#actionButtonDiv-"+notificationId).append("<img src='assets/img/loading.gif'>");
                    $.ajax({
                        method: "POST",
                        url: "model/rejectRequest.php",
                        data: { bookId: bookId,
                                notificationId: notificationId,
                                type: type,
                                message: value }
                    }).done(function( data ) {
                        if(!data.error){
                            $("#actionButtonDiv-"+notificationId).hide();
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
    });

    function setActionButton(notificationId){
        // var bookId = notification.data('book-id');
        // var bookStatus = $("#book-" + notificationId).data("book-status");
        // var status = notification.data('status');

        var notification = $("#notification-tr-"+notificationId);
        var approveButton = $("#approveButton-"+notificationId);
        var rejectButton = $("#rejectButton-"+notificationId);
        var returnButton = $("#returnButton-"+notificationId);
        var readNotificationButton = $("#readNotificationButton-"+notificationId);

        var loanStatus = $(notification).data("loan-status");
        var status = $(notification).data("status");
        var type = notification.data('type');

        if(type=='BORROW_REQUEST' && loanStatus == 'REQUESTED'){
            approveButton.show();
            rejectButton.show();
            returnButton.hide();
            readNotificationButton.hide();
        }else if(type=='BORROW_REQUEST' && loanStatus == 'BORROWED' ) {
            approveButton.hide();
            rejectButton.hide();
            returnButton.show();
            readNotificationButton.hide();
        }else if(type=='BOOK_APPROVAL_REQUEST' && status=='NEW' ) {
            approveButton.show();
            rejectButton.show();
            returnButton.hide();
            readNotificationButton.hide();
        }else if(status=='NEW'){
            approveButton.hide();
            rejectButton.hide();
            returnButton.hide();
            readNotificationButton.show();
        }else{
            approveButton.hide();
            rejectButton.hide();
            returnButton.hide();
            readNotificationButton.hide();
        }

    }

    function loadNotification() {
        var bookId = Number($("#bookId").val());

        $.ajax({
            method: "GET",
            url: "model/loadNotification.json.php",
            data: {bookId:bookId}
        }).done(function( data ) {
            $.views.settings.allowCode(true);
            var template = $.templates("#notificationTemplate");
            var htmlOutput = template.render(data);
            $("#notificationContainer").html(htmlOutput);
            $(".notification-tr").each(function( index ) {
                setActionButton($(this).data("notification-id"));
            });
        });

        // $.ajax({
        //     method: "POST",
        //     url: "model/setNotificationStatus.php",
        //     data: {status: 'READ' }
        // }).done(function( data ) {
        //     if(data==0){
        //         console.log("Warning: can not update the notification status");
        //     }
        // });
    }
}();