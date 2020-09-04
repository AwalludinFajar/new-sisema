<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
		<title>Sistem Informasi Logistik</title>

		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo base_url().'uploads/profil_app/gift.png'; ?>" />
		<style type="text/css">
			.select-search { width: 100%; }
		</style>
		<link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>uploads/profil_app/no_image.png" />

		<!-- Global stylesheets -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/core.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/components.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/colors.css" rel="stylesheet" type="text/css">
		<!-- <link href="<?php //echo base_url()?>assets/c3/c3.css" rel="stylesheet" type="text/css"> -->
		<link href="<?php echo base_url()?>assets/css/datepicker.css" rel="stylesheet" type="text/css">
		<!-- <link href="<?php //echo base_url()?>assets/css/plugins/select2/select2.css" rel="stylesheet" type="text/css"> -->
		<!-- <link href="<?php //echo base_url()?>assets/css/plugins/select2/select2-bootstrap.css" rel="stylesheet" type="text/css"> -->
		<!-- /global stylesheets -->
		<link  href="<?php echo base_url()?>assets/js/plugins/clockpick/dist/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/data_table/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/sweetalert.css" rel="stylesheet" type="text/css">
		<link href="<?php echo base_url()?>assets/css/custom.css" rel="stylesheet" type="text/css">

		<!-- Core JS files -->
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/loaders/pace.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/core/libraries/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/validation/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/core/libraries/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/loaders/blockui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/ui/nicescroll.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/ui/drilldown.js"></script>
		<!-- /core JS files -->

		<!-- Theme JS files -->
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/core/app.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/select2/select2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/tables/footable/footable.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/pages/table_responsive.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/tables/datatables/extensions/fixed_columns.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/pages/datatables_extension_fixed_columns.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/forms/styling/uniform.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/pages/form_layouts.js"></script>


		<script src="<?php echo base_url()?>assets/js/date-time/bootstrap-datepicker.js"></script>

		<!-- <script src="<?php //echo base_url()?>assets/c3/c3.js" type="text/javascript"></script> -->
		<script src="<?php echo base_url()?>assets/mchar/Chart.bundle.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/mchar/utils.js" type="text/javascript"></script>

		<script src="<?php echo base_url()?>assets/js/Pagination/pagination.js" type="text/javascript"></script>

		<!-- <script src="http://d3js.org/d3.v4.min.js" charset="utf-8"></script> -->
		<script src="<?php echo base_url()?>assets/js/data_table/dataTables.bootstrap.min.js" type="text/javascript"></script>

		<script src="<?php echo base_url()?>assets/js/color_picker/jscolor.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

		<script src="<?php echo base_url()?>assets/js/plugins/clockpick/dist/bootstrap-clockpicker.min.js" type="text/javascript"></script>

		<script>
			$(function() {
				$('.datepicker').datepicker({
					  format: 'dd/mm/yyyy',
			      autoclose: true,
			      todayHighlight: true,
				}).next().on('click', function(){
					$(this).prev().focus();
				});
			});

			function formatCurrency(num) {
		        num = num.toString().replace(/\Rp|/g,'');
		        if(isNaN(num))
		            num = "0";
		        sign = (num == (num = Math.abs(num)));
		        num = Math.floor(num*100+0.50000000001);
		        cents = num%100;
		        num = Math.floor(num/100).toString();
		        if(cents<10)
		            cents = "0" + cents;
		        for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		            num = num.substring(0,num.length-(4*i+3))+','+
		            num.substring(num.length-(4*i+3));
		        return num;
		    }
		</script>
		<!-- /theme JS files -->
		<style>
			.bg-slate-db{
				/*background-image: url("<?php //echo base_url().'uploads/profil_app/'.$ListLogo[0]["background"];?>");*/
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				height: 100%;
			}
		</style>
	</head>
	<?php $base = sizeofimg(); ?>
	<?php if($this->session->userdata('atos_tiasa_leubeut')){ ?>
	<body class="pace-done">
		<div class="navbar navbar-inverse">
			<div class="navbar-header">
				<ul class="nav navbar-nav pull-right visible-xs-block">
					<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				</ul>
			</div>

			<div class="navbar-collapse collapse" id="navbar-mobile">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown dropdown-user">
						<a href="#" style="padding: 13px 20px;" class='dropdown-toggle' data-toggle="dropdown">
							<!-- <img src="<?php //echo base_url()?>assets/img/default.png" alt=""> -->
							Selamat datang, <strong><?php echo $this->session->userdata('sesi_nama_lengkap'); ?></strong>
							<i class="caret"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="<?php echo site_url();?>editpass/"><i class="icon-user-plus"></i> Ubah Password</a></li>
							<li><a href="<?php echo site_url();?>loginapp/logout/"><i class="icon-switch2"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<div class="navbar navbar-default" id="navbar-second">
			<ul class="nav navbar-nav no-border visible-xs-block">
				<li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
			</ul>
			<div class="navbar-collapse collapse" id="navbar-second-toggle">
			<ul class="nav navbar-nav" style="margin-left:3px;">
				<?php echo menu_nav();?>
			</ul>
			</div>
		</div>
	<?php
		} else {
			$background = bgapp();
			if($background == " ") {
				echo '<body class="login-container bg-slate-800 pace-done">';
			}else{
				echo '<body class="login-container bg-slate-db">';
			}
		} ?>

		<div class="page-container" id="content">
			<div class="page-content">
				<div class="content-wrapper">
					<div id="main" style="margin-left:0px;">
					<?php
						ini_set('memory_limit', '1024M');
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
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/sweatalert/sweetalert.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/velocity/velocity.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/velocity/velocity.ui.min.js"></script>
	</body>
</html>
