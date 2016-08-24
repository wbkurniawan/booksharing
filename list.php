<?php
include_once(__DIR__.'/model/class/UserSession.php');

$categoryId = isset($_GET["categoryId"])?(integer)$_GET["categoryId"]:0;
$userId = isset($_GET["userId"])?(integer)$_GET["userId"]:0;
$lock = false;
include_once (__DIR__.'/lock.php');

if($categoryId==0 and $userId==0){
	if(!isset($_SESSION["user"])){
		header('Location: /booksharing/index.php');
		die();
	}else{
		$userSession =  unserialize($_SESSION["user"]);
		$userId = $userSession->userId;
	}
}

//
//if($userId>0 and  !isset($_SESSION["user"])){
//	header('Location: /booksharing/index.php');
//	die();
//}else{
//	$userSession =  unserialize($_SESSION["user"]);
//	$currentUserId = $userSession->userId;
//	if($userId<>$currentUserId){
//		header('Location: /booksharing/index.php');
//		die();
//	}
//}

include_once(__DIR__.'/header.php');
?>

	<input type="hidden" id="categoryId" value="<?=$categoryId?>">
	<input type="hidden" id="userId" value="<?=$userId?>">
    <!--=== Shop Product ===-->
    <div class="shop-product" >
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Books</a></li>
                <li class="active"><a href="#" id="breadcrumbCategoryName"></a></li>
            </ul>
        </div>
        <!-- End Breadcrumbs v5 -->


    </div>
    <!--=== End Shop Product ===-->

    <!--=== Content Medium ===-->

    <!--=== End Content Medium ===-->

     <!--=== Illustration v2 ===-->
    <div class="container" id="eventWrapper">
		<div id="bookListContainer">
		</div>
		<div class="container">
			<div class="row" id="bookListContainer">

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
<script src="assets/js/app/list.js"></script>

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

<script id="bookListTemplate" type="text/x-jsrender">
	<div class="heading heading-v1 margin-bottom-20">
		<h2>
			{{if filter=="CATEGORY"}}
				{{if ~root.data[0]}}
					{{:data[0].categories[0].name}}
				{{/if}}
			{{else}}
				My Books
			{{/if}}
		</h2>
	</div>
	{{if filter != "CATEGORY"}}
		<div class="margin-bottom-40">
				<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" id="addButton" data-book-id='{{:book_id}}'>ADD NEW BOOK</button>
        </div>
	{{/if}}

	{{for data}}
		<div class="item-list">
			<div class="product-img">
				<a href="book.php?id={{:book_id}}"><img class="img-responsive" src="assets/img/book/{{:image}}" alt=""></a>
				<div class="{{if status=="AVAILABLE"}}shop-rgba-dark-green{{else}}shop-rgba-red{{/if}}  rgba-banner">{{:status}}</div>
			</div>
			<div class="product-description product-description-brd">
				<div class="overflow-h margin-bottom-5">
					<div class="pull-left">
						<h4 class="title-price"><a href="book.php?id={{:book_id}}">{{:title}}</a></h4>
						<span class="gender text-uppercase">{{for categories}}{{>name}}{{/for}}</span>
						<span class="gender">{{:authors}}</span>
					</div>
				</div>
				{{if ~root.filter!="CATEGORY"}}
					<ul class="list-inline product-ratings">
						<li class="like-icon"><a href="notification.php?bookId={{:book_id}}"><i class="fa fa-history" aria-hidden="true" title="Loan history"></i></a></li>
						<li class="like-icon"><a href="edit.php?id={{:book_id}}"><i class="fa fa-pencil" title="Edit" aria-hidden="true"></i></a></li>
					</ul>
				{{/if}}
			</div>
		</div>
	{{/for}}
	{{if filter != "CATEGORY"}}
		<div class="margin-bottom-40">
				<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" id="addButton" data-book-id='{{:book_id}}'>ADD NEW BOOK</button>
        </div>
	{{/if}}
</script>

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>
