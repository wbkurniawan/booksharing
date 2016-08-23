<?php
$categoryId = isset($_GET["categoryId"])?$_GET["categoryId"]:0;
$lock = true;
include_once (__DIR__.'/lock.php');
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

<!-- Alertify.js -->
<script src="//cdn.jsdelivr.net/alertifyjs/1.8.0/alertify.min.js"></script>

<!-- Get the data -->
<script src="assets/js/jsrender.js"></script>
<script src="assets/js/app/header.js"></script>
<script src="assets/js/app/notification.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<script src="assets/plugins/smoothScroll.js"></script>
<!--<script src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>-->
<!--<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>-->
<!-- Master Slider -->
<!--<script src="assets/plugins/master-slider/quick-start/masterslider/masterslider.min.js"></script>-->
<!--<script src="assets/plugins/master-slider/quick-start/masterslider/jquery.easing.min.js"></script>-->
<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<!--<script src="assets/js/shop.app.js"></script>-->
<!--<script src="assets/js/plugins/owl-carousel.js"></script>-->
<!--<script src="assets/js/plugins/master-slider.js"></script>-->
<!--<script src="assets/js/forms/product-quantity.js"></script>-->
<!--<script src="assets/js/plugins/style-switcher.js"></script>-->
<script>
    jQuery(document).ready(function() {
//        App.init();
//        App.initScrollBar();
//		Load Carousel after books -> moved to book.js
//		OwlCarousel.initOwlCarousel();
//        StyleSwitcher.initStyleSwitcher();
//        MasterSliderShowcase2.initMasterSliderShowcase2();
    });
</script>
<script id="notificationTemplate" type="text/x-jsrender">
	<table class="table table-hover table-condensed">
		{{for data}}
			<tr id="notification-tr-{{:notification_id}}" data-notification-id="{{:notification_id}}"
			  	data-book-id="{{:book_id}}" data-status="{{:status}}"  data-type="{{:type}}" data-sender="{{:sender.user_id}}" data-detail-loaded="0"
			  	data-loan-id="{{:loan_id}}" data-loan-status="{{:loan_status}}"
				class="{{if status=='NEW'}}new-notification-tr{{/if}} row-notification-tr">
					<td class="book-cover-thumbnail-td"><img class="book-cover-thumbnail-img" src="assets/img/book/s_{{:image}}"></td>
                    <td>
                    	<div><span class="timestamp-span">{{:timestamp}}<span></div>
                    	<div><h4><span class="book-title-span">{{:title}}</span></h4></div>
                    	<div>
                    		{{if type=='BORROW_REQUEST'}}BOOK REQUEST
                    		{{else type=='BORROW_REJECT'}}REQUEST REJECTED
                    		{{else type=='BORROW_ACCEPT'}}REQUEST ACCEPTED
                    		{{else type=='BORROW_STATUS'}}STATUS REMINDER
                    		{{else type=='BOOK_APPROVAL_REQUEST'}}BOOK APPROVAL REQUEST
                    		{{else type=='SYSTEM'}}SYSTEM MESSAGE
                    		{{else type=='USER_TO_USER'}}PERSONAL MESSAGE
                    		{{/if}} from {{:sender.first_name}} {{:sender.last_name}}&lt;{{:sender.email}}&gt;
						</div>
						<div>{{:message}}</div>
					</td>
				<td class="arrow-down-td"><a><i class="fa fa-angle-down" aria-hidden="true" data-notification-id="{{:notification_id}}"></i></a></td>
			</tr>
			<tr id="notification-detail-tr-{{:notification_id}}" class="notification-detail-tr">
				<td colspan="2" id="bookContainer_{{:notification_id}}">
				    <img class="loader-popup-img" src="assets/plugins/revolution-slider/rs-plugin/assets/loader.gif">
				<td>
			</tr>
		{{/for}}
	</table>
</script>

<script id="bookTemplate" type="text/x-jsrender">
	{{for data}}
		<div class="col-md-3">
			<img src="assets/img/book/{{:image}}" class="notification-img" alt="lorem ipsum dolor sit">
		</div>

		<div class="col-md-9">
			<div class="shop-product-heading">
				<h2>{{:title}}</h2>
				<p class="wishlist-category"><strong>Authors:</strong>
				{{for authors}}<a href="#">{{>name}}</a> {{/for}}
				</p>
			</div><!--/end shop product social-->

			<ul class="list-inline product-ratings margin-bottom-30">
				<li>Book status: <small class="shop-bg-green time-day-left book-status-{{:book_id}}" data-book-status="{{:status}}" id="book-{{:~root.notification_id}}" >{{:status}} </small></li>
				<li>Loan status: <small class="shop-bg-green time-day-left book-status-{{:book_id}}" data-loan-status="{{:~root.loan_status}}" id="loan-{{:~root.notification_id}}" >{{:~root.loan_status}} </small></li>
			</ul>
			{{:description}}
			<div>Loan period: <strong>{{:loan_period}} days</strong></div>
			<div class="margin-bottom-40" id="actionButtonDiv_{{:book_id}}">
				<button type="button" class="btn-u btn-u-sea-shop btn-u-lg approveButton"
					id="approveButton-{{:~root.notification_id}}" data-book-id='{{:book_id}}'
					data-notification-id="{{:~root.notification_id}}"  data-type="{{:~root.type}}">APPROVE</button>
				<button type="button" class="btn-u btn-u-sea-shop btn-u-lg rejectButton"
					id="rejectButton-{{:~root.notification_id}}" data-book-id='{{:book_id}}'
					data-notification-id="{{:~root.notification_id}}" data-type="{{:~root.type}}">REJECT</button>
				<button type="button" class="btn-u btn-u-sea-shop btn-u-lg returnButton"
					id="returnButton-{{:~root.notification_id}}" data-book-id='{{:book_id}}'
					data-notification-id="{{:~root.notification_id}}"  data-type="{{:~root.type}}">RETURN</button>
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
