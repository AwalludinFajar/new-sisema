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
		<div class="heading-elements">
			<ul class="icons-list">
				<?php if ($role['insert'] == 'TRUE') { ?>
					<li>
						<a style="color:#fff;" class="btn btn-info btn-labeled btn-xs" href="<?php echo site_url("user_management/bagian_tambah");  ?>"><b><i class="icon-plus3"></i></b> Tambah</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<hr style="margin-top:10px;margin-bottom:5px;">
	<form action="<?php echo site_url(''); ?>" method="post" name="form1" class="form-horizontal form-bordered">
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" style="display: none">
		<div class="panel-heading">
			<div class="form-group">
				<label class="col-lg-1 control-label">Pencarian</label>
				<div class="col-lg-6">
					<input type="text" value="<?php echo $this->session->userdata('s_cari_global'); ?>" class="form-control" name="cari_global" placeholder="Masukan kata kunci..." id="myInput" onkeyup="myFunction()">
				</div>
			</div>
			<div class="table-responsive">
				<table id="tablepaging" class="table table-bordered table-striped table-togglable table-hover" style="width: 100%;">
					<thead>
						<tr class="bg-teal-400">
							<th width="5%">No</th>
							<th>Kode Bagian</th>
							<th>Nama Bagian</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $nom = 1; foreach ($data_bagian_kep as $key => $value) { ?>
							<tr>
								<td><?php echo $nom; ?></td>
								<td><?php echo $value->KunkerID; ?></td>
								<td><?php echo $value->Nama_bagian; ?></td>
								<td><?php if ($value->Status_active == 1) { echo "AKTIF"; } else { echo "NON AKTIF"; } ?></td>
								<td>
									<?php if ($role['update'] == 'TRUE') { ?>
									<a class="btn btn-info btn-xs" href="<?php echo site_url();?>user_management/update_bagian/<?php echo $value->BagianID; ?>"><b><i class="icon-pencil"></i></b></a>
									<?php } if ($role['delete'] == 'TRUE') { ?>
									<a class="btn btn-danger btn-xs" href="<?php echo site_url('user_management/delete_bagian/'.$value->BagianID);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><b><i class="icon-trash"></i></b></a>
									<?php } ?>
								</td>
							</tr>
						<?php $nom++; } ?>
					</tbody>
				</table>
				<div id="pageNavPosition" style="padding-top: 20px"></div>
			</div>
		</div>
	</form>
</div>
<script type="text/javascript">
	function myFunction() {
		// Declare variables 
		var input, filter, table, tr, td, i;
  		input = document.getElementById("myInput");
  		filter = input.value.toUpperCase();
  		table = document.getElementById("myTable");
  		tr = table.getElementsByTagName("tr");

  		// Loop through all table rows, and hide those who don't match the search query
  		for (i = 0; i < tr.length; i++) {
    		td = tr[i].getElementsByTagName("td")[2];
    		if (td) {
      			if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        			tr[i].style.display = "";
      			} else {
        			tr[i].style.display = "none";
      			}
    		} 
  		}
	}

	//custum pagig
	function Pager(tableName, itemsPerPage) {
		this.tableName = tableName;
		this.itemsPerPage = itemsPerPage;
		this.currentPage = 1;
		this.pages = 0;
		this.inited = false;
		
		this.showRecords = function(from, to) {
			var rows = document.getElementById(tableName).rows;
			// i starts from 1 to skip table header row
			for (var i = 1; i < rows.length; i++) {
				if (i < from || i > to) {
					rows[i].style.display = 'none';
				} else {
					rows[i].style.display = '';
				}
			}
		}

		this.showPage = function(pageNumber) {
			if (! this.inited) {
				alert("not inited");
				return;
			}
			var oldPageAnchor = document.getElementById('pg'+this.currentPage);
			oldPageAnchor.className = 'pg-normal';
			this.currentPage = pageNumber;
			var newPageAnchor = document.getElementById('pg'+this.currentPage);
			newPageAnchor.className = 'pg-selected';
			var from = (pageNumber - 1) * itemsPerPage + 1;
			var to = from + itemsPerPage - 1;
			this.showRecords(from, to);
		}

		this.prev = function() {
			if (this.currentPage > 1) {
				this.showPage(this.currentPage - 1);
			}
		}

		this.next = function() {
			if (this.currentPage < this.pages) {
				this.showPage(this.currentPage + 1);
			}
		}

		this.init = function() {
			var rows = document.getElementById(tableName).rows;
			var records = (rows.length - 1);
			this.pages = Math.ceil(records / itemsPerPage);
			this.inited = true;
		}

		this.showPageNav = function(pagerName, positionId) {
			if (! this.inited) {
				alert("not inited");
				return;
			}

			var element = document.getElementById(positionId);
			var pagerHtml = '<span onclick="' + pagerName + '.prev();" class="pg-normal"> « Prev </span> ';
			for (var page = 1; page <= this.pages; page++) {

				pagerHtml += '<span id="pg' + page + '" class="pg-normal" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span> ';
				pagerHtml += '<span onclick="'+pagerName+'.next();" class="pg-normal"> Next »</span>';
				element.innerHTML = pagerHtml;
			}
		}
	}

	var pager = new Pager('tablepaging', 10);
	pager.init();
	pager.showPageNav('pager', 'pageNavPosition');
	pager.showPage(1);
</script>