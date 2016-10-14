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

<?php include_once(__DIR__.'/footer.php'); ?>

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
        <h1>Halo! Permohonan anda untuk meminjam buku ini sudah kami terima.</h1>
                <br><br>

        <h4>Selanjutnya:</h4> <br>
        <div style="margin-bottom:50px" class="row">
            <div class="col-md-6">
                <ol class="success-ol">
                    <li><span>1.</span><p>Kami akan memberi tahu pada pemilik buku bahwa anda ingin meminjam buku ini.</p></li>
                    <li><span>2.</span><p>Anda akan mendapat konfirmasi lewat email apakah permohonan ini diterima atau ditolak oleh pemilik buku.</p></li>
                    <li><span>3.</span><p>Bila diterima, anda akan menerima kontak pemilik buku agar dapat membuat janji untuk mendapatkan buku tersebut.</p></li>
                </ol>
                <div class="text-left" style="margin-bottom:5px; padding-left:40px">
                    <button id="continueBrowsingButton"type="button" style="width: 180px" class="btn-u btn-u-sea-shop">Continue browsing</button>
                </div>
            </div>
            <div class="col-md-1"> </div>
            <div class="col-md-2">
                <img src="http://booksharing.immanuel-berlin.de/assets/img/book/{{:image}}" width="100%" alt="Cover">
            </div>
            <div class="col-md-3">
                <div class="shop-product-heading">
                    <h4>{{:title}}</h4>
                    <p class="wishlist-category"><strong>Authors:</strong>
                    {{for authors}}<a href="#">{{>name}}</a> {{/for}}
                    </p>
                </div><!--/end shop product social-->

                <p>Owner: <strong>{{for user}}{{>first_name}} {{>last_name}}{{/for}}</strong></p>
                <p style="margin-bottom:30px">Reading Time: {{:loan_period}} days</p>

                <div class="text-left" style="margin-bottom:5px">
                    <button data-book-id={{:book_id}} id="cancelRequestButton" type="button" style="width: 180px" class="btn-u btn-brd btn-brd-hover btn-u-sea-shop">Cancel request</button>
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
