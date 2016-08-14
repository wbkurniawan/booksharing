<?php
/**
 * Created by PhpStorm.
 * User: William
 * Date: 8/7/2016
 * Time: 4:03 PM
 */
require_once(__DIR__.'/lock.php');
include_once(__DIR__.'/model/class/UserSession.php');

$loginIconStyle = "";
$userGreeting = "";
$loginToken = "";
if(isset($_SESSION["user"])){
    $loginIconStyle = "style='color:#18ba9b !important'";
    $userSession = unserialize($_SESSION["user"]);
    $userGreeting = "Hi, " .$userSession->firstName . " ";
    $loginToken = uniqid();
}

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Book Sharing | FeG Immanuel Berlin</title>

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
    <link rel="stylesheet" href="assets/plugins/revolution-slider/rs-plugin/css/settings.css">

    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/master-slider/quick-start/masterslider/style/masterslider.css">
    <link rel='stylesheet' href="assets/plugins/master-slider/quick-start/masterslider/skins/default/style.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="assets/css/theme-colors/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body class="header-fixed" data-token="<?=$loginToken?>">

<script id="categoriesTemplate" type="text/x-jsrender">
	{{for data}}
		<li><a href="/booksharing/list.php?categoryId={{:category_id}}" data-category-id="{{:category_id}}">{{:name}}</a></li>
	{{/for}}
</script>
<script id="userInfoTemplate" type="text/x-jsrender">
    <table class="table table-hover table-condensed notification-popup-table">
        <tr><th colspan="2">New Notifications</th></tr>
	    {{for data}}
		    <tr>
                <td class="notification-icon-td">
                    <a href="notification.php?id={{:notification_id}}">
                    {{if type=='BORROW_REQUEST'}}
                        <i class="fa fa-book popup-small-icon" aria-hidden="true"></i>
                        <i class="fa fa-question popup-small-icon" aria-hidden="true"></i>
                    {{else type=='BORROW_REJECT'}}
                        <i class="fa fa-book popup-small-icon" aria-hidden="true"></i>
                        <i class="fa fa-times popup-small-icon" aria-hidden="true"></i>
                    {{else type=='BORROW_ACCEPT'}}
                        <i class="fa fa-book popup-small-icon" aria-hidden="true"></i>
                        <i class="fa fa-check popup-small-icon" aria-hidden="true"></i>
                    {{else type=='BORROW_STATUS'}}
                        <i class="fa fa-book popup-small-icon" aria-hidden="true"></i>
                        <i class="fa fa-exclamation popup-small-icon" aria-hidden="true"></i>
                    {{else type=='SYSTEM'}}
                        <i class="fa fa-cog popup-small-icon" aria-hidden="true"></i>
                    {{else type=='USER_TO_USER'}}
                        <i class="fa fa-user popup-small-icon" aria-hidden="true"></i>
                    {{/if}}
                    </a>
                </td>
                <td class="notification-sender-td"><a href="notification.php?id={{:notification_id}}">{{:sender.first_name}} {{:sender.last_name}}</a></td>
            </tr>
	    {{/for}}
    </table>
	<div class="popup-menu-header">
	    <div><a href="/booksharing/index.php">My Books</a><div>
	    <div><a href="/booksharing/notification.php">Notifications</a><div>
	    <div><a href="/booksharing/model/logout.php">Log out</a><div>
	</div>
</script>


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
                    <a class="navbar-brand" href="index.php">
                        <img id="logo-header" src="assets/img/full_logo.png" alt="Logo">
                    </a>
                </div>

                <!-- Shopping Cart -->
                <div class="shop-badge badge-icons pull-right">
                    <a href="#"><?=$userGreeting?><i class="fa fa-user" id="userIcon" <?=$loginIconStyle?> ></i></a>
                    <i class="fa fa-envelope-o" aria-hidden="true"></i><span id="newNotification" class="badge badge-notification">0</span>
                    <br>
                    <div class="badge-open" id="userInfoContainer">
                        <img class="loader-popup-img" src="assets/plugins/revolution-slider/rs-plugin/assets/loader.gif">
                        <ul id="login-popup-ul" class="list-unstyled mCustomScrollbar" data-mcs-theme="minimal-dark">
                            <li>
                                <a href="login.php" class="btn-u btn-u-sea-shop btn-block">Login</a>
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
