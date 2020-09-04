<div class="page-header">
	<div class="page-header-content" style="padding:0;">
		<div class="page-title" style="padding-top:0; padding-bottom:15px;">
			<h4>
				<i class="icon-arrow-left52 position-left"></i>
				<span class="text-semibold">Setting Profil Applikasi</span>
			</h4>
			<ul class="breadcrumb breadcrumb-caret position-right">
				<li>
					<a href=<?php echo base_url().'welcome';?> >Home</a>
				</li>
				<li>
					<a href=<?php echo base_url().'ref_profil_app';?> >Profil Applikasi</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="panel panel-flat">
	<div class = "panel-heading">
	<legend class="text-semibold">Setting Profil Applikasi</legend>
	<div class="panel-body" style="padding:0;">
	<?php echo form_open('ref_profil_app/add',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			
		<?php 
		if ($this->session->flashdata('message_gagal')) {
			echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
		}					
		if ($this->session->flashdata('message_sukses')) {
			echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
		}?>
		
		<div class="form-group">
			<label class="col-lg-2 control-label">Judul Applikasi</label>
			<div class="col-lg-6">
				<input placeholder="Masukan Judul Applikasi" type="text" class='form-control' id="jdl_applikasi" name="jdl_applikasi" data-rule-required="true" value="<?php echo isset($ListLogo[0]["nama_aplikasi"])?$ListLogo[0]["nama_aplikasi"]:'';?>" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">Text Judul di Header ?</label>
			<div class="col-lg-4">
				<input type="radio" name="shw_judul" id="shw_judul" value="1" <?php if ($ListLogo[0]["text_j_header"] == 1) { echo "checked"; } ?>>&nbsp;<label>YA</label> &nbsp;&nbsp;&nbsp;
				<input type="radio" name="shw_judul" id="shw_judul" value="0" <?php if ($ListLogo[0]["text_j_header"] == 0) { echo "checked"; } ?>>&nbsp;<label>TIDAK</label>
			</div>
		</div>	
		<hr>
		<div class="form-group">
			<label class="col-lg-2 control-label">Logo Applikasi</label>
			<div class="col-lg-6">
				<?php if($ListLogo[0]["logo"] == NULL) { ?>
					<div class="uploader">
						<input type='file' name="filelogo" id="imglogo" class="file-styled">
					</div>
					<img id="blahlogo" src="<?php echo base_url().'uploads/profil_app/no_image.png';?>" style="width: 150px; margin-top: 10px;" />
				<?php }else { ?>
					<div class="uploader">
						<input type='file' name="filelogo" id="imglogo" class="file-styled">
					</div>
					<img id="blahlogo" src="<?php echo base_url().'uploads/profil_app/'.$ListLogo[0]["logo"];?>" style="width: 150px; margin-top: 10px;" />
				<?Php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">Image size (LOGO)</label>
			<div class="col-lg-1"> <input type="number" name="lg_width" id="lg_width" class="form-control" value="<?php echo $ListLogo[0]['lgo_width']; ?>" placeholder="WIDTH"> </div>
			<div class="col-lg-1"> <input type="number" name="lg_height" id="lg_height" class="form-control" value="<?php echo $ListLogo[0]['lgo_height']; ?>" placeholder="HEIGHT"> </div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">Note Logo</label>
			<div class="col-lg-6">
				<textarea name="ket_logo" class="form-control"><?php echo $ListLogo[0]['note_lo']; ?></textarea>
			</div>
		</div>
		<hr>
		<div class="form-group">
			<label class="col-lg-2 control-label">Background Applikasi</label>
			<div class="col-lg-6">
				<div class="uploader">
					<input type="file" name="filebg" id="imgbg" class="file-styled">
				</div>
				<?php if($ListLogo[0]["background"] == NULL){ ?>
					<img id="blahbg" src="<?php echo base_url().'uploads/profil_app/no_image.png';?>" style="width: 150px; margin-top: 10px;" />
				<?php }else { ?>
					<img id="blahbg" src="<?php echo base_url().'uploads/profil_app/'.$ListLogo[0]["background"];?>" style="width: 550px; margin-top: 10px;" />
				<?Php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">Note Background</label>
			<div class="col-lg-6">
				<textarea name="ket_bgr" class="form-control"><?php echo $ListLogo[0]['note_bg']; ?></textarea>
			</div>
		</div>
		<!-- <div class="form-group"> -->
			<!-- <label class="col-lg-2 control-label">Image size (BACKGROUND)</label> -->
			<!-- <div class="col-lg-1"> <input type="number" name="bg_width" id="bg_width" class="form-control" value="<?php //echo $ListLogo[0]['bgr_width']; ?>" placeholder="WIDTH"> </div> -->
			<!-- <div class="col-lg-1"> <input type="number" name="bg_height" id="bg_height" class="form-control" value="<?php //echo $ListLogo[0]['bgr_height']; ?>" placeholder="HEIGHT"> </div> -->
		<!-- </div> -->
		<hr>
		<div class="form-group">
			<label class="col-lg-2 control-label">Header Applikasi</label>
			<div class="col-lg-6">
				<div class="uploader">
					<input type="file" name="filehd" id="imghd" class="file-styled">
				</div>
				<?php if($ListLogo[0]["header"] == NULL){ ?>
					<img id="blahhd" src="<?php echo base_url().'uploads/profil_app/no_image.png';?>" style="width: 150px; margin-top: 10px;" />
				<?php } else { ?>
					<img id="blahhd" src="<?php echo base_url().'uploads/profil_app/'.$ListLogo[0]["header"];?>" style="width: 620px; margin-top: 10px;" />
				<?Php } ?>
			</div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">Image size (HEADER)</label>
			<div class="col-lg-1"> <input type="number" name="hd_width" id="hd_width" class="form-control" value="<?php echo $ListLogo[0]['hdr_width']; ?>" placeholder="WIDTH"> </div>
			<div class="col-lg-1"> <input type="number" name="hd_height" id="hd_height" class="form-control" value="<?php echo $ListLogo[0]['hdr_height']; ?>" placeholder="HEIGHT"> </div>
		</div>
		<div class="form-group">
			<label class="col-lg-2 control-label">Note Header</label>
			<div class="col-lg-6">
				<textarea name="ket_head" class="form-control"><?php echo $ListLogo[0]['note_hd']; ?></textarea>
			</div>
		</div>
		<hr>
		<li style="color: red;">Ukuran Gambar menggunakan satuan px(Pixel)</li>
		<div class="text-right col-lg-8">
			<button type="submit" class="btn btn-success btn-labeled btn-xs"><b><i class="icon-files-empty2"></i></b> Simpan</button>
			<a class="btn btn-danger btn-labeled btn-xs"  href="<?php echo site_url();?>welcome/"><b><i class="icon-arrow-left13"></i></b> Kembali</a>
		</div>
		
	</form>						
	</div>
	</div>
</div>
<script type="text/javascript">
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blahlogo').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function readURL2(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blahbg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readURL3(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blahhd').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgbg").change(function(){
    readURL2(this);
});
$("#imglogo").change(function(){
    readURL(this);
});
$("#imghd").change(function(){
    readURL3(this);
});

function deleteFile(id){
$.ajax({
	url     : '<?php echo site_url('app_setting/hupus');?>/'+id,
	success : function(data){
		alert(data);
		location.reload();
	}
});
}
</script>

