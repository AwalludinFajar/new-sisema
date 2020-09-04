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
		<div class="heading-elements">
			<ul class="icons-list" style="margin:5px;">
				<li>
					<?php if (count($addmore)>0) { ?>
          	<a style="color:#fff;"class="btn btn-success btn-labeled btn-xs" href="<?php echo site_url("load_reciveing/add");?>"><b><i class="icon-plus3"></i></b>Tambah</a>
					<?php } ?>
        </li>
			</ul>
		</div>
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
						<th width="2%">No</th>
						<th width="10%">No. RV</th>
            <th>User Reciveing</th>
						<th>Tanggal</th>
						<th width="5%">Status</th>
            <th>Keterangan</th>
						<th data-hide="phone" class="text-center" width="5%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($found != FALSE) {
						$i=1; foreach ($found as $key) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $key['no_rv']; ?></td>
							<td><?php echo $key['name_user_reciveing']; ?></td>
							<td><?php echo $key['date_reciveing']; ?></td>
							<td>
								<?php if($key['flag'] == 1){ ?>
										<a class="btn btn-info btn-xs">
											<b><i class="icon-check"></i></b>
										</a>
								<?php }else{ ?>
										<a class="btn btn-danger btn-xs">
											<b><i class="icon-cross"></i></b>
										</a>
								<?php } ?>
							</td>
							<td><?php echo $key['keterangan']; ?></td>
							<!-- <td>
								<a class="btn btn-info btn-labeled btn-xs" href="<?php //echo site_url();?>ref_users/update/"><b><i class="icon-pencil"></i></b> Ubah</a>
							</td> -->
							<td>
								<a class="btn btn-danger btn-labeled btn-xs" href="<?php echo site_url('load_reciveing/delete/'.$key['id']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><b><i class="icon-trash"></i></b> Hapus</a>
							</td>
						</tr>
					<?php $i++; } } else { ?>
						<tr>
							<td colspan="7"> Belum ada Data di Input</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</form>
</div>
