<div class="page-header">
	<div class="page-header-content" style="padding:0;">
		<div class="page-title" style="padding-top:0; padding-bottom:15px;">
			<h4>
				<i class="icon-arrow-left52 position-left"></i>
				<span class="text-semibold"><?php echo $judul_form." ".$sub_judul_form;?></span>
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
	<div class = "panel-heading">
	<legend class="text-semibold"><?php echo $judul_form." ".$sub_judul_form;?></legend>
	<div class="panel-body" style="padding:0;">
		<?php echo form_open('ref_role/save_and_changes',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			<?php 
			if ($this->session->flashdata('message_gagal')) {
				echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
			}					
			if ($this->session->flashdata('message_sukses')) {
				echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
			}?>
			<input type="hidden" name="id_user_group" id="id_user_group" value="<?php echo isset($field->id_user_group)?$field->id_user_group:'';?>">
			<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
			<div class="form-group">
				<label class="col-lg-2 control-label">Nama Group Pengguna</label>
				<div class="col-lg-6">
					<input required placeholder="Nama Group Pengguna" type="text" name="nama_user_group" id="nama_user_group" class="form-control" data-rule-required="true" value="<?php echo isset($field->nama_user_group)?$field->nama_user_group:'';?>">
				</div>
			</div>
			<div class="text-right col-lg-8">
				<button type="submit" class="btn btn-success btn-labeled btn-xs"><b><i class="icon-files-empty2"></i></b> Simpan</button>
				<a class="btn btn-danger btn-labeled btn-xs"  href="<?php echo site_url("ref_role");?>"><b><i class="icon-arrow-left13"></i></b> Kembali</a>
			</div>
		</form>
	</div>
	</div>
</div>