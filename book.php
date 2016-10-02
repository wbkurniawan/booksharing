<?php
$bookId = isset($_GET["id"])?$_GET["id"]:0;
$lock = false;
include_once(__DIR__.'/header.php');
?>

	<input type="hidden" id="bookId" value="<?=$bookId?>">
    <!--=== Shop Product ===-->
    <div class="shop-product" id="eventWrapper">
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                <li><a href="list.php?categoryId=0">Books</a></li>
                <li class="active"><a href="#" id="breadcrumbCategoryName"></a></li>
            </ul>
        </div>
        <!-- End Breadcrumbs v5 -->

        <div class="container">
            <div class="row" id="bookContainer">

            </div><!--/end row-->
        </div>
    </div>
    <!--=== End Shop Product ===-->

    <!--=== Content Medium ===-->

    <!--=== End Content Medium ===-->

     <!--=== Illustration v2 ===-->
    <div class="container">
		<div class="heading heading-v1 margin-bottom-20">
			<h2>Books You May Like</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed odio elit, ultrices vel cursus sed, placerat ut leo. Phasellus in magna erat. Etiam gravida convallis augue non tincidunt. Nunc lobortis dapibus neque quis lacinia. Nam dapibus tellus sit amet odio venenatis</p>
		</div>

		<!--=== Illustration v2 ===-->
		<div class="illustration-v2 margin-bottom-60">
			<div class="customNavigation margin-bottom-25">
				<a class="owl-btn prev rounded-x"><i class="fa fa-angle-left"></i></a>
				<a class="owl-btn next rounded-x"><i class="fa fa-angle-right"></i></a>
			</div>

			<ul class="list-inline owl-slider" id="personalRecommendationBooksContainer">
			</ul>
		</div>
	</div>
		<!--=== End Illustration v2 ===-->

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
<script src="assets/js/app/book.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<!--<script src="assets/plugins/smoothScroll.js"></script>-->
<script src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<!--<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>-->
<!-- Master Slider -->
<!--<script src="assets/plugins/master-slider/quick-start/masterslider/masterslider.min.js"></script>-->
<!--<script src="assets/plugins/master-slider/quick-start/masterslider/jquery.easing.min.js"></script>-->
<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script src="assets/js/shop.app.js"></script>
<script src="assets/js/plugins/owl-carousel.js"></script>
<!--<script src="assets/js/plugins/master-slider.js"></script>-->
<!--<script src="assets/js/forms/product-quantity.js"></script>-->
<!--<script src="assets/js/plugins/style-switcher.js"></script>-->
<script>
    jQuery(document).ready(function() {
        App.init();
//        App.initScrollBar();
//		Load Carousel after books -> moved to book.js
//		OwlCarousel.initOwlCarousel();
//        StyleSwitcher.initStyleSwitcher();
//        MasterSliderShowcase2.initMasterSliderShowcase2();
    });
</script>

<script id="personalRecommendationBooksTemplate" type="text/x-jsrender">
	{{for data}}
		<li class="item">
			<div class="product-img">
				<a href="book.php?id={{:book_id}}"><img class="full-width img-responsive" src="assets/img/book/{{:image}}" alt=""></a>
				<a class="add-to-cart" href="book.php?id={{:book_id}}"><i class="fa fa-book"></i>VIEW DETAILS</a>
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
			</div>
		</li>
	{{/for}}
</script>

<script id="bookTemplate" type="text/x-jsrender">
	{{for data}}
		<div class="col-md-4">
			<img src="assets/img/book/{{:image}}" width="100%" alt="lorem ipsum dolor sit">
		</div>

		<div class="col-md-8">
			<div class="shop-product-heading">
				<h2>{{:title}}</h2>
				<p class="wishlist-category"><strong>Authors:</strong>
				{{for authors}}<a href="list.php?authorId={{:author_id}}">{{>name}}</a> {{/for}}
				</p>
			</div><!--/end shop product social-->

			<ul class="list-inline product-ratings margin-bottom-30">
				<li><small class="{{if status=="AVAILABLE"}}shop-rgba-dark-green{{else}}shop-rgba-red{{/if}} time-day-left">{{:status}}</small></li>
			</ul><!--/end shop product ratings-->
			<div class="book-description-detail">{{:description}}</div>
			<div class="margin-bottom-40">
				{{if status=="AVAILABLE"}}
					<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" id="borrowButton" data-book-id='{{:book_id}}'>BORROW</button>
				{{else}}
					<button type="button" disabled class="btn-u btn-u-sea-shop btn-u-lg btn-disabled" id="borrowButton" data-book-id='{{:book_id}}'>BORROW</button>
				{{/if}}
			</div><!--/end product quantity-->

			<ul class="list-inline add-to-wishlist add-to-wishlist-brd">
				<li class="wishlist-in">
					<i class="fa fa-user"></i>
					Owner: <strong>{{for user}}{{>first_name}} {{>last_name}}{{/for}}</strong>
				</li>
				<li class="compare-in">
					<i class="fa fa-calendar"></i>
					Loan period: <strong>{{:loan_period}} days</strong>
				</li>
			</ul>
		</div>
	{{/for}}
</script>

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>
