<style type="text/css">
	.datatable-header { display: none; }
</style>
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
	<form action="<?php echo site_url('user_management/setFilter'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
		<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
		<div class="panel-heading">
			<div class="form-group">
				<label class="col-lg-2 control-label" style="width: 140px;">Komponen</label>
				<div class="col-lg-4">
					<select data-rule-required="true" name="komp" id="komp" class="select-search" onchange="setunker(this.value)">
						<option value="00">SEMUA</option>
						<?php foreach ($filter_komp as $key => $value) { ?>
							<option value="<?php echo $value->kunkom; ?>"><?php echo $value->nunker; ?></option>
						<?php } ?>
					</select>
				</div>
				<label class="col-lg-2 control-label" style="width: 140px;">Unit Kerja</label>
				<div class="col-lg-4">
					<select data-rule-required="true" name="unker" id="unker" class="select-search" onchange="setsatker(this.value)">
						<option value="00">SEMUA</option>
						<!-- <?php //foreach ($filter_univ as $key => $value) { ?>
							<option value="<?php //echo $value->kununit; ?>"><?php //echo $value->nunker; ?></option>
						<?php //} ?> -->
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label" style="width: 140px;">Satuan Kerja</label>
				<div class="col-lg-4">
					<select data-rule-required="true" name="satker" id="satker" class="select-search" onchange="setsubsat(this.value)">
						<option value="00">SEMUA</option>
						<!-- <?php //foreach ($filter_univ as $key => $value) { ?>
							<option value="<?php //echo $value->ksatker; ?>"><?php //echo $value->nunker; ?></option>
						<?php //} ?> -->
					</select>
				</div>
				<label class="col-lg-2 control-label" style="width: 140px;">Sub Satuan Kerja</label>
				<div class="col-lg-4">
					<select data-rule-required="true" name="sabker" id="sabker" class="select-search" onchange="setkode(this.value)">
						<option value="00">SEMUA</option>
						<!-- <?php //foreach ($filter_univ as $key => $value) { ?>
							<option value="<?php //echo $value->kssatker; ?>"><?php //echo $value->nunker; ?></option>
						<?php //} ?> -->
					</select>
				</div>
				<input type="hidden" name="kod_bag" id="kod_bag" value="0000000000">
			</div>
			<div class="form-group">
				<label class="col-lg-2 control-label" style="width: 140px;">Nip</label>
				<div class="col-lg-4">
					<input type="text" name="nip_peg" id="peg_nip" class="form-control" placeholder="Masukan Nip">
				</div>
				<label class="col-lg-2 control-label" style="width: 140px;">Nama</label>
				<div class="col-lg-4">
					<input type="text" name="nama_peg" id="peg_nama" class="form-control" placeholder="Masukan Nama">
				</div>
			</div>
			<div class="form-group">
				<div class="text-right col-lg-11" style="margin-left: -45px;">
					<button type="submit" class="btn btn-success btn-labeled btn-xs" id="kirimkan"><b><i class="glyphicon glyphicon-search"></b></i>Cari</button>
				</div>
			</div>
			<!-- <?php //echo $this->session->userdata('s_cari_global'); ?> -->
			<div class="table-responsive">
				<table id="myTabe" class="table table-bordered table-striped table-togglable table-hover" style="margin-top: -10px;">
					<thead>
						<tr class="bg-teal-400">
							<th width="5%">No</th>
							<th>NIP</th>
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Eselon</th>
							<th>Pangkat/Gol. Ruang</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $x=1; if( !empty($user_sppd) ) { foreach ($user_sppd as $key => $value) { ?>
							<tr>
								<td><?php echo $x; ?></td>
								<td><?php echo $value->nip; ?></td>
								<td><?php echo $value->nama; ?></td>
								<td><?php echo $value->njab; ?></td>
								<td><?php echo $value->neselon; ?></td>
								<td><?php echo $value->jabatanNama_bkn." (".$value->golRuangAkhir_bkn.")"; ?></td>
								<!-- <td><?php //echo $value->pangkat." (".$value->ngolru.")"; ?></td> -->
								<td>
									<a class="btn btn-info btn-labeled btn-xs" data-toggle="modal" data-target="#viewbeforeadd" href="" onclick="showdata(<?php echo "'".$value->nip."'"; ?>, <?php echo "'".$value->nama."'"; ?>)">
										<b><i class="icon-pencil"></i></b>Tambah User
									</a>
								</td>
							</tr>
						<?php $x++; } } ?>
					</tbody>
				</table>
			</div>
		</div>
	</form>
</div>

<div id="viewbeforeadd" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width: 50%; height: 60%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" onclick="bersihkan()">&times;</button>
	        	<h4 class="modal-title">Entry Detail</h4>
			</div>
			<form class="form-horizontal form-validate form-wysiwyg" enctype="multipart/form-data" method="post" id="setber" action="<?php echo base_url() ?>user_management/setuserdata">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-lg-3 control-label" style="width: 140px;">Username / Nip</label>
						<div class="col-lg-6">
							<input type="text" name="nip_pega" id="nip_gawai" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" style="width: 140px;">Nama</label>
						<div class="col-lg-6">
							<input type="text" name="nama_peg" id="nama_peg" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" style="width: 140px;">Jabatan</label>
						<div class="col-lg-6">
							<input type="text" name="jabatanname" id="jabatanname" class="form-control">
							<input type="hidden" name="unkpker" id="unkpker"> <input type="hidden" name="koker" id="koker">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" style="width: 140px;">No. Handphone</label>
						<div class="col-lg-6">
							<input type="text" name="nohp" id="nohp" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" style="width: 140px;">E-mail</label>
						<div class="col-lg-6">
							<input type="text" name="mail" id="mail" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" style="width: 140px;">Bagian</label>
						<div class="col-lg-6">
							<select data-rule-required="true" name="bagian" id="bagian" class="select-search" onchange="setunker(this.value)">
								<?php foreach ($filter_bagian as $key => $value) { ?>
									<option value="<?php echo $value->BagianID; ?>"><?php echo $value->Nama_bagian; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" style="width: 140px;">User Group</label>
						<div class="col-lg-6">
							<select name="usgroup" id="usgroup" class="form-control">
								<?php foreach ($user_cond as $key => $value) { ?>
									<option value="<?php echo $value->id_user_group; ?>"><?php echo $value->nama_user_group; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-3 control-label" style="width: 140px;">User Aktif</label>
						<div class="col-lg-6">
							<select name="usaktif" id="usaktif" class="form-control">
								<option value="1">Aktif</option>
								<option value="0">Tidak Aktif</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="text-right col-lg-12" style="margin-left: -45px;">
							<button type="submit" class="btn btn-success btn-xs" id="kirimkan">Simpan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$.extend( true, $.fn.dataTable.defaults, {
		"searching": false,
	    "ordering": false
	});
	$(document).ready(function() {
	    $('#myTabe').DataTable();
	});

	function setunker(idkomp) {
		// var ot = document.getElementById('s2id_unker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML;
		// var oo = document.getElementById('s2id_satker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML;
		// var to = document.getElementById('s2id_sabker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML;
		// if (ot != 'SEMUA') {
		// 	document.getElementById('s2id_unker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML = 'SEMUA';
		// }
		// if (oo != 'SEMUA') {
		// 	document.getElementById('s2id_satker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML = 'SEMUA';
		// }
		// if (to != 'SEMUA') {
		// 	document.getElementById('s2id_sabker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML = 'SEMUA';
		// }

		var kode = document.getElementById('kod_bag').value;
		var set = kode.substr(0,2);
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
				document.getElementById('kod_bag').value = set+''+idkomp+''+'000000';
			}
		});
	}

	function setsatker(idunt) {
		// var oo = document.getElementById('s2id_satker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML;
		// var to = document.getElementById('s2id_sabker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML;
		// if (oo != 'SEMUA') {
		// 	document.getElementById('s2id_satker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML = 'SEMUA';
		// }
		// if (to != 'SEMUA') {
		// 	document.getElementById('s2id_sabker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML = 'SEMUA';
		// }

		var idkom = document.getElementById('komp').value; var list = "";
		var kode = document.getElementById('kod_bag').value;
		var set = kode.substr(0,4);
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
				document.getElementById('kod_bag').value = set+''+idunt+''+'0000';
			}
		});
	}

	function setsubsat(suabker) {
		// var to = document.getElementById('s2id_sabker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML;
		// if (to != 'SEMUA') {
		// 	document.getElementById('s2id_sabker').getElementsByClassName('select2-choice')[0].getElementsByTagName('span')[0].innerHTML = 'SEMUA';
		// }
		
		var idkom = document.getElementById('komp').value;
		var unker = document.getElementById('unker').value; var list = "";
		var kode = document.getElementById('kod_bag').value;
		var set = kode.substr(0,6);
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
				document.getElementById('kod_bag').value = set+''+suabker+''+'00';
			}
		});
	}

	function setkode(arg) {
		var kode = document.getElementById('kod_bag').value;
		var set = kode.substr(0,8);
		document.getElementById('kod_bag').value = set+''+arg;
	}

	function showdata(nip, nama) {
		$.ajax({
			type:'post',
			url:'<?php echo base_url(); ?>user_management/selectonly',
			data: {
				'nip_peg':nip,
				'nama_peg':nama
			},
			success:function(outp) {
				var da = JSON.parse(outp);
				console.log(da);
				document.getElementById('nip_gawai').value = da[0]['nip'];
				document.getElementById('nama_peg').value = da[0]['nama'];
				document.getElementById('jabatanname').value = da[0]['njab'];
				document.getElementById('unkpker').value = da[0]['ukr'];
				document.getElementById('koker').value = da[0]['kuntp']+""+da[0]['kunkom']+""+da[0]['kununit']+""+da[0]['kunsk']+""+da[0]['kunssk'];
				document.getElementById('nohp').value = da[0]['alhp'];
				document.getElementById('mail').value = da[0]['alemail'];
			}
		});
	}

	function bersihkan() {
		document.getElementById('setber').reset();
	}
</script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/pages/form_select2.js"></script>