<?php
include_once(__DIR__.'/model/class/UserSession.php');

$lock = true;
include_once (__DIR__.'/lock.php');

if(!isset($_SESSION["user"])){
	header('Location: /booksharing/index.php');
	die();
}else{
	$userSession =  unserialize($_SESSION["user"]);
	$userId = $userSession->userId;
}

include_once(__DIR__.'/header.php');
?>

    <!--=== Shop Product ===-->
    <div class="shop-product" >
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                <li class="active">Personal Data</a></li>
            </ul>
        </div>
        <!-- End Breadcrumbs v5 -->


    </div>
    <!--=== End Shop Product ===-->

     <!--=== Illustration v2 ===-->
    <div class="container" id="eventWrapper">
		<div id="bookListContainer">
		</div>
		<div class="container">
			<div class="heading heading-v1 margin-bottom-20">
				<h2> Edit Personal Data
				</h2>
			</div>
			<div class="row" id="userContainer">

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
<script src="assets/js/app/user.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<!--<script src="assets/plugins/smoothScroll.js"></script>-->
<!--<script src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>-->
<!--<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>-->
<!-- Master Slider -->
<!--<script src="assets/plugins/master-slider/quick-start/masterslider/masterslider.min.js"></script>-->
<!--<script src="assets/plugins/master-slider/quick-start/masterslider/jquery.easing.min.js"></script>-->
<!-- JS Customization -->
<!--<script src="assets/js/custom.js"></script>-->
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

<script id="userTemplate" type="text/x-jsrender">
	<div class="edit-user-div">
		{{for data}}
				<form id="updatePersonalDataForm" class="form-horizontal">
					<div class="form-group">
						<label for="firstName">First Name*: </label>
						<input type="text" id="firstNameInput" name="firstName" value="{{:first_name}}" class="form-control" placeholder="First name">
					</div>
					<div class="form-group">
						<label for="last_name">Last Name*: </label>
						<input type="text" id="lastNameInput" name="lastName" value="{{:last_name}}" class="form-control" placeholder="Last name">
					</div>
					<div class="form-group">
						<label for="email">Email*: </label>
						<input type="text" id="emailInput" name="email" value="{{:email}}" class="form-control" placeholder="Email">
					</div>
<!--					<div class="form-group">-->
<!--						<label for="password">Password*: </label>-->
<!--						<input type="password" id="passwordInput" name="password" class="form-control" placeholder="Change password">-->
<!--					</div>-->
<!--					<div class="form-group">-->
<!--						<label for="retype-password">Re-type password*: </label>-->
<!--						<input type="password"  id="retypePasswordInput" name="retype-password" class="form-control" placeholder="Retype password">-->
<!--					</div>-->
					<div class="form-group">
						<label for="phone">Phone: </label>
						<input type="text" name="phone" value="{{:phone}}" class="form-control" placeholder="Phone">
					</div>
				</form>
		{{/for}}
		<div class="margin-bottom-40">
			<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" id="saveButton">SAVE</button>
			<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" id="changePasswordButton" style="float:right">CHANGE PASSWORD</button>
		</div>
	</div>

</script>

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>
