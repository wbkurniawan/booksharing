<?php
$bookId = isset($_GET["id"])?$_GET["id"]:0;
include_once(__DIR__.'/model/class/Books.php');
include_once(__DIR__.'/model/class/Authors.php');
include_once(__DIR__.'/model/class/UserSession.php');
$lock = true;
include_once(__DIR__.'/lock.php');
if(!isset($_SESSION["user"])){
    header("Location: login.php");
    die();
}

$userSession =  unserialize($_SESSION["user"]);
$userId = $userSession->userId;
$isAdmin = (integer)$userSession->admin;

$book = new Books($bookId);
$owner = $book->getOwner();
if($bookId!=0){
    if($userId!=$owner and !$isAdmin){
        header("Location: index.php");
        die();
    }
}

$json = file_get_contents("http://$_SERVER[HTTP_HOST]/api/categories");
$categories= json_decode($json);

$author = new Authors();
$authors = $author->getAuthors();

//echo "<pre>";
//print_r($authors);
//echo "</pre>";

include_once(__DIR__.'/header.php');
?>
    <link rel="stylesheet" href="assets/css/bootstrap-multiselect.css" type="text/css"/>
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

<?php include_once(__DIR__.'/footer.php'); ?>

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
<script type="text/javascript" src="assets/js/bootstrap-multiselect.js"></script>

<!-- JS Implementing Plugins -->
<!--<script src="assets/plugins/back-to-top.js"></script>-->
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

<script id="bookTemplate" type="text/x-jsrender">
	{{for data}}
            <div class="col-md-4">
                <img src="assets/img/book/{{:image}}" class="main-cover full-width img-responsive" width="100%" alt="Cover">
                <form id="upload-cover-form" data-book-id="{{:book_id}}" action="model/uploadCover.php" method="post" enctype="multipart/form-data" class="form-inline">
                    <input type="hidden" name="bookId" value="{{:book_id}}">
                    <div class="input-group" id="edit-input-group-div">
                        <label class="input-group-btn" id="edit-input-group-label" data-book-id="{{:book_id}}">
                            <span class="btn btn-primary" id="edit-input-group-button">
                                Browse&hellip; <input type="file" name="upfile" style="display: none;">
                            </span>
                        </label>
                        <input type="text" id="pictureCover" class="form-control" readonly>
                    </div>
                </form>
            </div>
            <form id="editForm" xclass="form-inline">
                <input type="hidden" name="bookId" value="{{:book_id}}">
                <div class="col-md-8">
                    <div class="shop-product-heading">
                        <label for="titleInput">Title: </label><input id="titleInput" name="title" type="text" class="form-control" value="{{:title}}">
                    </div><!--/end shop product social-->
                    <ul class="list-inline product-ratings">
                        <li><small class="{{if status=="AVAILABLE"}}shop-rgba-dark-green{{else}}shop-rgba-red{{/if}} time-day-left">{{:status}}</small></li>
                    </ul>
                    <div  class="input-group book-edit-full-width">
                         <p class="wishlist-category">
                         <strong>Authors:</strong>
                                {{for authors}}<a href="#"><span class="author-span" data-author-id="{{>author_id}}"><span></a> {{/for}}

                                <span id="editAuthorSpan">
                                    <select id="authorSelect" name="authorIds[]" multiple="multiple">
                                        <option value="0">Others</option>
                                        <?php foreach ($authors as $author): ?>
                                            <option value="<?=$author["author_id"]?>">
                                                    <?=$author["name"]?>
                                            </option>
                                         <?php endforeach; ?>
                                    </select>
                                </span>

                                <a style="<?php echo ($isAdmin?"":"display:none;"); ?>" href="author.php" id="add-new-author" target="_blank" title="add new author" class="btn btn-success">+</a>
                        </p>
                    </div>
                    <div class="input-group  book-edit-full-width">
                        <label for="isbnInput">ISBN: </label> <input type="text" class="form-control" id="isbnInput" name="isbn" value="{{:isbn}}">
                    </div>
                    <div class="input-group  book-edit-full-width">
                        <label for="languageSelect">Language: </label>
                        <select id="languageSelect" class="form-control" name="language">
                            <option value="DE" {{if language=="DE"}} selected {{/if}}>Deutsch</option>
                            <option value="EN" {{if language=="EN"}} selected {{/if}}>English</option>
                            <option value="ID" {{if language=="ID"}} selected {{/if}}>Bahasa Indonesia</option>
                        </select>
                    </div>
                    <div class="input-group  book-edit-full-width">
                        <label for="categorySelect">Category</label>
                        <select id="categorySelect" class="form-control" name="categoryId">
                            <?php foreach ($categories->data as $category): ?>
                                <option value="<?=$category->category_id?>" {{if category_id=="<?=$category->category_id?>"}} selected {{/if}} >
                                        <?=$category->name?>
                                </option>
                             <?php endforeach; ?>
                        </select>
                    </div>
                    <textarea id="descriptionInput" name="description" class="form-control" rows="6" placeholder="Book's description">{{:description}}</textarea>

                    <ul class="list-inline add-to-wishlist add-to-wishlist-brd">
                        <li class="wishlist-in">
                            <i class="fa fa-user"></i>
                            Owner: <strong>{{for user}}{{>first_name}} {{>last_name}}{{/for}}</strong>
                        </li>
                    </ul>
                    <ul class="list-inline add-to-wishlist add-to-wishlist-brd">
                        <li class="compare-in">
                            <i class="fa fa-calendar"></i>
                            Loan period days: <strong><input type="number" name="loanPeriod" id="loanPeriodInput" min="1" max="30" value="{{:loan_period}}"  class="form-control" ></strong>
                        </li>
                    </ul>
                    <div class="margin-bottom-40">
                        <button type="button" class="btn-u btn-u-sea-shop btn-u-lg" id="saveButton" data-book-id='{{:book_id}}'>SAVE</button>
                        <button type="button" class="btn-u btn-u-red btn-u-lg" id="deleteButton" data-book-id='{{:book_id}}'>DELETE</button>
                        {{if status=="AVAILABLE"}}
                            <button type="button" class="btn-u btn-u-orange btn-u-lg" id="privateUseButton" data-book-id='{{:book_id}}' data-status='PRIVATE'>PRIVATE USE</button>
                        {{else status=="PRIVATE"}}
                            <button type="button" class="btn-u btn-u-orange btn-u-lg" id="privateUseButton" data-book-id='{{:book_id}}' data-status='AVAILABLE'>MAKE AVAILABLE</button>
                        {{else}}
                            <button type="button" class="btn-u btn-u-orange btn-u-lg btn-disabled"  disabled id="privateUseButton" data-book-id='{{:book_id}}'>PRIVATE USE</button>
                        {{/if}}
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
