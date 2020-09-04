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
	<?php echo form_open('ref_menu/save_and_changes',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>	
		<?php 
		if ($this->session->flashdata('message_gagal')) {
			echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
		}					
		if ($this->session->flashdata('message_sukses')) {
			echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
		}?>
		<input type="hidden" name="id_menu" id="id_menu" value="<?php echo isset($field->id_menu)?$field->id_menu:'';?>">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<input type="hidden" value="<?php echo $this->input->ip_address(); ?>" name="ip_address">
		<div class="form-group">
			<label class="col-lg-1 control-label">Nama Menu</label>
			<div class="col-lg-6">
				<input required placeholder="Nama Menu" type="text" name="nama_menu" id="nama_menu" class="form-control" data-rule-required="true" value="<?php echo isset($field->nama_menu)?$field->nama_menu:'';?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-1 control-label">Nama Parrent</label>
			<div class="col-lg-6">
				<select data-rule-required="true" required name="parrent" class="select-search">
					<option value="0">Pilih Parent</option>
					<?php 
					foreach($categoryList as $key => $value){
						$query = $this->db->query("select count(*) as jml from ref_menu where parrent='".$value['id_menu']."'")->row();
						echo "<option value='".$value['id_menu']."' ";
						if (isset($field->id_menu)){
							if ($field->id_menu!=$value['id_menu']) {
								echo $field->parrent==$value['id_menu']?'selected=""':'';
							}											
						}
						echo ">";
						echo $value['nama_menu'];
						echo " </option>";									
					?>
					<tr>
						<td>
							<?php if ($query->jml==0) { ?>
								<em style="color:#555;"><?php echo $value['nama_menu']; ?></em>
							<?php } else { echo "<strong>".$value['nama_menu']."</strong>"; } ?>
						</td>
						<td>
							<a class="btn btn-mini btn-warning " href="<?php echo site_url();?>ref_menu/robih/<?php echo $value['id_menu']; ?>"><i class="icon-pencil"></i>Ubah</a> 
						</td>
						<td>
							<a class="btn btn-mini btn-danger" href="<?php echo site_url('ref_menu/hupus/'.$value['id_menu']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><i class="icon-trash"></i> Hapus</a>
						</td>
					</tr>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-1 control-label">Nama Link</label>
			<div class="col-lg-6">
				<input required placeholder="Nama Link" type="text" name="link" id="link" class="form-control" data-rule-required="true" value="<?php echo isset($field->link)?$field->link:'';?>">
			</div>
		</div>		
		<div class="form-group">
			<label class="col-lg-1 control-label">Urutan</label>
			<div class="col-lg-6">
				<input required placeholder="Urutan" type="number" name="urutan" id="urutan" class="form-control" data-rule-required="true" value="<?php echo isset($field->urutan)?$field->urutan:'';?>">
			</div>
		</div>
		<div class="text-right col-lg-7">
			<button type="submit" class="btn btn-success btn-labeled btn-xs"><b><i class="icon-files-empty2"></i></b> Simpan</button>
			<a class="btn btn-danger btn-labeled btn-xs"  href="<?php echo site_url();?>ref_menu/"><b><i class="icon-arrow-left13"></i></b> Kembali</a>
		</div>
    </form>  
	</div>
	</div>
</div>
			