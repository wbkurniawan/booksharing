<?php
$bookId = isset($_GET["id"])?$_GET["id"]:0;
$lock = false;
include_once(__DIR__.'/header.php');
?>
	<input type="hidden" id="bookId" value="<?=$bookId?>">
    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <h1>Book<span class="shop-green">Sharing</span> Confirmation</h1> 
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->

    <!--=== Content Medium Part ===-->
    <div class="content-md margin-bottom-30" id="eventWrapper">
        <div class="container" id="bookContainer">
        </div>
    </div>
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
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
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
<script src="assets/js/app/success.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<script src="assets/plugins/smoothScroll.js"></script>
<script src="assets/plugins/jquery-steps/build/jquery.steps.js"></script>
<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script src="assets/js/shop.app.js"></script>
<script src="assets/js/forms/page_login.js"></script>
<script src="assets/js/plugins/stepWizard.js"></script>
<script src="assets/js/forms/product-quantity.js"></script>
<script src="assets/js/plugins/style-switcher.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
        Login.initLogin();
        App.initScrollBar();
        StepWizard.initStepWizard();
        StyleSwitcher.initStyleSwitcher();
});
</script>
<script id="bookTemplate" type="text/x-jsrender">
	{{for data}}
        <h1>Your request has been successfully submitted and is in progress.</h1>
                <br><br>

        <div style="margin-bottom:50px" class="row">
            <div class="col-md-3">
                <img src="assets/img/book/{{:image}}" width="80%" alt="Cover">
            </div>

            <div class="col-md-9">
                <div class="shop-product-heading">
                    <h2>{{:title}}</h2>
                    <p class="wishlist-category"><strong>Authors:</strong>
                    {{for authors}}<a href="#">{{>name}}</a> {{/for}}
                    </p>
                </div><!--/end shop product social-->

                <p>Owner: <strong>{{for user}}{{>first_name}} {{>last_name}}{{/for}}</strong></p>
                <p style="margin-bottom:30px">Lending period: {{:loan_period}} days</p>

                <div class="text-left" style="margin-bottom:5px">
                    <button id="continueBrowsingButton"type="button" style="width: 180px" class="btn-u btn-u-sea-shop">Continue browsing</button>
                </div>
                <div class="text-left" style="margin-bottom:5px">
                    <button id="cancelRequestButton" type="button" style="width: 180px" class="btn-u btn-brd btn-brd-hover btn-u-sea-shop">Cancel request</button>
                </div>
                <div class="text-left" style="margin-bottom:5px">
                    <button id="contactAdminButton" type="button" style="width: 180px" class="btn-u btn-brd btn-brd-hover btn-u-sea-shop">Contact admin</button>
                </div>
            </div>
        </div>
	{{/for}}
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
<![endif]-->
<!--[if lt IE 10]>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
<![endif]-->

</body>
</html>
