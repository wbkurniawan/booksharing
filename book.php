<?php
	$bookId = isset($_GET["id"])?$_GET["id"]:0;
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>I Don't Have Enough Faith to Be an Atheist | Book Sharing</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
	<link rel="shortcut icon" href="favicon.png">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/shop.style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="assets/css/headers/header-v5.css">
    <link rel="stylesheet" href="assets/css/footers/footer-v4.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/master-slider/quick-start/masterslider/style/masterslider.css">
    <link rel='stylesheet' href="assets/plugins/master-slider/quick-start/masterslider/skins/default/style.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="assets/css/theme-colors/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body class="header-fixed" data-book-id="<?=$bookId?>">

<div class="wrapper">
	<!--=== Header v5 ===-->
	<div class="header-v5 header-static">
		<!-- Topbar v3 -->
		<div class="topbar-v3">
			<div class="search-open">
				<div class="container">
					<input type="text" class="form-control" placeholder="Search">
					<div class="search-close"><i class="icon-close"></i></div>
				</div>
			</div>

			<div class="container">
				<div class="row">
					brought to you by <a href="#">Komisi Perpustakaan</a> at <a href="#">FeG Immanuel Berlin</a>
<!-- 					<div class="col-sm-6"> -->
						<!-- Topbar Navigation -->
<!--
						<ul class="left-topbar">
							<li><a href="#">FEG Immanuel Website</a></li>
							<li>
								<a>Language (EN)</a>
								<ul class="language">
									<li class="active">
										<a href="#">English (EN)<i class="fa fa-check"></i></a>
									</li>
									<li><a href="#">Deutsch (DE)</a></li>
									<li><a href="#">Bahasa (IN)</a></li>
								</ul>
							</li>
						</ul>
-->
						<!--/end left-topbar-->
<!--
					</div>
					<div class="col-sm-6">
						<ul class="list-inline right-topbar pull-right">
							<li><a href="#">Account</a></li>
							<li><a href="shop-ui-login.html">Login</a> | <a href="shop-ui-register.html">Register</a></li>
							<li><i class="search fa fa-search search-button"></i></li>
						</ul>
					</div>
-->
				</div>
			</div><!--/container-->
		</div>
		<!-- End Topbar v3 -->

		<!-- Navbar -->
		<div class="navbar navbar-default mega-menu" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">
						<img id="logo-header" src="assets/img/full_logo.png" alt="Logo">
					</a>
				</div>

				<!-- Shopping Cart -->
				<div class="shop-badge badge-icons pull-right">
				  <a href="#"><i class="fa fa-user"></i></a><br>
				  <div class="badge-open">
					<ul class="list-unstyled mCustomScrollbar" data-mcs-theme="minimal-dark">
						<li>
								<a href="login.html" class="btn-u btn-u-sea-shop btn-block">Login</a>
								<a href="register.html" class="btn-u btn-brd btn-brd-hover btn-u-sea-shop btn-block">Register</a>
						</li>
					</ul>
				  </div>
				</div>
				<!-- End Shopping Cart -->

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-responsive-collapse">
					<!-- Nav Menu -->
					<ul class="nav navbar-nav">
						<!-- Pages -->
						<li class="dropdown active">
							<a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
								Books
							</a>
							<ul class="dropdown-menu" id="categoryContainer">
							</ul>
						</li>
						<!-- End Pages -->

						<!-- Promotion -->
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
								FAQ
							</a>
						</li>
						<!-- End Promotion -->

						<!-- Gifts -->
						<li class="dropdown mega-menu-fullwidth">
							<a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
								About
							</a>
						</li>
						<!-- End Gifts -->
					</ul>
					<!-- End Nav Menu -->
				</div>
			</div>
		</div>
		<!-- End Navbar -->
	</div>
	<!--=== End Header v5 ===-->

    <!--=== Shop Product ===-->
    <div class="shop-product">
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Books</a></li>
                <li class="active">Apologetik</li>
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
<!--
    <div class="content-md container">
        <div class="tab-v5">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#description" role="tab" data-toggle="tab">Description</a></li>
                <li><a href="#reviews" role="tab" data-toggle="tab">Reviews (7)</a></li>
            </ul>

            <div class="tab-content">
-->
                <!-- Description -->
<!--
                <div class="tab-pane fade in active" id="description">
                            <h3 class="heading-md margin-bottom-20">About the Authors</h3>
<p>Norman L. Geisler is author or coauthor of some sixty books, including The Baker Encyclopedia of Christian Apologetics and his four-volume Systematic Theology. He has taught at the university and graduate level for nearly forty years and has spoken or debated in all fifty states and in twenty-five countries. He holds a Ph.D. in philosophy from Loyola University and now serves as president of Southern Evangelical Seminary.</p>
                            <p>Frank Turek holds two Master’s degrees and is pursuing a doctorate in apologetics at Southern Evangelical Seminary, where he serves as vice president. He has appeared on numerous television and radio programs including The O’Reilly Factor, Hannity and Colmes, and Politically Incorrect. His first book, Legislating Morality: Is It Wise? Is It Legal? Is It Possible? (coauthored with Norman Geisler) won the Evangelical Christian Publishers Association’s Gold Medallion award as the best book in its category.</p><br>

                            <h3 class="heading-md margin-bottom-20">Book Details</h3>
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled specifies-list">
                                        <li><i class="fa fa-caret-right"></i>Paperback: <span>448 pages</span></li>
                                        <li><i class="fa fa-caret-right"></i>Publisher: <span>Crossway; 1St Edition edition (March 12, 2004)</span></li>
                                        <li><i class="fa fa-caret-right"></i>Language: <span>English</span></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled specifies-list">
                                        <li><i class="fa fa-caret-right"></i>ISBN-10: <span>1581345615</span></li>
                                        <li><i class="fa fa-caret-right"></i>ISBN-13: <span>978-1581345612</span></li>
                                        <li><i class="fa fa-caret-right"></i>Book Dimensions: <span>5.5 x 1 x 8.5 inches</span></li>
                                    </ul>
                                </div>
                        	</div>
                </div>
-->
                <!-- End Description -->

                <!-- Reviews -->
<!--
                <div class="tab-pane fade" id="reviews">
                    <div class="product-comment margin-bottom-40">
                        <div class="product-comment-in">
                            <img class="product-comment-img rounded-x" src="assets/img/team/dl.png" alt="">
                            <div class="product-comment-dtl">
                                <h4>David Limbaugh <small>22 days ago</small></h4>
                                <p>I already know ten people to whom I will give this book. It's truly a Godsend.</p>
                                <ul class="list-inline product-ratings">
                                    <li class="reply"><a href="#">Reply</a></li>
                                    <li class="pull-right">
                                        <ul class="list-inline">
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating fa fa-star"></i></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-comment-in">
                            <img class="product-comment-img rounded-x" src="assets/img/team/ls.jpeg" alt="">
                            <div class="product-comment-dtl">
                                <h4>Lee Strobel <small>27 days ago</small></h4>
                                <p>I wish this book had been available when I was an atheist-it would have saved a lot of time in my spiritual journey toward God!</p>
                                <ul class="list-inline product-ratings">
                                    <li class="reply"><a href="#">Reply</a></li>
                                    <li class="pull-right">
                                        <ul class="list-inline">
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-comment-in">
                            <img class="product-comment-img rounded-x" src="assets/img/team/jm.jpg" alt="">
                            <div class="product-comment-dtl">
                                <h4>Josh McDowell <small>28 days ago</small></h4>
                                <p>If you're still a skeptic after reading I Don't Have Enough Faith to Be an Atheist, then I suspect you're living in denial!</p>
                                <ul class="list-inline product-ratings">
                                    <li class="reply"><a href="#">Reply</a></li>
                                    <li class="pull-right">
                                        <ul class="list-inline">
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating fa fa-star"></i></li>
                                            <li><i class="rating fa fa-star"></i></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-comment-in">
                            <img class="product-comment-img rounded-x" src="assets/img/team/pj.jpg" alt="">
                            <div class="product-comment-dtl">
                                <h4>Phillip E. Johnson <small>30 days ago</small></h4>
                                <p>Atheism requires gobs of blind faith while the path of logic and reason leads straight to the gospel of Jesus Christ. Geisler and Turek convincingly show why.</p>
                                <ul class="list-inline product-ratings">
                                    <li class="reply"><a href="#">Reply</a></li>
                                    <li class="pull-right">
                                        <ul class="list-inline">
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating fa fa-star"></i></li>
                                            <li><i class="rating fa fa-star"></i></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-comment-in">
                            <img class="product-comment-img rounded-x" src="assets/img/team/hh.jpg" alt="">
                            <div class="product-comment-dtl">
                                <h4>Hank Hanegraaff <small>49 days ago</small></h4>
                                <p>I Don't Have Enough Faith to Be an Atheist will equip, exhort, and encourage you'to give the reason for the hope that you have . . . with gentleness and respect.</p>
                                <ul class="list-inline product-ratings">
                                    <li class="reply"><a href="#">Reply</a></li>
                                    <li class="pull-right">
                                        <ul class="list-inline">
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating fa fa-star"></i></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-comment-in">
                            <img class="product-comment-img rounded-x" src="assets/img/team/ct.jpg" alt="">
                            <div class="product-comment-dtl">
                                <h4>Cal Thomas <small>53 days ago</small></h4>
                                <p>This book should disturb anyone claiming to be an atheist . . . perhaps enough to persuade them to begin a search for the God who has been there all along.</p>
                                <ul class="list-inline product-ratings">
                                    <li class="reply"><a href="#">Reply</a></li>
                                    <li class="pull-right">
                                        <ul class="list-inline">
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating fa fa-star"></i></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-comment-in">
                            <img class="product-comment-img rounded-x" src="assets/img/team/wd.jpeg" alt="">
                            <div class="product-comment-dtl">
                                <h4>William A. Dembski <small>65 days ago</small></h4>
                                <p>Geisler and Turek present the crucial information needed to avoid being swept away by the onslaughts of secular ideologies that cast science, philosophy, and biblical studies as enemies of the Christian faith.</p>
                                <ul class="list-inline product-ratings">
                                    <li class="reply"><a href="#">Reply</a></li>
                                    <li class="pull-right">
                                        <ul class="list-inline">
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating-selected fa fa-star"></i></li>
                                            <li><i class="rating fa fa-star"></i></li>
                                            <li><i class="rating fa fa-star"></i></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <h3 class="heading-md margin-bottom-30">Add a review</h3>
                    <form action="assets/php/demo-contacts-process.php" method="post" id="sky-form3" class="sky-form sky-changes-4">
                        <fieldset>
                            <div class="margin-bottom-30">
                                <label class="label-v2">Name</label>
                                <label class="input">
                                    <input type="text" name="name" id="name">
                                </label>
                            </div>

                            <div class="margin-bottom-30">
                                <label class="label-v2">Email</label>
                                <label class="input">
                                    <input type="email" name="email" id="email">
                                </label>
                            </div>

                            <div class="margin-bottom-30">
                                <label class="label-v2">Review</label>
                                <label class="textarea">
                                    <textarea rows="7" name="message" id="message"></textarea>
                                </label>
                            </div>
                        </fieldset>

                        <footer class="review-submit">
                            <label class="label-v2">Review</label>
                            <div class="stars-ratings">
                                <input type="radio" name="stars-rating" id="stars-rating-5">
                                <label for="stars-rating-5"><i class="fa fa-star"></i></label>
                                <input type="radio" name="stars-rating" id="stars-rating-4">
                                <label for="stars-rating-4"><i class="fa fa-star"></i></label>
                                <input type="radio" name="stars-rating" id="stars-rating-3">
                                <label for="stars-rating-3"><i class="fa fa-star"></i></label>
                                <input type="radio" name="stars-rating" id="stars-rating-2">
                                <label for="stars-rating-2"><i class="fa fa-star"></i></label>
                                <input type="radio" name="stars-rating" id="stars-rating-1">
                                <label for="stars-rating-1"><i class="fa fa-star"></i></label>
                            </div>
                            <button type="button" class="btn-u btn-u-sea-shop btn-u-sm pull-right">Submit</button>
                        </footer>
                    </form>
                </div>
-->
                <!-- End Reviews -->
<!--
            </div>
        </div>
    </div>
-->
    <!--/end container-->
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
		<!--=== End Illustration v2 ===-->

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
<script src="assets/js/app/book.js"></script>

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

	<script id="categoriesTemplate" type="text/x-jsrender">
	{{for data}}
		<li><a href="#" data-category-id="{{:category_id}}">{{:name}}</a></li>
	{{/for}}
</script>

<script id="personalRecommendationBooksTemplate" type="text/x-jsrender">
	{{for data}}
		<li class="item">
			<div class="product-img">
				<a href="book.php?id={{:book_id}}"><img class="full-width img-responsive" src="assets/img/book/{{:book_id}}.jpg" alt=""></a>
				<a class="product-review" href="book.php?id={{:book_id}}">Quick review</a>
				<a class="add-to-cart" href="#"><i class="fa fa-book"></i>Add to list</a>
			</div>
			<div class="product-description product-description-brd">
				<div class="overflow-h margin-bottom-5">
					<div class="pull-left">
						<h4 class="title-price"><a href="book.php?id={{:book_id}}">{{:title}}</a></h4>
						<span class="gender text-uppercase">{{for categories}}{{>name}}{{/for}}</span>
						<span class="gender">{{:authors}}</span>
					</div>
				</div>
				<ul class="list-inline product-ratings">
					<li><i class="rating{{if rating>=1}}-selected{{/if}} fa fa-star"></i></li>
					<li><i class="rating{{if rating>=2}}-selected{{/if}} fa fa-star"></i></li>
					<li><i class="rating{{if rating>=3}}-selected{{/if}} fa fa-star"></i></li>
					<li><i class="rating{{if rating>=4}}-selected{{/if}} fa fa-star"></i></li>
					<li><i class="rating{{if rating>=5}}-selected{{/if}} fa fa-star"></i></li>
					<li class="like-icon"><a data-original-title="Add to wishlist" data-toggle="tooltip" data-placement="left" class="tooltips" href="#"><i class="fa fa-heart"></i></a></li>
				</ul>
			</div>
		</li>
	{{/for}}
</script>

<script id="bookTemplate" type="text/x-jsrender">
	{{for data}}
		<div class="col-md-4">
			<img src="assets/img/book/{{:book_id}}.jpg" width="100%" alt="lorem ipsum dolor sit">
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
			<div class="margin-bottom-40">
				<button type="button" onclick="location.href='success.html';" class="btn-u btn-u-sea-shop btn-u-lg" >BORROW</button>
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
