/**
 * Created by William on 8/6/2016.
 */


!function(){

    $(document).ready(function(){

        loadNotification();

        $("#notificationContainer").on('click', '.approveButton', function(e) {
            //Todo: implement the approval process
            alert("Todo: send bookId, add approve function in Book class");
            return false;
            //==================//
        });
        $("#notificationContainer").on('click', '.rejectButton', function(e) {
            //Todo: implement the approval process
            alert("Todo: send bookId, add reject function in Book class");
            return false;
            //==================//
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
                        alert(data.error_message);
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
            var status = $(this).data('status');
            var sender = $(this).data('sender');
            var detail = $("#notification-detail-tr-" + notificationId);
            var type = $(this).data('type');
            if(detail.is(':visible')){
                detail.hide();
            }else{
                detail.show();
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
                        var template = $.templates("#bookTemplate");
                        var htmlOutput = template.render(data);
                        $("#bookContainer_"+notificationId).html(htmlOutput);
                        if(type=="BORROW_REQUEST"){
                            $("#actionButtonDiv_"+bookId).show();
                        }else if(type=="BORROW_REJECT"){
                            $("#actionButtonDiv_"+bookId).hide();
                        }
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

    function loadNotification() {
        $.ajax({
            method: "GET",
            url: "model/loadNotification.json.php"
        }).done(function( data ) {
            var template = $.templates("#notificationTemplate");

            var htmlOutput = template.render(data);
            $("#notificationContainer").html(htmlOutput);
        });
    }
}();