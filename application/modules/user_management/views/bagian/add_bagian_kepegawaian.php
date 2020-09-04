<div class="page-header">
	<div class="page-header-content" style="padding:0;">
		<div class="page-title" style="padding-top:0; padding-bottom:15px;">
			<h4>
				<i class="icon-arrow-left52 position-left" onclick="history.go(-1)"></i>
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
	<div class = "panel-heading">
		<legend class="text-semibold"><?php echo $sub_judul_form;?></legend>
		<div class="panel-body" style="padding:0;">
			<form action="<?php echo site_url('user_management/tambah_bagian'); ?><?php echo isset($bagian[0]->BagianID)?'/'.$bagian[0]->BagianID:''; ?>" class="form-horizontal form-validate form-wysiwyg" enctype="multipart/form-data" method="post">
				<div class="form-group" <?php echo isset($hilangkan)?$hilangkan:''; ?>>
					<label class="col-lg-2 control-label" style="width: 140px;">Komponen</label>
					<div class="col-lg-4">
						<select data-rule-required="true" name="komp" id="komp" class="select-search" onchange="setunker(this.value)" style="width: 400px;">
							<option value="00">SEMUA</option>
							<?php foreach ($filter_komp as $key => $value) { ?>
								<option value="<?php echo $value->kunkom; ?>"><?php echo $value->nunker; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group" id="unker_v">
					<label class="col-lg-2 control-label" style="width: 140px;">Unit Kerja</label>
					<div class="col-lg-4">
						<select data-rule-required="true" name="unker" id="unker" class="select-search" onchange="setsatker(this.value)" style="width: 400px;">
							<option value="00">SEMUA</option>
							<!-- <?php //foreach ($filter_univ as $key => $value) { ?>
								<option value="<?php //echo $value->kununit; ?>"><?php //echo $value->nunker; ?></option>
							<?php //} ?> -->
						</select>
					</div>
				</div>
				<div class="form-group" id="saker_v">
					<label class="col-lg-2 control-label" style="width: 140px;">Satuan Kerja</label>
					<div class="col-lg-4">
						<select data-rule-required="true" name="satker" id="satker" class="select-search" onchange="setsubsat(this.value)" style="width: 400px;">
							<option value="00">SEMUA</option>
							<!-- <?php //foreach ($filter_univ as $key => $value) { ?>
								<option value="<?php //echo $value->ksatker; ?>"><?php //echo $value->nunker; ?></option>
							<?php //} ?> -->
						</select>
					</div>
				</div>
				<div class="form-group"  id="susak_v">
					<label class="col-lg-2 control-label" style="width: 140px;">Sub Satuan Kerja</label>
					<div class="col-lg-4">
						<select data-rule-required="true" name="sabker" id="sabker" class="select-search" onchange="setkode(this.value)" style="width: 400px;">
							<option value="00">SEMUA</option>
							<!-- <?php //foreach ($filter_univ as $key => $value) { ?>
								<option value="<?php //echo $value->kssatker; ?>"><?php //echo $value->nunker; ?></option>
							<?php //} ?> -->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label" style="width: 140px;">Kode Bagian</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" name="kod_bag" id="kod_bag" value="<?php echo isset($bagian[0]->KunkerID)?$bagian[0]->KunkerID:'0000000000'; ?>" readonly="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label" style="width: 140px;">Nama Bagian</label>
					<div class="col-lg-4">
						<input type="text" class="form-control" name="nama_bag" id="nama_bag" value="<?php echo isset($bagian[0]->Nama_bagian)?$bagian[0]->Nama_bagian:''; ?>">
						<input type="hidden" id="nuker" name="nuker" value="<?php echo isset($bagian[0]->nunker)?$bagian[0]->nunker:''; ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-lg-2 control-label" style="width: 140px;">Status</label>
					<div class="col-lg-4">
						<select name="stats" id="stats" class="form-control">
							<option value="1" <?php if (isset($bagian[0]->Status_active) && $bagian[0]->Status_active == 1):echo "selected"; endif ?>>Aktif</option>
							<option value="0" <?php if (isset($bagian[0]->Status_active) && $bagian[0]->Status_active == 0):echo "selected"; endif ?>>Tidak Aktif</option>
						</select>
					</div>
				</div>
				<div class="text-right col-lg-8">
					<button type="submit" class="btn btn-success btn-labeled btn-xs" id="kirimkan">
						<b><i class="icon-files-empty2"></i></b> Simpan</button>
					<a class="btn btn-danger btn-labeled btn-xs" href="<?php echo site_url("user_management/bagian");?>">
						<b><i class="icon-arrow-left13"></i></b> Kembali</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/pages/form_select2.js"></script>
<script type="text/javascript">
	document.getElementById('unker_v').style.display = "none";
	document.getElementById('saker_v').style.display = "none";
	document.getElementById('susak_v').style.display = "none";

	function getSelectedText(elementId) {
	    var elt = document.getElementById(elementId);
	    if (elt.selectedIndex == -1)
	        return null;

	    return elt.options[elt.selectedIndex].text;
	}

	function setunker(idkomp) {
		document.getElementById('unker_v').style.display = "block";
		var kode = document.getElementById('kod_bag').value;
		var set = kode.substr(0,2);
		document.getElementById('kod_bag').value = set+''+idkomp+''+'000000';
		var list = "";
		$.ajax({
			type:'post',
			url:'<?php echo base_url(); ?>user_management/unker/'+idkomp,
			success:function(komp) {
				var da = JSON.parse(komp);
				document.getElementById('unker').innerHTML="";
				for (var i = 0; i < da.length; i++) {
					if (da[i]['kununit'] == 00) {
						list = list+'<option value="00">SEMUA</option>';
					} else {
						list = list+'<option value="'+da[i]['kununit']+'">'+da[i]['nunker']+'</option>';
					}
				}
				document.getElementById('unker').innerHTML=list;

				document.getElementById('nuker').value = getSelectedText('komp');
				document.getElementById('nama_bag').value = getSelectedText('komp');
			}
		});
	}

	function setsatker(idunt) {
		document.getElementById('saker_v').style.display = "block";
		var idkom = document.getElementById('komp').value; var list = "";
		var kode = document.getElementById('kod_bag').value;
		var set = kode.substr(0,4);
		document.getElementById('kod_bag').value = set+''+idunt+''+'0000';
		$.ajax({
			type:'post',
			url:'<?php echo base_url(); ?>user_management/setsatker',
			data: {
				'idkomp':idkom,
				'idunt':idunt
			},
			success:function(rest) {
				var da = JSON.parse(rest);
				document.getElementById('satker').innerHTML="";
				for (var i = 0; i < da.length; i++) {
					if (da[i]['ksatker'] == 00) {
						list = list+'<option value="00">SEMUA</option>';
					} else {
						list = list+'<option value="'+da[i]['ksatker']+'">'+da[i]['nunker']+'</option>';
					}
				}
				document.getElementById('satker').innerHTML=list;

				document.getElementById('nuker').value = getSelectedText('unker');
				document.getElementById('nama_bag').value = getSelectedText('unker');
			}
		});
	}

	function setsubsat(suabker) {
		document.getElementById('susak_v').style.display = "block";
		var idkom = document.getElementById('komp').value;
		var unker = document.getElementById('unker').value; var list = "";
		var kode = document.getElementById('kod_bag').value;
		var set = kode.substr(0,6);
		document.getElementById('kod_bag').value = set+''+suabker+''+'00';
		$.ajax({
			type:'post',
			url:'<?php echo base_url(); ?>user_management/setsubsatker',
			data: {
				'idkomp':idkom,
				'uniker':unker,
				'subker':suabker
			},
			success:function(hasil) {
				var da = JSON.parse(hasil);
				document.getElementById('sabker').innerHTML="";
				for (var i = 0; i < da.length; i++) {
					if (da[i]['kssatker'] == 00) {
						list = list+'<option value="00">SEMUA</option>';
					} else {
						list = list+'<option value="'+da[i]['kssatker']+'">'+da[i]['nunker']+'</option>';
					}
				}
				document.getElementById('sabker').innerHTML=list;

				document.getElementById('nuker').value = getSelectedText('satker');
				document.getElementById('nama_bag').value = getSelectedText('satker');
			}
		});
	}

	function setkode(arg) {
		var nama_kode = getSelectedText('sabker');
		console.log(nama_kode);
		var kode = document.getElementById('kod_bag').value;
		var set = kode.substr(0,8);
		document.getElementById('kod_bag').value = set+''+arg;
		document.getElementById('nuker').value = nama_kode;
		document.getElementById('nama_bag').value = nama_kode;
	}
</script>