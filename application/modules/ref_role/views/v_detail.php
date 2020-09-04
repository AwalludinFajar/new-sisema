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
	<div class ="panel-heading" style="padding-bottom:0;">
	<h5 class="panel-title"><?php echo $judul_form." ".$sub_judul_form;?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h5>
	</div>
	<hr style="margin-top:10px;margin-bottom:5px;">
	<div class = "panel-heading">
	<div class="panel-body" style="padding:0;">
		<?php echo form_open('ref_role/update_pv',array('name'=>'bb', 'id'=>'bb','class'=>'form-horizontal form-validate form-wysiwyg','enctype'=>'multipart/form-data'));?>
			<?php 
			if ($this->session->flashdata('message_gagal')) {
				echo '<hr><div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_gagal').'</div>';
			}					
			if ($this->session->flashdata('message_sukses')) {
				echo '<hr><div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">&times;</button>'.$this->session->flashdata('message_sukses').'</div>';
			}?>
			<input type="hidden" name="id_user_group" id="id_user_group" value="<?php echo isset($field->id_user_group)?$field->id_user_group:'';?>">
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none">
			<div class="form-group">
				<label class="col-lg-5 control-label">Nama Group Pengguna : <b><?php echo isset($field->nama_user_group)?$field->nama_user_group:'';?></b></label>
			</div>
				
			<div class="table-responsive">
			<table id="myTable" class="table table-bordered table-striped table-togglable ">
				<tr class="text-center">
					<th class="bg-teal-400" rowspan="2">Menu<br><input onclick="checkMenu('ch_menu')" type="checkbox"  id="myMenu"></th>
					<th class="bg-teal-400" colspan="5">Previlege</th>								
				</tr>
				<tr class="bg-teal-400">
					<th class="text-center">Insert<br><input onclick="checkInsert('ch_insert')" type="checkbox"  id="myInsert"></th>
					<th class="text-center">Update<br><input onclick="checkUpdate('ch_update')" type="checkbox"  id="myUpdate"></th>
					<th class="text-center" >Delete<br><input onclick="checkDelete('ch_delete')" type="checkbox"  id="myDelete"></th>					
					<th class="text-center" >View<br><input onclick="checkDelete('ch_view')" type="checkbox"  id="myView"></th>						    
					<th class="text-center" >Print<br><input onclick="checkDelete('ch_print')" type="checkbox"  id="myPrint"></th>					
				</tr>

				<?php 
				if (isset($categoryList)) {
					foreach($categoryList as $key => $value){

						$cb ="";
						$role = "";												
						$query = $this->db->query("select count(*) as 
							jml from ref_menu where parrent='".$value['id_menu']."'")->row();
							
						if (isset($menu_user)) {
							foreach ($menu_user as $keys => $values) {
								if($values->id_menu==$value['id_menu']){
									$cb = "checked=''";
									$role = decode_role($values->role);								
								}
							}
						}
						
					?>
					<tr>
						<td> 
							<input type="checkbox" id="ch_menu" name="cb_pv[]" value="<?php echo $value['id_menu']; ?>" <?php echo $cb ?>> 
							<?php echo $value['nama_menu']; ?>
						</td>
						<td> 
							<input type="checkbox" id="ch_insert" name="role[<?php echo $value['id_menu']; ?>][]" value="C" 
							<?php echo (isset($role["insert"]) && $role["insert"] =="TRUE") ? 'checked="" ' : '' ; ?> > Insert
						</td>
						<td> 
							<input type="checkbox" id="ch_update" name="role[<?php echo $value['id_menu']; ?>][]" value="U" 
							<?php echo (isset($role["update"]) && $role["update"]=="TRUE") ? 'checked="" ' : '' ; ?> > Update
						</td>
						<td> 
							<input type="checkbox" id="ch_delete" name="role[<?php echo $value['id_menu']; ?>][]" value="D" 
							<?php echo (isset($role["delete"]) && $role["delete"]=="TRUE") ? 'checked="" ' : '' ; ?> > Delete
						</td>
						<td> 
							<input type="checkbox" id="ch_view" name="role[<?php echo $value['id_menu']; ?>][]" value="V" 
							<?php echo (isset($role["view"]) && $role["view"]=="TRUE") ? 'checked="" ' : '' ; ?> >View
						</td>
						<td> 
							<input type="checkbox" id="ch_print" name="role[<?php echo $value['id_menu']; ?>][]" value="P" 
							<?php echo (isset($role["print"]) && $role["print"]=="TRUE") ? 'checked="" ' : '' ; ?> > Print
						</td>
					</tr>										
						<?php
					}
				}
				?>
			</table>
			</div>
			<div style="padding-top:10px;" class="text-right">
				<button type="submit" class="btn btn-success btn-labeled btn-xs"><b><i class="icon-files-empty2"></i></b> Simpan</button>
				<a class="btn btn-danger btn-labeled btn-xs"  href="<?php echo site_url("ref_role");?>"><b><i class="icon-arrow-left13"></i></b> Kembali</a>
			</div>
		</form>
	</div>
	</div>
</div>
<script type="text/javascript">
	function checkInsert(checkId){
		var inputs = document.getElementsByTagName("input");
		for (var i = 0; i < inputs.length; i++) { 
			if (inputs[i].type == "checkbox" && inputs[i].id == checkId) { 
				if(inputs[i].checked == true) {
					inputs[i].checked = false ;
				} else if (inputs[i].checked == false ) {
					inputs[i].checked = true ;
				}
			}  
		}  
	}
	
	function checkUpdate(checkId){
		var inputs = document.getElementsByTagName("input");
		for (var i = 0; i < inputs.length; i++) { 
			if (inputs[i].type == "checkbox" && inputs[i].id == checkId) { 
				if(inputs[i].checked == true) {
					inputs[i].checked = false ;
				} else if (inputs[i].checked == false ) {
					inputs[i].checked = true ;
				}
			}  
		}  
	}
	
	function checkDelete(checkId){
		var inputs = document.getElementsByTagName("input");
		for (var i = 0; i < inputs.length; i++) { 
			if (inputs[i].type == "checkbox" && inputs[i].id == checkId) { 
				if(inputs[i].checked == true) {
					inputs[i].checked = false ;
				} else if (inputs[i].checked == false ) {
					inputs[i].checked = true ;
				}
			}  
		}  
	}
	
	function checkPrint(checkId){
		var inputs = document.getElementsByTagName("input");
		for (var i = 0; i < inputs.length; i++) { 
			if (inputs[i].type == "checkbox" && inputs[i].id == checkId) { 
				if(inputs[i].checked == true) {
					inputs[i].checked = false ;
				} else if (inputs[i].checked == false ) {
					inputs[i].checked = true ;
				}
			}  
		}  
	}
	
	function checkView(checkId){
		var inputs = document.getElementsByTagName("input");
		for (var i = 0; i < inputs.length; i++) { 
			if (inputs[i].type == "checkbox" && inputs[i].id == checkId) { 
				if(inputs[i].checked == true) {
					inputs[i].checked = false ;
				} else if (inputs[i].checked == false ) {
					inputs[i].checked = true ;
				}
			}  
		}  
	}
	
	function checkMenu(checkId){
		var inputs = document.getElementsByTagName("input");
		for (var i = 0; i < inputs.length; i++) { 
			if (inputs[i].type == "checkbox" && inputs[i].id == checkId) { 
				if(inputs[i].checked == true) {
					inputs[i].checked = false ;
				} else if (inputs[i].checked == false ) {
					inputs[i].checked = true ;
				}
			}  
		}  
	}
</script>