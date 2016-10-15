<?php
include_once(__DIR__.'/model/class/UserSession.php');

$lock = true;
include_once (__DIR__.'/lock.php');

if(!isset($_SESSION["user"])){
	header('Location: /index.php');
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
				<h2> Change Password
				</h2>
			</div>
			<div class="row" id="userContainer">
				<div class="edit-user-div">
					<form id="changePasswordForm" class="form-horizontal">
						<div class="form-group">
							<label for="password">Change Password*: </label>
							<input type="password" id="passwordInput" name="password" class="form-control" placeholder="Enter current password">
						</div>
						<div class="form-group">
							<label for="password">New Password*: </label>
							<input type="password" id="newPasswordInput" name="new-password" class="form-control" placeholder="Enter new password">
						</div>
						<div class="form-group">
							<label for="retype-password">Confirm new password*: </label>
							<input type="password"  id="retypeNewPasswordInput" name="retype-password" class="form-control" placeholder="Confirm new password">
						</div>
					</form>
					<div class="margin-bottom-40">
						<button type="button" class="btn-u btn-u-sea-shop btn-u-lg" id="saveButton">SAVE</button>
					</div>
				</div>
			</div><!--/end row-->
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
<script src="assets/js/app/changePassword.js"></script>

<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>
