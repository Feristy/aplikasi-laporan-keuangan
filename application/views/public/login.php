<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Login - Aplikasi Laporan Keuangan</title>
    	<link rel="stylesheet" href="assets/css/bootstrap/css/bootstrap.min.css">
    	<link rel="stylesheet" href="assets/css/fontawesome/css/all.css">
		<link rel="stylesheet" href="assets/css/login.css">
	</head>
	<body>
		<form method="post" class="wrapper-login">
			<?php if(!empty($error)){ ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?=$error?>
			</div>
			<?php } ?>
			<div class="login">
				<h2>ALK Login</h2>
				<div class="form-group">
					<input class="form-control" type="text" name="username" placeholder="Username">
				</div>
				<div class="form-group">
					<input class="form-control" type="password" name="password" placeholder="password">
				</div>
				<input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>">
				<button class="btn btn-success btn-block" type="submit" name="submit" value="1">Sign in</button>
			</div>
		</form>
		<script type="text/javascript" src="assets/js/jquery.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
	</body>
</html>