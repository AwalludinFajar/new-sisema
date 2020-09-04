<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>404 Error Page!</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/bootstrap-responsive.min.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo base_url()?>assets_users/css/themes.css">


	<!-- jQuery -->
	<script src="<?php echo base_url()?>assets_users/js/jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="<?php echo base_url()?>assets_users/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url()?>assets_users/js/bootstrap.min.js"></script>

	<!--[if lte IE 9]>
		<script src="<?php echo base_url()?>assets_users/js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url()?>assets_users/img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>assets_users/img/apple-touch-icon-precomposed.png" />


</head>



<body class="error">
	<div class="wrapper">
		<div class="code">
		<img src="<?= base_url("assets_users/img/logo.png") ?>" class="img img-responsive">
		</div>
		<div class="desc"><strong>OOPS! ANDA TIDAK MEMILIKI HAK AKSES KE LAMAN INI</strong></div>
		<div class="buttons">
		<a href="<?= base_url() ?>" class="btn"><i class="icon-arrow-left"></i> Silahkan kembali ke beranda</a>
		</div>
	</div>
		
	</body>

	</html>