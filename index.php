<?php
$lock = false;
include_once(__DIR__.'/header.php');
?>
	<!--=== Slider ===-->
	<div class="tp-banner-container">
		<div class="tp-banner">
			<ul>
				
				<!-- SLIDE 1-->
				<li class="revolution-mch-1" data-transition="fade" data-slotamount="3" data-masterspeed="1000" data-title="Books">
					<!-- MAIN IMAGE -->
					<img src="assets/img/2.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

					<div class="tp-caption revolution-ch5 sft start"
						data-x="left"
						data-hoffset="0"
						data-y="140"
						data-speed="1500"
						data-start="500"
						data-easing="Back.easeInOut"
						data-endeasing="Power1.easeIn"
						data-endspeed="300">
						Growing <br> <strong>Collection</strong>
					</div>

					<!-- LAYER -->
					<div class="tp-caption revolution-ch4 sft"
						data-x="left"
						data-hoffset="-14"
						data-y="210"
						data-speed="1400"
						data-start="2000"
						data-easing="Power4.easeOut"
						data-endspeed="300"
						data-endeasing="Power1.easeIn"
						data-captionhidden="off"
						style="z-index: 6">
						From apologetics-themed books to books<br> 
						for your little ones, you can find them here.
					</div>

					<!-- LAYER -->
					<div class="tp-caption sft"
						data-x="left"
						data-hoffset="0"
						data-y="300"
						data-speed="1600"
						data-start="1800"
						data-easing="Power4.easeOut"
						data-endspeed="300"
						data-endeasing="Power1.easeIn"
						data-captionhidden="off"
						style="z-index: 6">
						<a href="list.php?categoryId=0" class="btn-u btn-brd btn-brd-hover btn-u-light">BOOKS</a>
					</div>
				</li>
				<!-- END SLIDE 1-->
				
				<!-- SLIDE 2-->
				<li class="revolution-mch-1" data-transition="fade" data-slotamount="3" data-masterspeed="1000" data-title="FAQ">
					<!-- MAIN IMAGE -->
					<img src="assets/img/10.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="right top" data-bgrepeat="no-repeat">

					<div class="tp-caption revolution-ch8 sft start"
						data-x="right"
						data-hoffset="5"
						data-y="130"
						data-speed="1500"
						data-start="500"
						data-easing="Back.easeInOut"
						data-endeasing="Power1.easeIn"
						data-endspeed="300">
						How Can<br>We <strong>Help</strong>?
					</div>

					<!-- LAYER -->
					<div class="tp-caption revolution-ch7 sft"
						data-x="right"
						data-hoffset="0"
						data-y="210"
						data-speed="1400"
						data-start="2000"
						data-easing="Power4.easeOut"
						data-endspeed="300"
						data-endeasing="Power1.easeIn"
						data-captionhidden="off"
						style="z-index: 6">
						Troubles using the website?
					</div>

					<!-- LAYER -->
					<div class="tp-caption sft"
						data-x="right"
						data-hoffset="0"
						data-y="300"
						data-speed="1600"
						data-start="2800"
						data-easing="Power4.easeOut"
						data-endspeed="300"
						data-endeasing="Power1.easeIn"
						data-captionhidden="off"
						style="z-index: 6">
						<a href="faq.php" class="btn-u btn-brd btn-brd-hover btn-u-light">FAQ</a>
					</div>
				</li>
				<!-- END SLIDE 2-->
				
				<!-- SLIDE 3 -->
				<li class="revolution-mch-1" data-transition="fade" data-slotamount="3" data-masterspeed="1000" data-title="About">
					<!-- MAIN IMAGE -->
					<img src="assets/img/6.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">

					<div class="tp-caption revolution-ch3 sft start"
						data-x="center"
						data-hoffset="0"
						data-y="140"
						data-speed="1500"
						data-start="500"
						data-easing="Back.easeInOut"
						data-endeasing="Power1.easeIn"
						data-endspeed="300">
						Book<br><strong>Sharing</strong>
					</div>

					<!-- LAYER -->
					<div class="tp-caption revolution-ch6 sft"
						data-x="center"
						data-hoffset="-14"
						data-y="210"
						data-speed="1400"
						data-start="2000"
						data-easing="Power4.easeOut"
						data-endspeed="300"
						data-endeasing="Power1.easeIn"
						data-captionhidden="off"
						style="z-index: 6">
						Who are we?
					</div>

					<!-- LAYER -->
					<div class="tp-caption sft"
						data-x="center"
						data-hoffset="0"
						data-y="300"
						data-speed="1600"
						data-start="1800"
						data-easing="Power4.easeOut"
						data-endspeed="300"
						data-endeasing="Power1.easeIn"
						data-captionhidden="off"
						style="z-index: 6">
						<a href="about.php" class="btn-u btn-brd btn-brd-hover btn-u-light">ABOUT</a>
					</div>
				</li>
				<!-- END SLIDE3 -->
								
			</ul>
			<div class="tp-bannertimer tp-bottom"></div>
		</div>
	</div>
	<!--=== End Slider ===-->

	<!--=== Product Content ===-->
	<div class="container content-md">

		<div class="heading heading-v1 margin-bottom-20">
			<h2>Recommended Books</h2>
			<p>Our picks for the books most likely to shape your evangelical life, thought, and culture.</p>
		</div>

		<!--=== Illustration v2 ===-->
		<div class="illustration-v2 margin-bottom-60">
			<div class="customNavigation margin-bottom-25">
				<a class="owl-btn prev rounded-x"><i class="fa fa-angle-left"></i></a>
				<a class="owl-btn next rounded-x"><i class="fa fa-angle-right"></i></a>
			</div>

			<ul class="list-inline owl-slider" id="recomendedBooksContainer">
			</ul>
		</div>
		<!--=== End Illustration v2 ===-->

		<div class="heading heading-v1 margin-bottom-40">
			<h2>Latest Books</h2>
		</div>

		<!--=== Illustration v2 ===-->
		<div class="row illustration-v2" id="latestBooksContainer">
		</div>
		<!--=== End Illustration v2 ===-->
	</div>
	<!--=== End Product Content ===-->

<?php include_once(__DIR__.'/footer.php'); ?>

</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Get the data -->
<script src="assets/js/jsrender.js"></script>
<script src="assets/js/app/header.js"></script>
<script src="assets/js/app/index.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<!--<script src="assets/plugins/smoothScroll.js"></script>-->
<script src="assets/plugins/jquery.parallax.js"></script>
<script src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<!--<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>-->
<script src="assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/plugins/revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script src="assets/js/shop.app.js"></script>
<script src="assets/js/plugins/owl-carousel.js"></script>
<script src="assets/js/plugins/revolution-slider.js"></script>
<!--<script src="assets/js/plugins/style-switcher.js"></script>-->
<script>
	jQuery(document).ready(function() {
		App.init();
//		App.initScrollBar();
		App.initParallaxBg();
//		Load Carousel after books -> moved to index.js
//		OwlCarousel.initOwlCarousel();
		RevolutionSlider.initRSfullWidth();
//		StyleSwitcher.initStyleSwitcher();
});
</script>

<script id="recommendedBooksTemplate" type="text/x-jsrender">
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

<script id="latestBooksTemplate" type="text/x-jsrender">
	{{for data}}
		<div class="col-md-3 col-sm-6 md-margin-bottom-30">
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
