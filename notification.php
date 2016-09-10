<?php
$lock = true;
include_once (__DIR__.'/lock.php');
include_once(__DIR__.'/header.php');

$bookId = isset($_GET["bookId"])?$_GET["bookId"]:0;
$pageTitle = "NOTIFICATION";
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
							2014 &copy; Unify. ALL Rights Reserved.
							<a target="_blank" href="https://twitter.com/htmlstream">Htmlstream</a> | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
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
			  	data-type="{{:type}}">
				<td class="book-cover-thumbnail-td"><img class="book-cover-thumbnail-img" src="assets/img/book/s_{{:image}}"></td>
                    <td>
                    	<div>
                    		{{:sender.first_name}} {{:sender.last_name}} &lt;{{:sender.email}}&gt;
                    		{{if type=='BORROW_REQUEST'}}
                    			is requesting
                    		{{else type=='BORROW_REJECT'}}
                    			rejected your request for
                    		{{else type=='BORROW_ACCEPT'}}
                    			accepted your request for
                    		{{else type=='BORROW_STATUS'}}
                    			reminds you about the due date of
                    		{{else type=='BOOK_APPROVAL_REQUEST'}}
                    			has added a new book
                    		{{else type=='SYSTEM'}}
                    			has sent system notification
                    		{{/if}}
                    		<strong>{{:title}}</strong>
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
