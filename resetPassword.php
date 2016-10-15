<?php
include_once(__DIR__.'/library/db/Connect.class.php');
include_once(__DIR__.'/model/class/User.php');

$code = isset($_GET["code"])?trim($_GET["code"]):"";
if($code==""){
    header('Location: /index.php');
    die();
}

$user = new User();
try{
    $email = $user->getEmailByResetPasswordCode($code);
    $newPassword = $user->resetPassword($email);
    $message = "<p>Your password has been reset.</p><p> Your temporary password is ".$newPassword."</p>";
    $message .= "Please <a href='login.php'>log in</a> now and change your password.";
}catch(Exception $e) {
    $message = $e->getMessage();
}

$lock = false;
include_once(__DIR__.'/header.php');
?>
    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <h1>Reset Password</h1>
        </div><!--/end container-->
    </div>
    <!--=== End Breadcrumbs v4 ===-->

    <div class="content-md margin-bottom-30" id="eventWrapper">
        <div class="container" id="bookContainer">
            <h3><?=$message?></h3>
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

<!-- JS Implementing Plugins -->
<!--<script src="assets/plugins/back-to-top.js"></script>-->
<!--<script src="assets/plugins/smoothScroll.js"></script>-->
<!--<script src="assets/plugins/jquery-steps/build/jquery.steps.js"></script>-->
<!--<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>-->

<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->

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
