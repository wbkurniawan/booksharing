<?php
$lock = false;
include_once(__DIR__.'/header.php');
$referer = isset($_SERVER['HTTP_REFERER'])?urlencode($_SERVER['HTTP_REFERER']):"";

?>
<!-- CSS Page Style -->
<link rel="stylesheet" href="assets/css/pages/log-reg-v3.css">

<!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">Log In</span>
            <h1>BOOK <span class="shop-green">SHARING</span></h1>
            <!--
            <ul class="breadcrumb-v4-in">
                <li><a href="index.html">Home</a></li>
                <li><a href="">Product</a></li>
                <li class="active">Log In</li>
            </ul> /end breadcrumbs -->
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->

    <!--=== Login ===-->
    <div class="log-reg-v3 content-md">
        <div class="container">
            <div class="row">
                <div class="col-md-7 md-margin-bottom-50">
                    <h2 class="welcome-title">Welcome to our Booksharing Community</h2>
                    <p>Got some good books worth reading? Or wanna find books of various categories? 
                       Become part of a growing community, share them with us or let others share them to you.
                    </p><br>
                    <div class="row margin-bottom-50">
                        <div class="col-sm-4 md-margin-bottom-20">
                            <div class="site-statistics">
                                <span>321</span>
                                <small>titles</small>
                            </div>
                        </div>
                        <div class="col-sm-4 md-margin-bottom-20">
                            <div class="site-statistics">
                                <span>22</span>
                                <small>categories</small>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="site-statistics">
                                <span>1</span>
                                <small>purpose</small>
                            </div>
                        </div>
                    </div>
                    <div class="members-number">
                        <h3>Soli <span class="shop-green">Deo</span> Gloria</h3>
                        <img class="img-responsive" src="assets/img/map.png" alt="">
                    </div>
                </div>

                <div class="col-md-5">
                    <form id="sky-form1" class="log-reg-block sky-form">
                        <h2>Log in to your account</h2>
						<input type="hidden" id="referer" name="referer" value="<?=$referer?>">
                        <section>
                            <label class="input login-input">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="email" placeholder="Email Address" name="email" class="form-control">
                                </div>
                            </label>
                        </section>
                        <section>
                            <label class="input login-input no-border-top">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" placeholder="Password" name="password" class="form-control">
                                </div>
                            </label>
                        </section>
                        <div class="row margin-bottom-5">
<!--                            <div class="col-xs-6">-->
<!--                                <label class="checkbox">-->
<!--                                    <input type="checkbox" name="checkbox"/>-->
<!--                                    <i></i>-->
<!--                                    Remember me-->
<!--                                </label>-->
<!--                            </div>-->
<!--                            <div class="col-xs-6 text-right">-->
<!--                                <a href="#">Forgot your Password?</a>-->
<!--                            </div>-->
                        </div>
                        <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit">Log in</button>

<!--                        <div class="border-wings">-->
<!--                            <span>or</span>-->
<!--                        </div>-->

<!--                        <div class="row columns-space-removes">-->
<!--                            <div class="col-lg-12 margin-bottom-10">-->
<!--                                <button type="button" class="btn-u btn-u-md btn-u-fb btn-block"><i class="fa fa-facebook"></i> Facebook Log In</button>-->
<!--                            </div>-->
<!--                            <!--Twitter login-->
<!--                            <div class="col-lg-6">-->
<!--                                <button type="button" class="btn-u btn-u-md btn-u-tw btn-block"><i class="fa fa-twitter"></i> Twitter Log In</button>-->
<!--                            </div>-->
<!--                        </div>-->
                    </form>

                    <div class="margin-bottom-20"></div>
                    <p class="text-center">Don't have an account yet? <a href="register.php">Sign up for a new account</a></p>
                </div>
            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <!--=== End Login ===-->

    <!--=== Shop Suvbscribe ===
    <div class="shop-subscribe">
        <div class="container">
            <div class="row">
                <div class="col-md-8 md-margin-bottom-20">
                    <h2>subscribe to our weekly <strong>newsletter</strong></h2>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Email your email...">
                        <span class="input-group-btn">
                            <button class="btn" type="button"><i class="fa fa-envelope-o"></i></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <!--=== End Shop Suvbscribe ===-->

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
<script src="assets/js/app/login.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<!--<script src="assets/plugins/smoothScroll.js"></script>-->
<!--<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>-->
<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script src="assets/js/shop.app.js"></script>
<!--<script src="assets/js/forms/page_login.js"></script>-->
<!--<script src="assets/js/plugins/style-switcher.js"></script>-->
<!--<script src="assets/js/forms/page_contact_form.js"></script>-->
<script>
    jQuery(document).ready(function() {
        App.init();
//        Login.initLogin();
//        App.initScrollBar();
//        StyleSwitcher.initStyleSwitcher();
//        PageContactForm.initPageContactForm();
    });
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
<![endif]-->
<!--[if lt IE 10]>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
<![endif]-->

</body>
</html>
