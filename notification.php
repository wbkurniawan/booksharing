<?php
$categoryId = isset($_GET["categoryId"])?$_GET["categoryId"]:0;
$lock = false;
include_once(__DIR__.'/header.php');
?>

	<input type="hidden" id="categoryId" value="<?=$categoryId?>">
    <!--=== Shop Product ===-->
    <div class="shop-product" id="eventWrapper">
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Notification</a></li>
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
				<h2>Notification</h2>
			</div>
			<div class="row" id="notificationContainer">

			</div><!--/end row-->
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

<!-- Get the data -->
<script src="assets/js/jsrender.js"></script>
<script src="assets/js/app/header.js"></script>
<script src="assets/js/app/notification.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<script src="assets/plugins/smoothScroll.js"></script>
<script src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Master Slider -->
<script src="assets/plugins/master-slider/quick-start/masterslider/masterslider.min.js"></script>
<script src="assets/plugins/master-slider/quick-start/masterslider/jquery.easing.min.js"></script>
<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script src="assets/js/shop.app.js"></script>
<script src="assets/js/plugins/owl-carousel.js"></script>
<script src="assets/js/plugins/master-slider.js"></script>
<script src="assets/js/forms/product-quantity.js"></script>
<script src="assets/js/plugins/style-switcher.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
        App.initScrollBar();
//		Load Carousel after books -> moved to book.js
//		OwlCarousel.initOwlCarousel();
        StyleSwitcher.initStyleSwitcher();
        MasterSliderShowcase2.initMasterSliderShowcase2();
    });
</script>
<script id="notificationTemplate" type="text/x-jsrender">
	<table class="table table-hover table-condensed">
		<tr><th></th><th>Subject</th><th>Sender</th><th>Date</th><th>Message</th><th></th></tr>
		{{for data}}
			<tr id="notification-tr-{{:notification_id}}" data-notification-id="{{:notification_id}}"
			  	data-book-id="{{:book_id}}" data-status="{{:status}}"  data-type="{{:type}}" data-sender="{{:sender.user_id}}"
				class="{{if status=='NEW'}}new-notification-tr{{/if}} row-notification-tr">
                    {{if type=='BORROW_REQUEST'}}
                    	<td class="notification-icon-full-td">
                        	<i class="fa fa-book" aria-hidden="true"></i>
                        	<i class="fa fa-question popup-small-icon" aria-hidden="true"></i>
                        </td><td>Book request received</td>
                    {{else type=='BORROW_REJECT'}}
                    	<td class="notification-icon-full-td">
                    	    <i class="fa fa-book" aria-hidden="true"></i>
                        	<i class="fa fa-times popup-small-icon" aria-hidden="true"></i>
						</td><td>Your request has been rejected</td>
                    {{else type=='BORROW_ACCEPT'}}
                        <td class="notification-icon-full-td">
							<i class="fa fa-book" aria-hidden="true"></i>
                        	<i class="fa fa-check popup-small-icon" aria-hidden="true"></i>
						</td><td>Your request has been accepted</td>
                    {{else type=='BORROW_STATUS'}}
						<td class="notification-icon-full-td">
                        	<i class="fa fa-book" aria-hidden="true"></i>
                        	<i class="fa fa-exclamation popup-small-icon" aria-hidden="true"></i>
						</td><td>Book status reminder</td>
                    {{else type=='SYSTEM'}}
	                    <td class="notification-icon-full-td">
    	                    <i class="fa fa-cog" aria-hidden="true"></i>
						</td><td>System</td>
                    {{else type=='USER_TO_USER'}}
                    	<td class="notification-icon-full-td">
                        	<i class="fa fa-user" aria-hidden="true"></i>
						</td><td>You've got a message</td>
                    {{/if}}

				<td>{{:sender.first_name}} {{:sender.last_name}}&lt;{{:sender.email}}&gt;</td>
				<td>{{:timestamp}}</td>
				<td width="30%">{{:message}}</td>
				<td><a><i class="fa fa-angle-down" aria-hidden="true" data-notification-id="{{:notification_id}}"></i></a></td>
			</tr>
			<tr id="notification-detail-tr-{{:notification_id}}" class="notification-detail-tr">
				<td colspan="5" id="bookContainer_{{:notification_id}}">
				    <img class="loader-popup-img" src="assets/plugins/revolution-slider/rs-plugin/assets/loader.gif">
				<td>
			</tr>
		{{/for}}
	</table>
</script>

<script id="bookTemplate" type="text/x-jsrender">
	{{for data}}
		<div class="col-md-4">
			<img src="assets/img/book/{{:book_id}}.jpg" class="notification-img" alt="lorem ipsum dolor sit">
		</div>

		<div class="col-md-8">
			<div class="shop-product-heading">
				<h2>{{:title}}</h2>
				<p class="wishlist-category"><strong>Authors:</strong>
				{{for authors}}<a href="#">{{>name}}</a> {{/for}}
				</p>
			</div><!--/end shop product social-->

			<ul class="list-inline product-ratings margin-bottom-30">
				<li><small class="shop-bg-green time-day-left">{{:status}}</small></li>
			</ul><!--/end shop product ratings-->
			{{:description}}
			<div>Loan period: <strong>{{:loan_period}} days</strong></div>
			<div class="margin-bottom-40" id="actionButtonDiv_{{:book_id}}">
				<button type="button" class="btn-u btn-u-sea-shop btn-u-lg approveButton" data-book-id='{{:book_id}}'>APPROVE</button>
				<button type="button" class="btn-u btn-u-sea-shop btn-u-lg rejectButton" data-book-id='{{:book_id}}'>REJECT</button>
			</div><!--/end product quantity-->

		</div>
	{{/for}}
</script>
<script id="replyMessageTemplate" type="text/x-jsrender">
    <div class="form-group">
        <label for="replyMessage">Reply message:</label>
        <textarea class="form-control" rows="9" id="replyMessage_{{:notification_id}}"></textarea>
    </div>
    <button type="button" data-notification-id="{{:notification_id}}" data-sender="{{:sender}}" class="btn-u btn-u-sea-shop btn-u-lg notificationReplyButton" >REPLY</button>
    <button type="button" data-notification-id="{{:notification_id}}" data-sender="{{:sender}}" class="btn-u shop-bg-red btn-u-lg notificationDeleteButton" >DELETE</button>
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>
