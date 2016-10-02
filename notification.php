<?php
$lock = true;
include_once (__DIR__.'/lock.php');
include_once(__DIR__.'/header.php');

$bookId = isset($_GET["bookId"])?$_GET["bookId"]:0;
$pageTitle = "ACTIVITIES";
if($bookId>0){
	$pageTitle = "BOOK HISTORY";
}

?>

	<input type="hidden" id="bookId" value="<?=$bookId?>">
    <!--=== Shop Product ===-->
    <div class="shop-product" id="eventWrapper">
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                <li><a href="#"><?=$pageTitle?></a></li>
                <li class="active"><a href="#" id="breadcrumbCategoryName"></a></li>
            </ul>
        </div>
        <!-- End Breadcrumbs v5 -->


    </div>
    <!--=== End Shop Product ===-->

    <!--=== Content Medium ===-->

    <!--=== End Content Medium ===-->

     <!--=== Illustration v2 ===-->
    <div class="container">
		<div id="bookListContainer">
		</div>
		<div class="container">
			<div class="heading heading-v1 margin-bottom-20">
				<h2><?=$pageTitle?></h2>
			</div>
			<div class="row" id="notificationContainer">
			</div><!--/end row-->
		</div>
	</div>
	<!--=== Footer v4 ===-->
	<div class="footer-v4">
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<p>
							2016 &copy; FeG Immanuel Berlin. ALL Rights Reserved.
							<a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
						</p>
					</div>
					<div class="col-md-6">
						<ul class="list-inline sponsors-icons pull-right">
							<li><i class="fa fa-facebook-square"></i></li>
							<li><i class="fa fa-twitter-square"></i></li>
							<li><i class="fa fa-pinterest-square"></i></li>
						</ul>
					</div>
				</div>
			</div>
		</div><!--/copyright-->
	</div>
	<!--=== End Footer v4 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Alertify.js -->
<script src="//cdn.jsdelivr.net/alertifyjs/1.8.0/alertify.min.js"></script>

<!-- Get the data -->
<script src="assets/js/jsrender.js"></script>
<script src="assets/js/app/header.js"></script>
<script src="assets/js/app/notification.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<script src="assets/js/custom.js"></script>

<script id="notificationTemplate" type="text/x-jsrender">
	<table class="table table-hover table-condensed">
		{{for data}}
			<tr id="notification-tr-{{:notification_id}}" class="notification-tr"
				data-notification-id="{{:notification_id}}"
			  	data-book-id="{{:book_id}}" data-loan-id="{{:loan_id}}" data-loan-status="{{:loan_status}}"
			  	data-type="{{:type}}"  data-status="{{:status}}">
				<td class="book-cover-thumbnail-td">
<!--				<img class="book-cover-thumbnail-img" src="assets/img/book/s_{{:image}}"></td>-->
				<img class="book-cover-thumbnail-img"
					{{if type=='BORROW_REQUEST' && loan_status=='REQUESTED'}}
						src="assets/img/question.png"
					{{else type=='BORROW_REQUEST' && loan_status=='REJECTED'}}
						src="assets/img/reject.png"
					{{else type=='BORROW_REJECT'}}
						src="assets/img/reject.png"
					{{else type=='BORROW_REQUEST' && loan_status=='BORROWED'}}
						src="assets/img/accept.png"
					{{else type=='BORROW_REQUEST' && loan_status=='RETURNED'}}
						src="assets/img/accept.png"
					{{else type=='BORROW_REQUEST' && loan_status=='CANCELED'}}
						src="assets/img/reject.png"
					{{else type=='BORROW_ACCEPT'}}
						src="assets/img/accept.png"
					{{else type=='BORROW_STATUS' && loan_status=='RETURNED'}}
						src="assets/img/accept.png"
					{{else type=='BORROW_STATUS'}}
						src="assets/img/exclamation.png"
					{{else type=='BOOK_APPROVAL_REQUEST'}}
						src="assets/img/question.png"
					{{else type=='SYSTEM'}}
						src="assets/img/exclamation.png"
                    {{/if}}

				></td>
                    <td>
                    	<div>

                    		{{if type=='BORROW_REQUEST' && loan_status=='REQUESTED'}}
                    			{{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt; is requesting <a href="book.php?id={{:book_id}}" target="_blank"><a href="book.php?id={{:book_id}}" target="_blank"><strong>"{{:title}}"</strong></a></a>
							{{else type=='BORROW_REQUEST' && loan_status=='REJECTED'}}
								You have rejected the request from {{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt; to borrow <a href="book.php?id={{:book_id}}" target="_blank"><strong>"{{:title}}"</strong></a>
                    		{{else type=='BORROW_REJECT'}}
                    			{{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt; rejected your request to borrow <a href="book.php?id={{:book_id}}" target="_blank"><strong>"{{:title}}"</strong></a> with a message: <strong>{{:message}}</strong>
                    		{{else type=='BORROW_REQUEST' && loan_status=='BORROWED'}}
                    			{{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt; is currently borrowing your book <a href="book.php?id={{:book_id}}" target="_blank"><strong>"{{:title}}"</strong></a>
                    		{{else type=='BORROW_REQUEST' && loan_status=='RETURNED'}}
                    			{{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt; has returned your book <a href="book.php?id={{:book_id}}" target="_blank"><strong>"{{:title}}"</strong></a>
                    		{{else type=='BORROW_ACCEPT'}}
                    			{{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt; accepted your request for <a href="book.php?id={{:book_id}}" target="_blank"><strong>"{{:title}}"</strong></a>
                    		{{else type=='BORROW_STATUS' && loan_status=='RETURNED'}}
                    			{{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt; has marked <a href="book.php?id={{:book_id}}" target="_blank"><strong>"{{:title}}"</strong></a> as returned from you.
							{{else type=='BORROW_REQUEST' && loan_status=='CANCELED'}}
								You have canceled your request to borrow <a href="book.php?id={{:book_id}}" target="_blank"><strong>"{{:title}}"</strong></a>.
							{{else type=='BORROW_STATUS'}}
                    			{{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt; reminds you about the due date of <a href="book.php?id={{:book_id}}" target="_blank"><strong>"{{:title}}"</strong></a>
                    		{{else type=='BOOK_APPROVAL_REQUEST'}}
                    			{{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt; has added a new book <a href="book.php?id={{:book_id}}" target="_blank"><strong>"{{:title}}"</strong></a> you need to approve
                    		{{else type=='SYSTEM'}}
                    			{{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt; has sent system notification: <strong>{{:message}}</strong>
                    		{{/if}}

						</div>
						<div class="x-small-cursive">{{:time_elapsed}}</div>
						<div class="action-button-div" id="actionButtonDiv-{{:notification_id}}">
							<button type="button" class="btn-u btn-u-sea-shop approveButton"
								id="approveButton-{{:notification_id}}" data-book-id='{{:book_id}}'
								data-notification-id="{{:notification_id}}"  data-type="{{:type}}">APPROVE</button>
							<button type="button" class="btn-u btn-u-sea-shop rejectButton"
								id="rejectButton-{{:notification_id}}" data-book-id='{{:book_id}}'
								data-notification-id="{{:notification_id}}" data-type="{{:type}}">REJECT</button>
							<button type="button" class="btn-u btn-u-sea-shop returnButton"
								id="returnButton-{{:notification_id}}" data-book-id='{{:book_id}}'
								data-notification-id="{{:notification_id}}"  data-type="{{:type}}">RETURN</button>
							<button type="button" class="btn-u btn-u-sea-shop readNotificationButton"
								id="readNotificationButton-{{:notification_id}}" data-book-id='{{:book_id}}'
								data-notification-id="{{:notification_id}}"  data-type="{{:type}}">OK</button>
						</div>
					</td>
			</tr>
		{{/for}}
	</table>
</script>

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>
