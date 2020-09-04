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
			<li><a style="color:#fff;"class="btn btn-success btn-labeled btn-xs" href="<?php echo site_url("ref_menu/add");?>"><b><i class="icon-plus3"></i></b> Tambah Menu</a></li>
		<?php } ?>
		</ul>
	</div>
	</div>
	<hr style="margin-top:10px;margin-bottom:5px;">
	<form action="<?php echo site_url('ref_menu/index'); ?>" method="post" name="form1" class="form-horizontal form-bordered">
	<div class="panel-heading">
			<div class="form-group">
				<label class="col-lg-1 control-label">Pencarian</label>
				<div class="col-lg-6">
				<input type="text" id="myInput" onkeyup="myFunction()" class="form-control" name="cari_global" placeholder="Masukan kata kunci..."  >
				</div>
			</div>
	<div class="table-responsive">
	<table id="myTable" class="table table-togglable table-bordered table-striped table-hover">
		<thead>
			<tr class="bg-teal-400">
				<th data-toggle="true" width="5%">No</th>
				<th data-hide="phone">Nama Menu</th>
				<th data-hide="phone" class="text-center" width="5%" colspan="2">Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$no=1;
		foreach($categoryList as $key => $value){
			$query = $this->db->query("select count(*) as jml from ref_menu where parrent='".$value['id_menu']."'")->row();
			?>
			<tr>
				<td><?php echo $no;?></td>
				<td>
					<?php if ($query->jml==0) { ?>
					<em style="color:#555;"><?php echo $value['nama_menu']; ?></em>
					<?php } else { echo "<strong>".$value['nama_menu']."</strong>"; } ?>
				</td>
				<td>
					<?php if ($role['update'] == "TRUE") { ?>
						<a class="btn btn-info btn-labeled btn-xs" href="<?php echo site_url();?>ref_menu/update/<?php echo $value['id_menu']; ?>">
						<b><i class="icon-pencil"></i></b> Ubah</a>
					<?php } ?>
				</td>
				<td>
					<?php if ($role['delete'] == "TRUE") { ?>
					<a class="btn btn-danger btn-labeled btn-xs" href="<?php echo site_url('ref_menu/delete/'.$value['id_menu']);?>" onclick="return confirm('Anda Yakin ingin Menghapus?'); "><b><i class="icon-trash"></i></b> Hapus</a>
					<?php } ?>
				</td>
			</tr>
			<?php  $no++;} ?>	
		</tbody>
	</table>
	</div>
	</div>
	</form>
</div> 
<script>
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>