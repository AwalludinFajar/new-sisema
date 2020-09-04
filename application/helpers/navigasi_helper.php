<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


function navigasi() {
	$CI =& get_instance();
	$query = $CI->db->query("SELECT * from ref_menu")->result();
	$a="";
	foreach ($query as $key => $value) {
		$a.=$value->nama_menu;
		$a.=" - ";
	}
	return $a;
}


function info_user($id){
	$CI =& get_instance();
	$query = $CI->db->query("SELECT * from ref_users where id='".$id."' limit 1");
  return $query->row();
}

function penugasan_decrypt($id = null){
	switch ($id) {
		case 1:
			$return = "Pemerintahan Pusat";
			break;
		case 2:
			$return = "Pemerintahan Provinsi";
			break;
		case 3:
			$return = "Pemerintahan Kab / Kota";
			break;
		case 4:
			$return = "Pemerintahan Kecamatan";
			break;
		case 5:
			$return = "Pemerintahan Kelurahan";
			break;

		default:
			$return = "-";
			break;
	}
   return $return;
}
	function judulapp() {
		$CI =& get_instance();
		$sql		= "SELECT * FROM ref_profil_app";
		$query = $CI->db->query($sql);
		$i=0;
		foreach($query->result_array() as $item){
			$jv = "";
			if ($item['text_j_header'] == 0) { $jv = ""; }
			else { $jv = $item['nama_aplikasi']; }
			$judul 		 = $jv;
			$logo  		 = $item['logo'];
			$background  = $item['background'];
		}
		echo $judul;
	}

	function logoapp() {
		$CI     =& get_instance();
		$sql    = "SELECT * FROM ref_profil_app";
		$query  = $CI->db->query($sql);
		$i=0;
		foreach($query->result_array() as $item){
			$logo = $item['logo'];
			$i++;
		}
		echo base_url().'uploads/profil_app/'.$logo;
	}

	function bgapp() {
		$CI =& get_instance();
		$sql		= "SELECT * FROM ref_profil_app";
		$query = $CI->db->query($sql);
		$i=0;
		foreach($query->result_array() as $item){
			$background  = $item['background'];
		}
		//echo $background;
	}

	function sizeofimg() {
		$CI =& get_instance();
		$sql		= "SELECT * FROM ref_profil_app";
		$query = $CI->db->query($sql);
		return $query->result_array();
	}

	function hdapp() {
		$CI =& get_instance();
		$sql		= "SELECT * FROM ref_profil_app";
		$query = $CI->db->query($sql);
		$i=0;
		foreach($query->result_array() as $item){
			$header  = $item['header'];
		}
		echo base_url().'uploads/profil_app/'.$header;
	}

	function menu_nav(){
		$CI =& get_instance();
		$menunav = '';
		$user_id = $CI->session->userdata('sesi_id');
		$user_id_group = $CI->session->userdata('sesi_user_group');
		// $user_id_group = info_user($user_id)->userlevel_id;
		$sql = "SELECT ref_menu.icon,ref_menu.id_menu, nama_menu, link
				FROM ref_menu
				LEFT JOIN ref_group_menu ON ref_group_menu.id_menu = ref_menu.id_menu
				WHERE ref_group_menu.id_user_group = '".$user_id_group."' AND parrent = 0 ORDER BY id_menu asc";
		$query = $CI->db->query($sql);
		$i=0;
		foreach($query->result_array() as $row)
		{
			if(toogle($row['id_menu'],$user_id) > 0){
				$menunav .= "<li>";
				$menunav .= '
							<a href="'.site_url($row['link']).'" class="dropdown-toggle" data-toggle="dropdown">
							<i class='.$row['icon'].' style="padding-right:5px;"> </i>
								<span>'.$row['nama_menu'].'</span>
								<b class="caret"></b>
							</a>';
				$menunav .=	formatTree($row['id_menu'],$user_id);
				$menunav .= "</li>";
			}else{
				$menunav .= "<li>";
				$menunav .= '<a href="'.site_url($row['link']).'">
							<i class='.$row['icon'].' style="padding-right:5px;"> </i>
								<span>'.$row['nama_menu'].'</span>
							</a>';
				$menunav .= "</li>";
			}
			$i++;
		}

		echo $menunav;
	}

	function formatTree($id_parent,$user_id_group){
		$CI =& get_instance();

		$sql = "SELECT ref_menu.icon,ref_menu.id_menu, nama_menu, link
				FROM ref_menu
				LEFT JOIN ref_group_menu ON ref_group_menu.id_menu = ref_menu.id_menu
				WHERE id_user_group = '".$user_id_group."' AND parrent = '".$id_parent."' ORDER BY urutan asc";


		$query = $CI->db->query($sql);
		$menunav = "<ul class='dropdown-menu'>";
        foreach($query->result_array() as $item){
			if(toogle($item['id_menu'],$user_id_group) > 0){
				$menunav .= "<li class='dropdown-submenu'>";
				$menunav .= '<a href="'.site_url($item['link']).'">'.$item['nama_menu'].'
				<i class='.$item['icon'].' style="padding-right:5px;"> </i></a>';
				$menunav.= formatTree($item['id_menu'],$user_id_group);
				$menunav.= "</li>";

			}else{
				$menunav .= "<li>";
				$menunav .= '<a href="'.site_url($item['link']).'"><i class='.$item['icon'].' style="padding-right:5px;"> </i>'.$item['nama_menu'].'</a>';
				$menunav.= "</li>";
			}
        }


      $menunav.= "</ul>";
	  return $menunav;
    }

	function toogle($id_parent,$user_id_group){
		$CI =& get_instance();
		$sql = "SELECT ref_menu.id_menu, nama_menu, link
				FROM ref_menu
				LEFT JOIN ref_group_menu ON ref_group_menu.id_menu = ref_menu.id_menu
				WHERE id_user_group = '".$user_id_group."' AND parrent = '".$id_parent."' ORDER BY urutan asc";
		$query = $CI->db->query($sql);
		return $query->num_rows();
    }

	function toogle2($id_parent){
		$CI =& get_instance();
		$sql = "SELECT *
				FROM ref_menu
				WHERE parrent = '".$id_parent."' ORDER BY urutan asc";
		$query = $CI->db->query($sql);
		return $query->num_rows();
    }


    function menu_json_format(){
		$CI =& get_instance();
		$menunav = '';
		$user_id = $CI->session->userdata('sesi_id');
		$sql = "SELECT * FROM ref_menu
				WHERE parrent = 0 ORDER BY urutan asc";
		$query = $CI->db->query($sql);
		$i=0;
		foreach($query->result_array() as $row)
		{
			if(toogle2($row['id_menu']) > 0){
				$data[]= array(
							'id_menu' => $row['id_menu'],
							'parrent' => $row['parrent'],
							'nama_menu' => $row['nama_menu'],
							'link' => $row['link'],
							'class_active' => $row['class_active'],
							'icon' => $row['icon'],
							'child' =>formatTree2($row['id_menu'])
							);
			}else{
				$data[]= array(
							'id_menu' => $row['id_menu'],
							'parrent' => $row['parrent'],
							'nama_menu' => $row['nama_menu'],
							'link' => $row['link'],
							'class_active' => $row['class_active'],
							'icon' => $row['icon']
							);
			}
			$i++;
		}

		return $data;
	}

function decode_role($string=NULL) {

	$role_return['update'] = "FALSE";
	$role_return['insert'] = "FALSE";
	$role_return['delete'] = "FALSE";
	$role_return['view'] = "FALSE";
	$role_return['print'] = "FALSE";

	$role_array = str_split($string);
	foreach ($role_array as $key => $value) {
		switch ($value) {
		    case "C":
				$role_return['insert'] = "TRUE";
			break;
		    case "U":
				$role_return['update'] = "TRUE";
			break;
		    case "D":
				$role_return['delete'] = "TRUE";
			break;
			case "V":
				$role_return['view'] = "TRUE";
			break;
			case "P":
				$role_return['print'] = "TRUE";
			break;
		    default:
				"";
		}

	}
	return $role_return;
}

function get_role($iduser, $action = null) {
	$CI =& get_instance();
	$link = $CI->uri->segment(1);
	$link2 = $CI->uri->segment(2);
	// var_dump($link2);
	$setLink = "";
	if ($link2 == NULL && $link2 == '') {
		$setLink = $link;
	} else {
		$setLink = $link.'/'.$link2;
	}
	$idmenu = $CI->db->query("SELECT id_menu from ref_menu where link = '".$setLink."'")->row();
	if (isset($idmenu->id_menu)) {
		$idmenu = $idmenu->id_menu;
		$query = $CI->db->query("SELECT role from ref_group_menu
			WHERE id_user_group = '".$iduser."'
				AND id_menu = '".$idmenu."' ")->row();
		// var_dump($iduser);
		if ($query != NULL) {
			$data = decode_role($query->role);
			if ($action == null) {
				return $data;
			} else {
				permission_role($query->role,$action);
			}
		}
	}
}


function permission_role($role, $action) {
	switch ($action) {
		case 'insert':
		$find   = 'C';
		break;

		case 'update':
		$find   = 'U';
		break;

		case 'delete':
		$find   = 'D';
		break;

		default:
		$find	 = 'ZZ';
		break;
		}
		$pos = strpos($role, $find);
		if ($pos === false) {
			echo "Oops, You dont have permissions giving action '".strtoupper($action)."' into this page. please <a href=".base_url().">back now!</a>";
			exit();
		} else {
			return TRUE;
		}
}

function check_absens($ar=NULL,$rr=NULL,$ay=NULL)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "http://absensi.setjen.kemendagri.go.id:8090/esidik/api/getdata/datastatus/03fc446b68863e0707aae41828adba10/".$ar."/".$rr."/".$ay,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET"
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  return "cURL Error #:" . $err;
	} else {
	  return json_decode($response, TRUE);
	}
}

function getRangeTanggal($first,$last)
{
	$period = new DatePeriod(new DateTime($first),new DateInterval('P1D'),new DateTime($last)); $tggl = "";
	foreach ($period as $key => $value) { $tggl .= $value->format('Y-m-d').','; }
	return explode(',', substr($tggl, 0,strlen($tggl)-1));
}

function create_time_range($start, $end, $interval = '1 mins', $format = '24') {
    $startTime = strtotime($start);
    $endTime   = strtotime($end);
    $returnTimeFormat = ($format == '24')?'G:i':'G:i';

    $current   = time();
    $addTime   = strtotime('+'.$interval, $current);
    $diff      = $addTime - $current;

    $times = array();
    while ($startTime < $endTime) {
        $times[] = date($returnTimeFormat, $startTime);
        $startTime += $diff;
    }
    $times[] = date($returnTimeFormat, $startTime);
    return $times;
}

?>
