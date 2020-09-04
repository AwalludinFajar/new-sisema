<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>ULA Kemendagri</title>

   <link rel="stylesheet" href="<?php echo base_url()?>assets_users/tree/style.min.css">
   <link rel="stylesheet" href="<?php echo base_url()?>assets_users/tree/style.css">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url()?>assets_users/img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>assets_users/img/apple-touch-icon-precomposed.png" />
</head>

  <script src="<?php echo base_url()?>assets_users/js/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets_users/js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
  <script src="<?php echo base_url()?>assets_users/js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
  <script src="<?php echo base_url()?>assets_users/js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
  <script src="<?php echo base_url()?>assets_users/js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
  <script src="<?php echo base_url()?>assets_users/js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
  <script src="<?php echo base_url()?>assets_users/js/jstree.js"></script>


<body>	
<div  class="container-fluid nav-hidden" id="content" >
		
				
				<div id="main" style="margin-left:0px;">
				
				<?php
					ini_set('memory_limit', '512M');	
					echo $contents;
				?>
				
				</div>
			
		</div>
		
		
		
		
</body>

</html>