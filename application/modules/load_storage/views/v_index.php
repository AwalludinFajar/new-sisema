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
		<h5 class="panel-title">Process<a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
	</div>
  <hr style="margin-top:10px;margin-bottom:5px;">
  <form action="<?php echo site_url('load_reciveing/index'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-heading">
			<div class="form-group">
				<label class="col-lg-1 control-label">Pencarian</label>
				<div class="col-lg-6">
					<input type="text" value="<?php echo $this->session->userdata('s_cari_global'); ?>" class="form-control" name="cari_global" placeholder="Masukan kata kunci... (No.Rv)"  >
				</div>
			</div>
			<div>
			<table class="table table-bordered table-striped table-togglable table-hover">
				<thead>
					<tr class="bg-teal-400">
						<th width="10%">No. RV</th>
            <th>User Storage</th>
						<th>Tanggal</th>
						<th width="5%">Status</th>
            <th>Keterangan</th>
						<th data-hide="phone" class="text-center" width="5%" colspan="2">Aksi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</form>
</div>
