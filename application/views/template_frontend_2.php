<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<title>
		<?php 
			$judul = judulapp();
			if($judul == " ")
			{
				echo "Judul Aplikasi";
			}else{
				echo $judul;
			}
		?>
		</title>

		<!-- Favicon -->
		<link rel="shortcut icon" href="
		<?php 
			$logo = logoapp();
			if($logo == " ") 
			{
				echo base_url().'uploads/profil_app/no_image.png';
			}
			else{
				echo $logo;
			}
		?>"
		/>
		<link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>uploads/profil_app/no_image.png" />
		
		<!-- Global stylesheets -->
		
		<link href="<?php echo base_url()?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/core.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/components.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/colors.css" rel="stylesheet" type="text/css">



		<script src="<?php echo base_url()?>assets/js/date-time/bootstrap-datepicker.js"></script>

		<script>
			$(function() {
				$('.datepicker').datepicker({
					  format: 'yyyy-mm-dd',
			      autoclose: true,
			      todayHighlight: true,
				}).next().on('click', function(){
					$(this).prev().focus();
				});

			});
		</script>
		<!-- /theme JS files -->
		<style>
			.bg-slate-db{
				background-image: url("<?php echo base_url().'uploads/profil_app/'.$ListLogo[0]["background"];?>");
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				height: 100%; 
			}
			</style>
	</head>


	<?php if($this->session->userdata('atos_tiasa_leubeut')){ ?>
	<body class="pace-done">
		<div class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="<?php echo base_url().'welcome'?>">
				<?php
					$judul = judulapp();
					if($judul == " ")
					{
						echo "Judul Aplikasi";
					}else{
						echo $judul;
					}
				?>
				</a>
				<ul class="nav navbar-nav pull-right visible-xs-block">
					<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				</ul>
			</div>
			
		</div>
		<div class="navbar navbar-default" id="navbar-second">
			<ul class="nav navbar-nav no-border visible-xs-block">
				<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
			</ul>
			<div class="navbar-collapse collapse" id="navbar-second-toggle">
		
			</div>
		</div>
		<?php }else {
			$background = bgapp();
			if($background == " ")
			{
				echo '<body class="login-container bg-slate-800 pace-done">';
			}else{
				echo '<body class="login-container bg-slate-db">';
			}
		?>
		
		<?php } ?>



		<div class="page-container" id="content">
			<div class="page-content">
				<div class="content-wrapper">
					<div id="main" style="margin-left:0px;">
					<?php
						ini_set('memory_limit', '512M');
						echo $contents;
					?>
					</div>
				</div>
			</div>
		</div>
			<!-- Footer -->
			<div class="footer text-muted">
			
			</div>
		<!-- /footer -->
	</body>
</html>
