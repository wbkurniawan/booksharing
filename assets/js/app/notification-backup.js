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
            $.ajax({
                method: "POST",
                url: "model/approveRequest.php",
                data: { bookId: bookId,
                        notificationId: notificationId,
                        type : type}
            }).done(function( data ) {
                if(!data.error){
                    $("#actionButtonDiv_"+bookId).hide();
                    $("#notification-tr-"+notificationId).data("detail-loaded",0);
                    $("#notification-tr-"+notificationId).data("status","PROCESSED");
                    $("#notification-detail-tr-" + notificationId).hide();
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
            $.ajax({
                method: "POST",
                url: "model/return.php",
                data: { bookId: bookId,
                        notificationId: notificationId,
                        type : type}
            }).done(function( data ) {
                if(!data.error){
                    $("#actionButtonDiv_"+bookId).hide();
                    $("#notification-tr-"+notificationId).data("detail-loaded",0);
                    $("#notification-tr-"+notificationId).data("status","PROCESSED");
                    $("#notification-detail-tr-" + notificationId).hide();
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
                    $.ajax({
                        method: "POST",
                        url: "model/rejectRequest.php",
                        data: { bookId: bookId,
                                notificationId: notificationId,
                                type: type,
                                message: value }
                    }).done(function( data ) {
                        if(!data.error){
                            $("#actionButtonDiv_"+bookId).hide();
                            $("#notification-tr-"+notificationId).data("detail-loaded",0);
                            $("#notification-tr-"+notificationId).data("status","PROCESSED");
                            $("#notification-detail-tr-" + notificationId).hide();
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

        $("#notificationContainer").on('click', '.notificationReplyButton', function(e) {
            var replyFromId = $(this).data("notification-id");
            var recipient = $(this).data("sender");
            var type = 'USER_TO_USER';
            var message = $("#replyMessage_"+replyFromId).val();
            $.ajax({
                method: "POST",
                url: "model/sendNotification.php",
                data: { replyFromId:replyFromId,
                        recipient:recipient,
                        type:type,
                        message:message
                       }
            }).done(function( data ) {
                if(!data.error){
                    $("#notification-detail-tr-"+replyFromId).hide();
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

        $("#notificationContainer").on('click', '.notificationDeleteButton', function(e) {
            var notificationId = $(this).data("notification-id");
            var sender = $(this).data("sender");
            $.ajax({
                method: "POST",
                url: "model/setNotificationStatus.php",
                data: {notificationId:notificationId,
                    status: 'DELETED' }
            }).done(function( data ) {
                if(data==0){
                    console.log("Warning: can not update the notification status");
                }
                $("#notification-tr-" + notificationId).hide();
                $("#notification-detail-tr-"+notificationId).hide();
            });
        });


        $("#notificationContainer").on('click', '.row-notification-tr', function(e){
            e.preventDefault();
            var notificationId = $(this).data('notification-id');
            var bookId = $(this).data('book-id');
            var loanId = $(this).data('loan-id');
            var status = $(this).data('status');
            var loanStatus = $(this).data('loan-status');
            console.log(loanStatus);
            var sender = $(this).data('sender');
            var detail = $("#notification-detail-tr-" + notificationId);
            var type = $(this).data('type');
            if(detail.is(':visible')){
                detail.hide();
                return true;
            }else{
                detail.show();
                if($(this).data("detail-loaded")==1){
                    return true;
                }
                $(".loader-popup-img").show();
            }

            if(type=='USER_TO_USER' || type=='SYSTEM'){
                var data = [
                    {
                        "notification_id": notificationId,
                        "sender": sender
                    }
                ];
                var template = $.templates("#replyMessageTemplate");
                var htmlOutput = template.render(data);
                // var htmlOutput = $("#replyMessageTemplate").html();
                $("#bookContainer_"+notificationId).html(htmlOutput);
            }else{
                if($.isNumeric(bookId)){
                    $.ajax({
                        method: "GET",
                        url: "api/books/"+bookId
                    }).done(function( data ) {
                        // var status = "";
                        // if(data["data"][0]["status"] != undefined){
                        //     status = data["data"][0]["status"];
                        // }
                        data["notification_id"] = notificationId;
                        data["type"] = type;
                        data["loan_status"] = loanStatus;
                        var template = $.templates("#bookTemplate");
                        var htmlOutput = template.render(data);
                        $("#bookContainer_"+notificationId).html(htmlOutput);
                        $("#notification-tr-"+notificationId).data("detail-loaded",1);
                        setActionButton(notificationId);
                        // if((type=="BORROW_REQUEST" || type=="BOOK_APPROVAL_REQUEST") && status != "PROCESSED"){
                        //     $("#actionButtonDiv_"+bookId).show();
                        // }else{
                        //     $("#actionButtonDiv_"+bookId).hide();
                        // }
                    });
                }
            }

            if(status=="NEW" && detail.is(':visible')){
                $(this).data('status','READ');
                $(this).removeClass("new-notification-tr");
                $.ajax({
                    method: "POST",
                    url: "model/setNotificationStatus.php",
                    data: {notificationId:notificationId,
                        status: 'READ' }
                }).done(function( data ) {
                    if(data==0){
                        console.log("Warning: can not update the notification status");
                    }
                });
            }
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

        var loanStatus = $("#loan-" + notificationId).data("loan-status");
        var type = notification.data('type');

        if(type=='BORROW_REQUEST' && loanStatus == 'REQUESTED'){
            approveButton.show();
            rejectButton.show();
            returnButton.hide();
        }else if(type=='BORROW_REQUEST' && loanStatus == 'BORROWED' ){
            approveButton.hide();
            rejectButton.hide();
            returnButton.show();
        }else{
            approveButton.hide();
            rejectButton.hide();
            returnButton.hide();
        }

    }

    function loadNotification() {
        var bookId = Number($("#bookId").val());

        $.ajax({
            method: "GET",
            url: "model/loadNotification.json.php",
            data: {bookId:bookId}
        }).done(function( data ) {
            var template = $.templates("#notificationTemplate");

            var htmlOutput = template.render(data);
            $("#notificationContainer").html(htmlOutput);
        });
    }
}();