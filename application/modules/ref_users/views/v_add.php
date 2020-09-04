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

<script type="text/javascript" src="<?php echo base_url()?>assets/js/pages/form_select2.js"></script>
<div class="panel panel-flat">
	<div class = "panel-heading">
	<legend class="text-semibold"><?php echo $judul_form." ".$sub_judul_form;?></legend>
	<div class="panel-body" style="padding:0;">
	<?php echo form_open('ref_users/save_and_changes',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
		<?php
		if ($this->session->flashdata('message_gagal')) {
			echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
		}
		if ($this->session->flashdata('message_sukses')) {
			echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
		}?>
		<input type="hidden" name="id_users" id="id_users" value="<?php echo isset($field->id)?$field->id:'';?>">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none">
		<div class="form-group">
			<label class="col-lg-2 control-label">User Name / NIP</label>
			<div class="col-lg-6">
				<?php //$cnip = isset($field->EmployeeID)?$field->EmployeeID:'';if ($cnip!="") {$ro="readonly";} else {$ro="";} ?>
				<input placeholder="Masukan User Name" type="text" required name="nip_users" id="nip_users" class="form-control" data-rule-required="true"  maxlength="18" value="<?php echo isset($field->username)?$field->username:'';?>" <?php //echo $ro; ?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">Nama</label>
			<div class="col-lg-6">
				<input type="text" placeholder="Masukan Nama" required name="nama_users" id="nama_users" class="form-control" data-rule-required="true" value="<?php echo isset($field->nama_lengkap)?$field->nama_lengkap:'';?>">
			</div>
		</div>
		 <div class="form-group">
			<label class="col-lg-2 control-label">No. Handphone</label>
				<div class="col-lg-6">
					<div class="input-group input-group-lg">
						<span class="input-group-addon"><i class="icon-phone"></i></span>
						<input type="number" placeholder="+62 999-999-99" required name="hp_users" id="hp_users" class="form-control" maxlength="12" data-rule-required="true" value="<?php echo isset($field->hp)?$field->hp:'';?>">
					</div>
				</div>
		</div>

		<div class="form-group">
			<label class="col-lg-2 control-label">Email</label>
				<div class="col-lg-6">
					<div class="input-group input-group-lg">
						<span class="input-group-addon"><i class="icon-mail-read"></i></span>
						<input type="email" placeholder="Masukan Email" required name="email_users" id="email_users" class="form-control" data-rule-required="true" value="<?php echo isset($field->email)?$field->email:'';?>">
					</div>
				</div>
		</div>

		<div class="form-group">
			<label class="col-lg-2 control-label">User Group</label>
				<div class="col-lg-6">
					<select data-rule-required="true" name="group_users" class="select-search">
						<option value="">Pilih User Group</option>
						<?php foreach ($user_group as $key => $value) { ?>
							<option value="<?php echo $value->id_user_group ?>"
							<?php echo isset($field->id_user_group)?($field->id_user_group==$value->id_user_group?'selected=""':''):''?>>
							<?php echo $value->nama_user_group." </option>";
						 } ?>
					</select>
				</div>
		</div>

		<?php if (isset($field->id)) { ?>
		<div class="form-group">
			<label class="col-lg-2 control-label">Password</label>
				<div class="col-lg-6">
					<a class="btn btn-danger btn-labeled btn-xs" onclick="reset_pasword_siu(<?php echo isset($field->id)?$field->id:'';?>)"><b><i class="icon-reload-alt"></i></b> Reset Password</a>
				</div>
		</div>
		<?php } ?>

		<div class="form-group">
			<label class="col-lg-2 control-label">User Aktif</label>
				<div class="col-lg-6">
					<select data-rule-required="true" name="users_aktif" class="select-search">
						<?php if ($field->status_aktif == NULL) { ?>
							<option value="X">Pilih Aktif Atau Tidak Aktif</option>
							<option value="Y">Aktif</option>
							<option value="N">Tidak Aktif</option>
						<?php } else { ?>
							<?php if($field->status_aktif == 'Y') { ?>
								<option value="Y" selected>Aktif</option>
								<option value="N">Tidak Aktif</option>
							<?php } else { ?>
								<option value="N" selected>Tidak Aktif</option>
								<option value="Y">Aktif</option>
							<?php } ?>
						<?php } ?>
					</select>
				</div>
		</div>
		<div class="text-right col-lg-8">
			<button type="submit" class="btn btn-success btn-labeled btn-xs"><b><i class="icon-files-empty2"></i></b> Simpan</button>
			<a class="btn btn-danger btn-labeled btn-xs"  href="<?php echo site_url("ref_users");?>"><b><i class="icon-arrow-left13"></i></b> Kembali</a>
		</div>
	</form>
	</div>
	</div>
</div>

<script type="text/javascript">
$( document ).ready(function() {
	if ($("#provinsi").val() == '') {
		$('#kokab').attr("disabled",true);
	}else{
		getKabProv($("#provinsi").val());
	}
});

function reset_pasword_siu(argument) {
	var kon = confirm("Apakah Anda Yakin Akan me-Reset Password?");
	if (kon == true) {
		$.ajax({
			type:'post',
			url:'<?php echo base_url(); ?>ref_users/resetpasw/'+argument,
			success:function(art) {
				alert("Anda telah me-Reset Password...")
			}
		});
	} else {
		alert("Anda tidak Jadi me-Reset Password...")
	}
}
</script>
