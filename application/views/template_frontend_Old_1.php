<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	<title>Unit Layanan Administrasi Kementrian Dalam Negeri</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo base_url()?><?php echo base_url()?>assets/img/logobandung.png" />
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?><?php echo base_url()?>assets/img/logobandung.png" />
	
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/ui/drilldown.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/js/pages/login.js"></script>
	<!-- /theme JS files -->
	
</head>



<body class="login-container bg-slate-800  pace-done">
<div>
	<a href="<?php echo site_url('welcome') ?>">
		<img src="<?php echo base_url()?>assets_users/img/header_frontend.png" />
	</a>
</div>





	<?php if($this->session->userdata('atos_tiasa_leubeut')){ ?>

	<div id="navigation">
		<div class="container-fluid">




		<ul class='main-nav'>




				<?php
				echo menu_nav();
				?>



			</ul>


			<div class="user">

				<ul class="icon-nav"> 
				
				
				
				
				<?php  

						
						if($this->session->userdata('sesi_user_group') == 7){
							
							$query_v1 = $this->db->query("SELECT COUNT(*) AS JML FROM trx_permohonan WHERE id_flow='4'");
							$row_v1 = $query_v1->row();
							if (isset($row_v1)) { $jml_v1=$row_v1->JML; }
							$s_url_v1 = site_url('approval_ula');
							
						
						
						

				?>
				
				<li class='dropdown'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-envelope"></i><span class="label label-lightred"><?php echo $jml_v1; ?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							
							
							<li>
								<a href="<?php #echo $s_url_v2;?>">
									<img src="img/demo/user-2.jpg" alt="">
									<div class="details">
										<div class="name">Inbox Permohonan Layanan Administrasi </div>
										<div class="message">
											Silahkan klik disini....
										</div>
									</div>
									<div class="count">
										<i class="icon-comment"></i>
										<span><?php echo $jml_v1; ?></span>
									</div>
								</a>
							</li>
							
							
						</ul>
					</li>
					
					
				<?php } ?>
				
				
				
				
				
				
				
				<?php  

						
						if($this->session->userdata('sesi_user_group') == 4){
							
							$query_v1 = $this->db->query("SELECT COUNT(*) AS JML FROM trx_permohonan WHERE id_flow='1'");
							$row_v1 = $query_v1->row();
							if (isset($row_v1)) { $jml_v1=$row_v1->JML; }
							$s_url_v1 = site_url('inbox_permohonan');
							
						
						
						

				?>
				
				<li class='dropdown'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-envelope"></i><span class="label label-lightred"><?php echo $jml_v1; ?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							
							
							<li>
								<a href="<?php #echo $s_url_v2;?>">
									<img src="img/demo/user-2.jpg" alt="">
									<div class="details">
										<div class="name">Inbox Permohonan Layanan Administrasi </div>
										<div class="message">
											Silahkan klik disini....
										</div>
									</div>
									<div class="count">
										<i class="icon-comment"></i>
										<span><?php echo $jml_v1; ?></span>
									</div>
								</a>
							</li>
							
							
						</ul>
					</li>
					
					
				<?php } ?>
				
				
				
				
				
				<?php  

						
						if($this->session->userdata('sesi_user_group') == 5){
							
							$id_dinas = $this->session->userdata('sesi_id_dinas');
							
							$query_v1 = $this->db->query("SELECT COUNT(*) AS JML FROM trx_permohonan WHERE id_flow='5' AND id_dinas='$id_dinas'");
							$row_v1 = $query_v1->row();
							if (isset($row_v1)) { $jml_v1=$row_v1->JML; }
							$s_url_v1 = site_url('teknis_data_la');
							
						
						
						

				?>
				
				<li class='dropdown'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-envelope"></i><span class="label label-lightred"><?php echo $jml_v1; ?></span></a>
						<ul class="dropdown-menu pull-right message-ul">
							
							
							<li>
								<a href="<?php #echo $s_url_v2;?>">
									<img src="img/demo/user-2.jpg" alt="">
									<div class="details">
										<div class="name">Inbox Permohonan Layanan Administrasi </div>
										<div class="message">
											Silahkan klik disini....
										</div>
									</div>
									<div class="count">
										<i class="icon-comment"></i>
										<span><?php echo $jml_v1; ?></span>
									</div>
								</a>
							</li>
							
							
						</ul>
					</li>
					
					
				<?php } ?>
					
					
				
				</ul>




				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">Selamat datang, <strong><?php echo $this->session->userdata('sesi_nama_lengkap'); ?></strong> <img src="<?php echo base_url()?><?php echo base_url()?>assets_users/img/default.png" alt=""></a>
					<ul class="dropdown-menu pull-right">

						<li>
							<a href="<?php echo site_url();?>editpass/">Ubah Password</a>
						</li>
						<li>
							<a href="<?php echo site_url();?>loginapp/logout/">Logout</a>
						</li>
					</ul>

				</div>




			</div>
		</div>
	</div>

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
</body>
<script type="text/javascript">
	$('.datepick').datepicker({
		format: 'yyyy-mm-dd'
	});

</script>
</html>
