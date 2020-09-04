<div class="page-header">
	<div class="page-header-content" style="padding:0;">
		<div class="page-title" style="padding-top:0; padding-bottom:15px;">
			<h4>
				<i class="icon-arrow-left52 position-left"></i>
				<span class="text-semibold"><?php echo $sub_judul_form;?></span>
			</h4>
			<ul class="breadcrumb breadcrumb-caret position-right">
				<?php foreach ($breadcrumbs as $key => $value) { ?>
				<li>
					<a href=<?php echo site_url($value['link'])?> > <?php echo $value['name']; ?></a>
					<?php echo (count($breadcrumbs)-1)==$key?"":""; ?>
				</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>

<div class="panel panel-flat">
	<div class = "panel-heading" style="padding-bottom:0;">
		<h5 class="panel-title"><?php echo $sub_judul_form;?>
			<a class="heading-elements-toggle"><i class="icon-more"></i></a>
		</h5>
	</div>
	<hr style="margin-top:10px;margin-bottom:5px;">
	
</div>