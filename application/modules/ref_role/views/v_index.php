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
	<h5 class="panel-title"><?php echo $sub_judul_form;?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
	<div class="heading-elements">
		<ul class="icons-list" style="margin-top:10px;">
		<?php if ($role['insert'] == "TRUE") { ?>
			<li><a style="color:#fff;"class="btn btn-success btn-labeled btn-xs" href="<?php echo site_url("ref_role/add");?>"><b><i class="icon-plus3"></i></b> Tambah Role</a></li>
		<?php } ?>
		</ul>
	</div>
	</div>
	<hr style="margin-top:10px;margin-bottom:5px;">
	<form action="<?php echo site_url('ref_role/index'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-heading">
			<div class="form-group">
				<label class="col-lg-1 control-label">Pencarian</label>
				<div class="col-lg-6">
					<input type="text" value="<?php echo $this->session->userdata('s_cari_global'); ?>" class="form-control" name="cari_global" placeholder="Masukan kata kunci..."  >	
				</div>
			</div>
			
			<div>
			<table class="table table-bordered table-striped table-togglable table-hover">
				<thead>
					<tr class="bg-teal-400">
						<th data-toggle="true" width="5%">No</th>
						<th data-hide="phone">Nama User</th>
						<th data-hide="phone" class="text-center" width="5%" colspan="3">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php if (count($ListData) > 0) 
					{
						$no = 1;
						foreach($ListData as $row)
						{	?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $row['nama_user_group']; ?></td>
								<td>
									<a class="btn bg-teal btn-labeled btn-xs" href="<?php echo site_url();?>ref_role/detail/<?php echo $row['id_user_group']; ?>"><b><i class="icon-search4"></i></b>Detail</a> 
								</td>									     
								 <td>
									<a class="btn btn-info btn-labeled btn-xs" href="<?php echo site_url();?>ref_role/update/<?php echo $row['id_user_group']; ?>"><b><i class="icon-pencil"></i></b> Ubah</a> 
								</td>
								<td>
									<a class="btn btn-danger btn-labeled btn-xs" href="<?php echo site_url('ref_role/delete/'.$row['id_user_group']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><b><i class="icon-trash"></i></b> Hapus</a> 
								</td>
							</tr>
					<?php
							$paging=(!empty($pagermessage) ? $pagermessage : '');
							$no++;
						}
						echo "<tr><td colspan='9'><div style='background:000;'>$paging &nbsp;".$this->pagination->create_links()."</div></td></tr>";
					} else {
						echo "<tbody><tr><td colspan='9' style='padding:10px; background:#F00; border:none; color:#FFF;'>Data Tidak Tersedia</td></tr></tbody>";
					}
					?>
				</tbody>
			</table>
		</div>
	</form>
</div>	