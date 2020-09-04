<div class="page-header">
	<div class="page-header-content" style="padding:0;">
		<div class="page-title" style="padding-top:0; padding-bottom:15px;">
			<h4>
				<i class="icon-arrow-left52 position-left"></i>
				<span class="text-semibold">Form Ubah Password</span>
			</h4>
			<ul class="breadcrumb breadcrumb-caret position-right">
				<li>
					<a href=<?php echo base_url().'welcome';?> >Home</a>
				</li>
				<li>
					<a href=<?php echo base_url().'editpass';?> >Ubah Password</a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="panel panel-flat">
	<div class = "panel-heading">
	<legend class="text-semibold">Form Ubah Password</legend>
	<div class="panel-body" style="padding:0;">
	<?php echo form_open('editpass/submit',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate'));?>						
		<?php if (isset($pesan)) { 
		echo '<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$pesan.'</div>';
		}
		?>
		
		<div class="form-group">
			<label class="col-lg-2 control-label">Masukan password lama</label>
			<div class="col-lg-6">
				<input placeholder="Masukan Password Lama" type="password" class='form-control' id="kunci_masuk_lama" name="kunci_masuk_lama" data-rule-required="true" value="" />
			</div>
		</div>	
		
		<div class="form-group">
			<label class="col-lg-2 control-label">Masukan password baru</label>
			<div class="col-lg-6">
				<input placeholder="Masukan Password Baru" type="password" class='form-control' id="kunci_masuk_baru" name="kunci_masuk_baru" data-rule-required="true" value="" />
			</div>
		</div>	
		
		<div class="text-right col-lg-8">
			<button type="submit" class="btn btn-success btn-labeled btn-xs"><b><i class="icon-files-empty2"></i></b> Simpan</button>
			<a class="btn btn-danger btn-labeled btn-xs"  href="<?php echo site_url();?>welcome/"><b><i class="icon-arrow-left13"></i></b> Kembali</a>
		</div>
		
	</form>						
	</div>
	</div>
</div>

