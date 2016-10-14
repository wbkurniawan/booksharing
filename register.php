<?php
$lock = false;
include_once(__DIR__.'/header.php');
?>
    <link rel="stylesheet" href="assets/css/pages/log-reg-v3.css">
    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">Register</span>
            <h1>BOOK <span class="shop-green">SHARING</span></h1>
            <!--
            <ul class="breadcrumb-v4-in">
                <li><a href="deprecated-index.html">Home</a></li>
                <li><a href="">Product</a></li>
                <li class="active">Log In</li>
            </ul> /end breadcrumbs -->
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->

    <!--=== Registre ===-->
    <div class="log-reg-v3 content-md margin-bottom-30">
        <div class="container">
            <div class="row">

                <div class="col-md-7 md-margin-bottom-50 login-welcome-text-responsive">
                    <h2 class="welcome-title">Welcome to our Booksharing Community</h2>
                    <p>Got some good books worth reading? Or wanna find books of various categories?
                        Become part of a growing community, share them with us or let others share them to you.
                    </p><br>
                    <div class="row margin-bottom-50" id="statsContainer">
                    </div>
                    <div class="members-number">
                        <h3>Soli <span class="shop-green">Deo</span> Gloria</h3>
                    </div>
                </div>


                <div class="col-md-5 login-form-responsive">
                    <form id="sky-form4" class="log-reg-block sky-form">
                        <h2>Create New Account</h2>

                        <div class="login-input reg-input">
                            <div class="row">
                                <div class="col-sm-6">
                                    <section class="register-section">
                                        <label class="input">
                                            <input type="text" name="firstName" placeholder="First name" class="form-control">
                                        </label>
                                    </section>
                                </div>
                                <div class="col-sm-6">
                                    <section class="register-section">
                                        <label class="input">
                                            <input type="text" name="lastName" placeholder="Last name" class="form-control">
                                        </label>
                                    </section>
                                </div>
                            </div>

                            <section class="register-section">
                                <label class="input">
                                    <input type="email" name="email" placeholder="Email address" class="form-control">
                                </label>
                            </section>
                            <section class="register-section">
                                <label class="input">
                                    <input type="password" name="password" placeholder="Password" id="password" class="form-control">
                                </label>
                            </section>
                            <section class="register-section">
                                <label class="input">
                                    <input type="password" name="passwordConfirm" placeholder="Confirm password" class="form-control">
                                </label>
                            </section>
                            <section class="register-section">
                                <label class="input">
                                    <input type="tel" name="phone" placeholder="Phone number" class="form-control">
                                </label>
                            </section>
                            <section class="register-section">
                                <label class="input">
                                    <input type="text" name="invitation" placeholder="Invitation Code" class="form-control">
                                </label>
                            </section>
                        </div>

                        <label class="checkbox margin-bottom-10">
                            <input type="checkbox" name="newsletterSubscriber"/>
                            <i></i>
                            Subscribe to our newsletter to get the latest offers
                        </label>
                        <label class="checkbox margin-bottom-20">
                            <input type="checkbox" name="terms"/>
                            <i></i>
                            I have read agreed with the <a href="termCondition.php" target="_blank">terms &amp; conditions</a>
                        </label>
                        <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit">Create Account</button>
                    </form>

                    <div class="margin-bottom-20"></div>
                    <p class="text-center">Already have an account? <a href="login.php">Sign In</a></p>
                </div>


            </div><!--/end row-->
        </div><!--/end container-->
    </div>
    <!--=== End Registre ===-->

<?php include_once(__DIR__.'/footer.php'); ?>

</div><!--/wrapper-->

<script id="statsTemplate" type="text/x-jsrender">
    <div class="col-sm-4 md-margin-bottom-20">
        <div class="site-statistics">
            <span><a href="list.php?categoryId=0">{{:total_book}}</a></span>
            <small>books</small>
        </div>
    </div>
    <div class="col-sm-4 md-margin-bottom-20">
        <div class="site-statistics">
            <span><a href="list.php?categoryId=0">{{:total_category}}</a></span>
            <small>categories</small>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="site-statistics">
            <span>1</span>
            <small>purpose</small>
        </div>
    </div>
</script>

<!-- JS Global Compulsory -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Alertify.js -->
<script src="//cdn.jsdelivr.net/alertifyjs/1.8.0/alertify.min.js"></script>

<!-- Get the data -->
<script src="assets/js/jsrender.js"></script>
<script src="assets/js/app/header.js"></script>
<script src="assets/js/app/register.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<!--<script src="assets/plugins/smoothScroll.js"></script>-->
<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
<!--<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>-->
<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script src="assets/js/shop.app.js"></script>
<script src="assets/js/plugins/style-switcher.js"></script>
<script src="assets/js/forms/page_registration.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
//        App.initScrollBar();
        Registration.initRegistration();
//        StyleSwitcher.initStyleSwitcher();
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
