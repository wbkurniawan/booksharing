<?php
$bookId = isset($_GET["id"])?$_GET["id"]:0;
$lock = false;
include_once(__DIR__.'/header.php');
$json = file_get_contents("http://$_SERVER[HTTP_HOST]/booksharing/api/categories");
$categories= json_decode($json);
//echo "<pre>";
//print_r($categories);
//echo "</pre>";

?>

	<input type="hidden" id="bookId" value="<?=$bookId?>">
    <!--=== Shop Product ===-->
    <div class="shop-product" id="eventWrapper">
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Books</a></li>
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
<script src="assets/js/app/edit.js"></script>

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

<script id="bookTemplate" type="text/x-jsrender">
	{{for data}}
            <div class="col-md-4">
                <img src="assets/img/book/{{:image}}" width="100%" alt="Cover">
                <form id="upload-cover-form" data-book-id="{{:book_id}}" action="model/uploadCover.php" method="post" enctype="multipart/form-data" class="form-inline">
                    <input type="hidden" name="bookId" value="{{:book_id}}">
                    <div class="input-group" id="edit-input-group-div">
                        <label class="input-group-btn" id="edit-input-group-label">
                            <span class="btn btn-primary" id="edit-input-group-button">
                                Browse&hellip; <input type="file" name="upfile" style="display: none;">
                            </span>
                        </label>
                        <input type="text" id="pictureCover" class="form-control" readonly>
                    </div>
                </form>
            </div>
            <form id="editForm" class="form-inline">
                <input type="hidden" name="bookId" value="{{:book_id}}">
                <div class="col-md-8">
                    <div class="shop-product-heading">
                        <label for="titleInput">Title: </label><input id="titleInput" name="title" type="text" class="form-control" value="{{:title}}">
                        <p class="wishlist-category"><strong>Authors:</strong>
                        {{for authors}}<a href="#">{{>name}}</a> {{/for}}
                        </p>
                    </div><!--/end shop product social-->

                    <ul class="list-inline product-ratings margin-bottom-30">
                        <li><small class="shop-bg-green time-day-left">{{:status}}</small></li>
                    </ul><!--/end shop product ratings-->
                    <label for="isbnInput">ISBN: </label> <input type="text" class="form-control" id="isbnInput" name="isbn" value="{{:isbn}}">
                    <label for="languageSelect">Language: </label>
                    <select id="languageSelect" class="form-control" name="language">
                        <option value="DE" {{if language=="DE"}} selected {{/if}}>Deutsch</option>
                        <option value="EN" {{if language=="EN"}} selected {{/if}}>English</option>
                        <option value="ID" {{if language=="ID"}} selected {{/if}}>Bahasa Indonesia</option>
                    </select>
                    <label for="categorySelect">Category</label>
                    <select id="categorySelect" class="form-control" name="categoryId">
                        <?php foreach ($categories->data as $category): ?>
                            <option value="<?=$category->category_id?>" {{if category_id=="<?=$category->category_id?>"}} selected {{/if}} >
                                    <?=$category->name?>
                            </option>
                         <?php endforeach; ?>
                    </select>

                    <textarea id="descriptionInput" name="description" class="form-control" rows="6" placeholder="Book's description">{{:description}}</textarea>

                    <ul class="list-inline add-to-wishlist add-to-wishlist-brd">
                        <li class="wishlist-in">
                            <i class="fa fa-user"></i>
                            Owner: <strong>{{for user}}{{>first_name}} {{>last_name}}{{/for}}</strong>
                        </li>
                        <li class="compare-in">
                            <i class="fa fa-calendar"></i>
                            Loan period: <strong><input type="number" name="loanPeriod" id="loanPeriodInput" min="1" max="30" value="{{:loan_period}}"  class="form-control" > days</strong>
                        </li>
                    </ul>
                    <div class="margin-bottom-40">
                        <button type="button" class="btn-u btn-u-sea-shop btn-u-lg" id="saveButton" data-book-id='{{:book_id}}'>SAVE</button>
                    </div>
                </div>
            </form>
    {{/for}}

</script>

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>
