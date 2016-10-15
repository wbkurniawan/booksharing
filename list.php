<?php
include_once(__DIR__.'/model/class/UserSession.php');
include_once(__DIR__.'/config/global.php');

$categoryId = isset($_GET["categoryId"])?(integer)$_GET["categoryId"]:-1;
$authorId = isset($_GET["authorId"])?(integer)$_GET["authorId"]:-1;
$userId = isset($_GET["userId"])?(integer)$_GET["userId"]:0;
$page = isset($_GET["page"])?(integer)$_GET["page"]:1;
$lock = false;
include_once (__DIR__.'/lock.php');

if($categoryId==-1 and $authorId==-1 and $userId==0){
	if(!isset($_SESSION["user"])){
		header('Location: /index.php');
		die();
	}else{
		$userSession =  unserialize($_SESSION["user"]);
		$userId = $userSession->userId;
	}
}

//
//if($userId>0 and  !isset($_SESSION["user"])){
//	header('Location: /index.php');
//	die();
//}else{
//	$userSession =  unserialize($_SESSION["user"]);
//	$currentUserId = $userSession->userId;
//	if($userId<>$currentUserId){
//		header('Location: /index.php');
//		die();
//	}
//}

include_once(__DIR__.'/header.php');
?>

	<input type="hidden" id="categoryId" value="<?=$categoryId?>">
	<input type="hidden" id="userId" value="<?=$userId?>">
	<input type="hidden" id="authorId" value="<?=$authorId?>">
	<input type="hidden" id="page" value="<?=$page?>">
	<input type="hidden" id="bookViewLimitList" value="<?= BOOKS_VIEW_LIMIT_LIST ?>">
    <!--=== Shop Product ===-->
    <div class="shop-product" >
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                <li><a href="list.php?categoryId=0">Books</a></li>
                <li class="active"><a href="#" id="breadcrumbCategoryName"></a></li>
            </ul>
        </div>
        <!-- End Breadcrumbs v5 -->


    </div>
    <!--=== End Shop Product ===-->

    <!--=== Content Medium ===-->

    <!--=== End Content Medium ===-->

     <!--=== Illustration v2 ===-->
    <div class="container" id="eventWrapper">
		<div id="borrowedBookContainer"></div>
		<div id="bookListContainer"></div>
        <div class="pageButtonContainer">
            <button  id="prevButton" class="prevButton btn-u btn-u-sea-shop" data-page='<?php echo $page-1;?>'><< PREV</button>
            <button  id="nextButton" class="nextButton btn-u btn-u-sea-shop" data-page='<?php echo $page+1;?>'>NEXT >></button>
        </div>
	</div>

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
<script src="assets/js/app/list.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<!--<script src="assets/plugins/smoothScroll.js"></script>-->
<!--<script src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>-->
<!--<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>-->
<!-- Master Slider -->
<!--<script src="assets/plugins/master-slider/quick-start/masterslider/masterslider.min.js"></script>-->
<!--<script src="assets/plugins/master-slider/quick-start/masterslider/jquery.easing.min.js"></script>-->
<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script src="assets/js/shop.app.js"></script>
<!--<script src="assets/js/plugins/owl-carousel.js"></script>-->
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

<script id="bookListTemplate" type="text/x-jsrender">
	<div class="heading heading-v1 margin-bottom-20">
		<h2>
			{{if categoryId==0}}
				All Books
			{{else filter=="CATEGORY"}}
				{{if ~root.data[0]}}
					{{:data[0].categories[0].name}}
				{{/if}}
			{{else filter=="AUTHOR"}}
				{{if ~root.data[0]}}
					{{:data[0].authors}}
				{{/if}}
			{{else}}
				My Books
			{{/if}}
		</h2>
	</div>
	{{if filter != "CATEGORY" && filter != "AUTHOR"}}
		<div class="margin-bottom-40">
				<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" id="addButton" data-book-id='{{:book_id}}'>ADD NEW BOOK</button>
        </div>
	{{else filter == "CATEGORY" }}
		<form id="search-form" class="form-inline">
			<div class="form-group">
				<label class="sr-only" for="search-input">Search</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
					<input type="text" class="form-control" id="search-input" name="search" placeholder="Title, Author or ISBN" value="{{:search}}">
				</div>
			</div>
			<button type="submit" class="btn-u btn-u-sea-shop book-search-button">Search</button>
		</form>
	{{/if}}

	{{for data}}
		<div class="item-list">
			<div class="product-img">
				<a href="book.php?id={{:book_id}}"><img class="full-width img-responsive" src="https://booksharing.immanuel-berlin.de/assets/img/book/{{:image}}" alt=""></a>
				<div class="{{if status=="AVAILABLE"}}shop-rgba-dark-green{{else}}shop-rgba-red{{/if}}  rgba-banner">{{:status}}</div>
			</div>
			<div class="product-description product-description-brd product-title">
				<div class="overflow-h margin-bottom-5">
					<div class="pull-left">
						{{if ~root.filter!="CATEGORY" && ~root.filter!="AUTHOR"}}
							{{if loan_status=="REQUESTED"}}
								<div>
									<div>
										Borrow request from {{:loan[0].first_name}} {{:loan[0].last_name}} for {{:loan_period}} days
									</div>
									<div class="action-button-div">
										<button  class="acceptButton btn-u btn-u-sea-shop" data-book-id='{{:book_id}}'>ACCEPT</button>
										<button  class="rejectButton btn-u btn-u-sea-shop" data-book-id='{{:book_id}}'>REJECT</button>
									</div>
								</div>
							{{else loan_status=="BORROWED"}}
								<div>
									<div>
										Borrowed  by {{:loan[0].first_name}} {{:loan[0].last_name}}
										since {{:~dateFormat(loan[0].start_date)}}
									</div>
									<div class="action-button-div">
										<button class="returnButton btn-u btn-u-sea-shop" data-book-id='{{:book_id}}'>RETURN</button>
									</div>
								</div>
							{{/if}}
						{{else}}
							<h4 class="title-price"><a href="book.php?id={{:book_id}}">{{:title}}</a></h4>
							<span class="gender text-uppercase">{{for categories}}{{>name}}{{/for}}</span>
							<span class="gender">{{:authors}}</span>
						{{/if}}
					</div>
				</div>
				{{if ~root.filter!="CATEGORY" &&  ~root.filter!="AUTHOR"}}
					<ul class="list-inline product-ratings edit-book-button">
						<li class="like-icon"><a href="notification.php?bookId={{:book_id}}"><i class="fa fa-history" aria-hidden="true" title="Loan history"></i></a></li>
						<li class="like-icon"><a href="edit.php?id={{:book_id}}"><i class="fa fa-pencil" title="Edit" aria-hidden="true"></i></a></li>
					</ul>
				{{/if}}
			</div>
		</div>
	{{/for}}
	{{if filter != "CATEGORY" && filter != "AUTHOR" && data.length >= 4}}
		<div class="margin-bottom-40">
				<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" id="addButton" data-book-id='{{:book_id}}'>ADD NEW BOOK</button>
        </div>
	{{/if}}
</script>
<script id="borrowedBooksTemplate" type="text/x-jsrender">
	{{for data}}
		<div class="heading heading-v1 margin-bottom-20">
			<h2>
				I am borrowing
			</h2>
		</div>
		<div class="col-md-3 col-sm-6 md-margin-bottom-30">
			<div class="product-img">
				<a href="book.php?id={{:book_id}}"><img class="full-width img-responsive" src="https://booksharing.immanuel-berlin.de/assets/img/book/{{:image}}" alt=""></a>
				<div class="{{if status=="AVAILABLE"}}shop-rgba-dark-green{{else}}shop-rgba-red{{/if}}  rgba-banner">{{:status}} BY ME</div>
			</div>
			<div class="product-description product-description-brd">
				<div class="overflow-h margin-bottom-5">
					<div class="pull-left">
						<div>
							{{if status=="BORROWED"}}
								Borrowed  by me since {{:~dateFormat(loan[0].start_date)}}
							{{else status=="RESERVED"}}
								Requested by me at {{:~dateFormat(loan[0].timestamp)}}
								for {{:loan_period}} days
								<div class="action-button-div">
									<button  class="cancelRequestButton btn-u btn-u-sea-shop" data-book-id='{{:book_id}}'>CANCEL</button>
								</div>
							{{/if}}
						</div>
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
