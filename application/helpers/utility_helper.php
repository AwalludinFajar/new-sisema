<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  	
	/*****************************************	
	Format Tanggal Indonesia Lengkap dengan Hari
	from 	: 2015-02-12
	to 		: Kamis, 12 Februari 2015
	*****************************************/
	function indo_date($date) { 
		if (trim($date) != '' AND $date != '0000-00-00') {
			$newdate = new DateTime($date);
			$pcs = explode("-", $date);
			$y = $newdate->format('Y');
			$m = $newdate->format('n');
			$d = $newdate->format('j');
			$wk = $newdate->format('w');
			
			$getbulan = array ();
			$getbulan[1] = 'Januari';
			$getbulan[2] = 'Februari';
			$getbulan[3] = 'Maret';
			$getbulan[4] = 'April';
			$getbulan[5] = 'Mei';
			$getbulan[6] = 'Juni';
			$getbulan[7] = 'Juli';
			$getbulan[8] = 'Agustus';
			$getbulan[9] = 'September';
			$getbulan[10] = 'Oktober';
			$getbulan[11] = 'November';
			$getbulan[12] = 'Desember';

			$gethari = array ();
			$gethari[0] = 'Minggu';
			$gethari[1] = 'Senin';$gethari[2] = 'Selasa';$gethari[3] = 'Rabu';
			$gethari[4] = 'Kamis';$gethari[5] = 'Jumat';$gethari[6] = 'Sabtu';

			return $gethari[$wk]. ", ". $d ." ". $getbulan[$m] ." ". $y;
		}
	}
	
	/*****************************************	
	Konversi Tanggal Indosesia ke Tanggal Inggris
	from 	: 13-02-2015
	to 		: 2015-02-13
	*****************************************/
	function tgl_ind_to_eng($tgl) {
		$xreturn_ = '';
		if (trim($tgl) != '' && $tgl != '00-00-0000') {
			$tgl_eng=substr($tgl,6,4)."-".substr($tgl,3,2)."-".substr($tgl,0,2);
			$xreturn_ = $tgl_eng;
		}
		return $xreturn_;
	}

	/*****************************************	
	Konversi Tanggal Inggris ke Tanggal Indonesia
	from 	: 2015-02-13
	to 		: 13-02-2015
	*****************************************/
	function tgl_eng_to_ind($tgl) {
		$xreturn_ = '';
		if (trim($tgl) != '' AND $tgl != '0000-00-00') { 
			$tgl_ind=substr($tgl,8,2)."-".substr($tgl,5,2)."-".substr($tgl,0,4);
			$xreturn_ = $tgl_ind;
		}
		return $xreturn_;
	}
	
	/*****************************************	
	Konversi Tanggal dari text ke tgl
	from 	: 13022015
	to 		: 13/02/2015
	*****************************************/
	function text_to_tgl($tgl) {
		$xreturn_ = '';
		if (strlen($tgl) == 8) {
			$tgl_eng=substr($tgl,0,2).'/'.substr($tgl,2,2).'/'.substr($tgl,4,4);
			$xreturn_ = $tgl_eng;
		}else if(strlen($tgl) == 6) {
			$tgl_eng='00/'.substr($tgl,0,2).'/'.substr($tgl,2,4);
			$xreturn_ = $tgl_eng;
		}else if (strlen($tgl) == 4) {
			$tgl_eng='00/00/'.substr($tgl,0,4);
			$xreturn_ = $tgl_eng;
		}
		return $xreturn_;
	}
	
	/*****************************************	
	Format Tanggal Indonesia Lengkap
	from 	: 2015-02-12
	to 		: 12 Februari 2015
	*****************************************/
	function format_date_ind($tgl,$param='long'){
		if (trim($tgl) != ''AND $tgl != '0000-00-00') {
			$d = substr($tgl,8,2);
			$m = substr($tgl,5,2);
			$y = substr($tgl,0,4);
			$getbulan = array ();
			$getbulan[1] = (($param=='short')?'Jan':'Januari');
			$getbulan[2] = (($param=='short')?'Feb':'Februari');
			$getbulan[3] = (($param=='short')?'Mart':'Maret');
			$getbulan[4] = (($param=='short')?'Apr':'April');
			$getbulan[5] = (($param=='short')?'Mei':'Mei');
			$getbulan[6] = (($param=='short')?'Jun':'Juni');
			$getbulan[7] = (($param=='short')?'Jul':'Juli');
			$getbulan[8] = (($param=='short')?'Agst':'Agustus');
			$getbulan[9] = (($param=='short')?'Sept':'September');
			$getbulan[10] = (($param=='short')?'Okt':'Oktober');
			$getbulan[11] = (($param=='short')?'Nov':'November');
			$getbulan[12] = (($param=='short')?'Des':'Desember');
			$tanggal = $d." ".$getbulan[(int)$m]." ".$y;
			return $tanggal ;
		}
	}
	
	/*****************************************	
	Nama Bulan Indonesia 
	from 	: 01 atau 1
	to 		: Januari
	*****************************************/
	function nama_bulan($m){
		if (trim($m) != '' AND $m != '0') {
			$getbulan = array ();
			$getbulan[1] = 'Januari';
			$getbulan[2] = 'Februari';
			$getbulan[3] = 'Maret';
			$getbulan[4] = 'April';
			$getbulan[5] = 'Mei';
			$getbulan[6] = 'Juni';
			$getbulan[7] = 'Juli';
			$getbulan[8] = 'Agustus';
			$getbulan[9] = 'September';
			$getbulan[10] = 'Oktober';
			$getbulan[11] = 'November';
			$getbulan[12] = 'Desember';
			
			return $getbulan[(int)$m];
		}
	}
	
	/*****************************************	
	Menambahkan Tanggal perhari, perbulan atau pertahun 
	from 	: 2015-01-01 00:00:00 ditambahkan 3 hari
	to 		: 2015-01-04 00:00:00
	format fungsi (tanggal, tambah hari, tambah bulan, tambah tahun)
	*****************************************/
	function add_date($givendate,$day=0,$mth=0,$yr=0) {
		$cd = strtotime($givendate);
		$newdate = date('Y-m-d H:i:s', mktime(date('h',$cd),
		date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
		date('d',$cd)+$day, date('Y',$cd)+$yr));
		return $newdate;
    }
	
	/*****************************************	
	Menjumlahkan Hari dalam Tahun
	$d1 	: tanggal akhir (2015-05-23)
	$d2 	: tanggal awal (2015-01-22)
	hasil	: array();
	*****************************************/
	function date_diff_custom($d1, $d2){
		$d1 = (is_string($d1) ? strtotime($d1) : $d1);
		$d2 = (is_string($d2) ? strtotime($d2) : $d2);
		$diff_secs = abs($d1 - $d2);
		$base_year = min(date("Y", $d1), date("Y", $d2));
		$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
		return array(
			"years" => date("Y", $diff) - $base_year,
			"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
			"months" => date("n", $diff) - 1,
			"days_total" => floor($diff_secs / (3600 * 24)),
			"days" => date("j", $diff) - 1,
			"hours_total" => floor($diff_secs / 3600),
			"hours" => date("G", $diff),
			"minutes_total" => floor($diff_secs / 60),
			"minutes" => (int) date("i", $diff),
			"seconds_total" => $diff_secs,
			"seconds" => (int) date("s", $diff)
		);
	}
	
	// // untuk handle single or double quotes
	// function quotes_cek($string)
	// {
	// 	$value = trim($string);

	// 	if (get_magic_quotes_gpc()) {
	// 		$value = stripslashes($value);
	// 	}
	// 	// Quote if not integer
	// 	if (!is_numeric($value)) {
	// 		$value = mysql_real_escape_string($value);
	// 	}
	// 	return $value;
	// }
	
	/*****************************************	
	Menentukan selisih tanggal dlaam hitungan detik
	$d1 	: tanggal akhir (2015-05-23)
	$d2 	: tanggal awal (2015-01-22)
	hasil	: nilai dalam detik
	*****************************************/
	function tanggal_detik($d1, $d2){
		$d1 = (is_string($d1) ? strtotime($d1) : $d1);
		$d2 = (is_string($d2) ? strtotime($d2) : $d2);
		$diff_secs = abs($d1 - $d2);
		return $diff_secs;
	}
	
	/*****************************************	
	Menentukan selisih tanggal dalah hari
	$tgl1 	: tanggal awal (2015-01-22)
	$tgl2 	: tanggal akhir (2015-05-23)
	hasil	: jml hari
	*****************************************/
	function selisihHari($tgl1,$tgl2)
	{
		$pecah1 = explode("-", $tgl1);
		$date1 = $pecah1[2];
		$month1 = $pecah1[1];
		$year1 = $pecah1[0];
		
		$pecah2 = explode("-", $tgl2);
		$date2 = $pecah2[2];
		$month2 = $pecah2[1];
		$year2 =  $pecah2[0];
		
		$jd1 = GregorianToJD($month1, $date1, $year1);
		$jd2 = GregorianToJD($month2, $date2, $year2);
		
		$selisih = $jd2 - $jd1;
		return $selisih;
	}
	
	/*****************************************	
	Menentukan Kode Hari
	$date 	: 2015-01-22
	hasil	: 4
	*****************************************/
	function kode_hari($date) { //reformat from yyyy-mm-dd to dd mon yyyy
		
		$newdate = new DateTime($date);
		$wk = $newdate->format('w');

		return $wk;
	}
	
	function nama_hari($tgl=0) { 
		
		$hari = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');

		return $hari[$tgl];
	}
	
	/*****************************************	
	Menentukan tanggal akhir pada tiap bulan 
	*****************************************/
	function tgl_akhir($bulan,$tahun)
	{
		if($bulan=='1' || $bulan=='3' || $bulan=='5' || $bulan=='7' || $bulan=='8' || $bulan=='10' || $bulan=='12')
		{
			$tgl = '31';
		}else if ($bulan=='2'){
			if($tahun%4==0){
				$tgl = '29';
			}else{
				$tgl = '28';
			}
		}else{
			$tgl='30';
		}
		return $tgl;
	}
	
	/*****************************************	
	Menentukan selisih antar waktu
	$time1 	: waktu akhir (10:00:00)
	$time2 	: waktu awal (09:30:00)
	hasil	: 00:30:00
	*****************************************/
	function selisih($time1 = '', $time2 = '') {
		$buffer1 = explode(":", $time1);
		$buffer2 = explode(":", $time2);
		$t1 = ((3600 * (int)$buffer1[0]) + (60 * (int)$buffer1[1]) + (int)$buffer1[2]) ;
		$t2 = ((3600 * (int)$buffer2[0]) + (60 * (int)$buffer2[1]) + (int)$buffer2[2]) ;
		$s = $t1 - $t2;
		if($s < 60){
			return '00:00:'.(($s<=9)?'0'.$s:$s);
		}else if ($s >= 60 && $s < 3600){
			$m = $s%60;
			if($m==0){
				$m2 = $s/60;
				return '00:'.(($m2<=9)?'0'.$m2:$m2).':00';
			}else{
				$m2 = ($s - $m)/60;
				return '00:'.(($m2<=9)?'0'.$m2:$m2).':'.(($m<=9)?'0'.$m:$m);
			}
		}else{
			$j = $s%3600;
			if($j==0){
				return (($j<=9)?'0'.$j:$j).':00:00';
			}else{
				if($j >= 60){
					$j2 = ($s-$j) / 3600;
					$m = $j%60;
					if($m==0){
						$m2 = $j/60;
						return (($j2<=9)?'0'.$j2:$j2).':'.(($m2<=9)?'0'.$m2:$m2).':00';
					}else{
						$m2 = ($j - $m)/60;
						return (($j2<=9)?'0'.$j2:$j2).':'.(($m2<=9)?'0'.$m2:$m2).':'.(($m<=9)?'0'.$m:$m);
					}
				}else{
					$j2 = ($s-$j) / 3600;
					return (($j2<=9)?'0'.$j2:$j2).':00:'.(($j<=9)?'0'.$j:$j);
				}
			}
		}
	}
	
	/*****************************************	
	Menentukan selisih antar waktu dalam detik
	$time1 	: waktu akhir (10:00:00)
	$time2 	: waktu awal (09:30:00)
	hasil	: 1800 detik
	*****************************************/
	function ambil_detik($time1 = '',$time2 = '') {
		$buffer1 = explode(":", $time1);
		$buffer2 = explode(":", $time2);
		$t1 = ((3600 * (int)$buffer1[0]) + (60 * (int)$buffer1[1]) + (int)$buffer1[2]) ;
		$t2 = ((3600 * (int)$buffer2[0]) + (60 * (int)$buffer2[1]) + (int)$buffer2[2]) ;
		$s = $t1 - $t2;
		return $s;
	}
	
	/*****************************************	
	Menentukan jam dalam detik
	$s 	: jumlah detik (3600)
	hasil	: 01:00:00
	*****************************************/
	function ambil_jam($s = 0) {
		if($s < 60){
			return '00:00:'.(($s<=9)?'0'.$s:$s);
		}else if ($s >= 60 && $s < 3600){
			$m = $s%60;
			if($m==0){
				$m2 = $s/60;
				return '00:'.(($m2<=9)?'0'.$m2:$m2).':00';
			}else{
				$m2 = ($s - $m)/60;
				return '00:'.(($m2<=9)?'0'.$m2:$m2).':'.(($m<=9)?'0'.$m:$m);
			}
		}else{
			$j = $s%3600;
			if($j==0){
				return (($j<=9)?'0'.$j:$j).':00:00';
			}else{
				if($j >= 60){
					$j2 = ($s-$j) / 3600;
					$m = $j%60;
					if($m==0){
						$m2 = $j/60;
						return (($j2<=9)?'0'.$j2:$j2).':'.(($m2<=9)?'0'.$m2:$m2).':00';
					}else{
						$m2 = ($j - $m)/60;
						return (($j2<=9)?'0'.$j2:$j2).':'.(($m2<=9)?'0'.$m2:$m2).':'.(($m<=9)?'0'.$m:$m);
					}
				}else{
					$j2 = ($s-$j) / 3600;
					return (($j2<=9)?'0'.$j2:$j2).':00:'.(($j<=9)?'0'.$j:$j);
				}
			}
		}
	}
	
	/*****************************************	
	Menentukan umur usia
	$tgl1 	: tanggal akhir (2015-03-03)
	$tgl2 	: tanggal awal (2000-03-03)
	hasil	: array(tahun, bulan, hari)
	*****************************************/
	function hitung_umur($tgl1,$tgl2) { //(tanggal sekarang, tanggal sebelumnya)
		$thn1=substr($tgl1,0,4);
		$bln1=substr($tgl1,5,2);
		$hr1=substr($tgl1,8,2);
		$thn2=substr($tgl2,0,4);
		$bln2=substr($tgl2,5,2);
		$hr2=substr($tgl2,8,2);
		$tahun=$thn1-$thn2;
		if ($bln1<$bln2){
			$tahun=$tahun-1;
			$bulan=((int)$bln1+12)-(int)$bln2;
			if ($hr1 < $hr2){
				$bulan=$bulan-1;
				$shr = ((int)$hr2 - (int)$hr1);
				if($shr==30){ $shr = 29;}
				$hari = 30 - $shr;
			}else{
				$hari = (int)$hr1 - (int)$hr2; 
			}
		}else if($bln1==$bln2){
			$bulan=(int)$bln1-(int)$bln2;
			if ($hr1 < $hr2){
				$tahun=$tahun-1;
				$bulan=11;
				$shr = ((int)$hr2 - (int)$hr1);
				if($hr2==31)$hari = 31 - $shr;
				else $hari = 30 - $shr;
			}else{
				$hari = (int)$hr1 - (int)$hr2; 
			}
		}else{
			$bulan=$bln1-$bln2;
			if ($hr1 < $hr2){
				$bulan=$bulan-1;
				$shr = ((int)$hr2 - (int)$hr1);
				if($hr2==31)$hari = 31 - $shr;
				else $hari = 30 - $shr;
			}else{
				$hari = (int)$hr1 - (int)$hr2; 
			}
		}
		
		$hasil = array(
				'tahun' => $tahun,
				'bulan' => $bulan,
				'hari' => $hari
				);
		return $hasil;
	}
	
	/*****************************************	
	Menentukan file extension
	*****************************************/
	function filename_extension($filename) {
		$pos = strrpos($filename, '.');
		if($pos===false) {
			return false;
		} else {
			return strtolower(substr($filename, $pos+1));
		}
	}
	
	/****************************************************	
	fungsi parameter untuk mengenerate huruf dalam angka
	****************************************************/
	function kekata($x) {
		$x = abs($x);
		$angka = array("", "satu", "dua", "tiga", "empat", "lima",
		"enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($x <12) {
			$temp = " ". $angka[$x];
		} else if ($x <20) {
			$temp = kekata($x - 10). " belas";
		} else if ($x <100) {
			$temp = kekata($x/10)." puluh". kekata($x % 10);
		} else if ($x <200) {
			$temp = " seratus" . kekata($x - 100);
		} else if ($x <1000) {
			$temp = kekata($x/100) . " ratus" . kekata($x % 100);
		} else if ($x <2000) {
			$temp = " seribu" . kekata($x - 1000);
		} else if ($x <1000000) {
			$temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
		} else if ($x <1000000000) {
			$temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
		} else if ($x <1000000000000) {
			$temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
		} else if ($x <1000000000000000) {
			$temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
		}      
        return $temp;
	}
	
	/*****************************************	
	Konversi angka ke huruf
	from	: 2000
	to		: dua ribu
	*****************************************/
	function terbilang($x, $style=4) {
		if($x<0) {
			$hasil = "minus ". trim(kekata($x));
		} else {
			$hasil = trim(kekata($x));
		}      
		switch ($style) {
			case 1:
				$hasil = strtoupper($hasil);
				break;
			case 2:
				$hasil = strtolower($hasil);
				break;
			case 3:
				$hasil = ucwords($hasil);
				break;
			default:
				$hasil = ucfirst($hasil);
            break;
		}      
		return $hasil;
	}
	
	/*****************************************	
	Menentukan dan mencari abjad dalam kata
	tujuan	: untuk menentukan hak akses page
	*****************************************/
	function aksiPermis($kata,$abjad)
	{
		$pos = strpos($kata,$abjad);
		if($pos === false){
			$hasil = '';
		}else{
			$hasil = $abjad;
		}
		
		return $hasil;
	}
	
	/*****************************************	
	Menentukan hak akses page per user
	*****************************************/
	function akses($url,$user,$abjad)
	{
		$CI =& get_instance();
		$sql = "select a.akses
				from tb_group_menu a
				left join tb_menu b
				on (a.id_menu = b.id_menu)
				where a.id_user_group = $user
				and b.link = '$url' and b.status=1
				";
		$query = $CI->db->query($sql);
		$kata ='';
		if($query->num_rows() > 0){
			$field = $query->row_array();
			$kata = $field['akses'];
		}
		
		$pos = strpos($kata,$abjad);
		$hasil='';
		if($pos === false){
			$hasil = '';
		}else{
			$hasil = $abjad;
		}
		
		return $hasil;
	}
	
	/*****************************************	
	Menampilkan data pada tabel yang dipilih
	*****************************************/
	function getValue($select,$from,$where)
	{
		$CI =& get_instance();
		$sql = "select ".$select." as nm_field from ".$from." where ".$where;
		$query = $CI->db->query($sql);
		$hasil ='';
		if($query->num_rows() > 0){
			$field = $query->row_array();
			$hasil = $field['nm_field'];
		}
		return $hasil;
	}
	
	/*****************************************	
	Mengambil IP Address
	*****************************************/
	function getRealIpAddr()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	
	/*****************************************	
	Megecek data ada atau tidak dalam tabel
	*****************************************/
	function getCount($from,$where)
	{
		$CI =& get_instance();
		$sql = "select count(*) as jml from ".$from." where ".$where;
		//echo $sql;
		$query = $CI->db->query($sql)->row();
		return $query->jml;
	} 

	function tombolPrint($url,$levelAkses,$nip)
	{
		// cek tb_menu.status url aktif/tidak aktif?		
		// lalu apakah sudah tercatat di tb_group_menu atau tidak?		
		$tombolHtml = '';		
		if (akses($url,$levelAkses,'P') == 'P' ) {			
			$tombolHtml = '
				<span class="btn btn-success btn-mini" onClick="print_report(\''. $nip.'\')">
					<i class="fa fa-print"></i> Cetak Biodata
				</span>';
		}
		return $tombolHtml;
	}

	function log_history($aksi,$tabel,$data,$nip,$nosandi=1)
	{
		$CI =& get_instance();
		$user = $CI->session->userdata('s_username');
		$ip = $CI->session->userdata('ip_address').' | '.$CI->session->userdata('user_agent');
		$APR = getCount("tr_hak_approve","level='".$CI->session->userdata('s_access')."'");
		$kunker = getValue("kunker","peg_tkerja","nip='".$CI->session->userdata('s_employee')."'");
		if($APR > 0){
			$dataIn = array(
						'kode_user' => $user,
						'nourut' => $nosandi,
						'tab_update' => $tabel,
						'stat_update' => $aksi,
						'kol_update' => (($data=='' || $data==null)?'':json_encode($data)),
						'tgl_update' => date('Y-m-d H:i:s'),
						'data_update' => $nip,
						'nama_update' => getValue("concat(if(((trim(gldepan) = '') or isnull(gldepan)),'',concat(gldepan,'. ')),nama,concat(if(((trim(glblk) = '') or isnull(glblk)),'',concat(', ',glblk))))","peg_identpeg","nip='".$nip."'"),
						'catatan' => $kunker,
						'tgl_rubah' =>  date('Y-m-d H:i:s'),
						'user_rubah' => $user
					);
			$CI->db->insert('tt_userevent',$dataIn);
		}else{
			$dataIn = array(
						'kode_user' => $user,
						'nourut' => $nosandi,
						'tab_update' => $tabel,
						'stat_update' => $aksi,
						'kol_update' => (($data=='' || $data==null)?'':json_encode($data)),
						'tgl_update' => date('Y-m-d H:i:s'),
						'data_update' => $nip,
						'nama_update' => getValue("concat(if(((trim(gldepan) = '') or isnull(gldepan)),'',concat(gldepan,'. ')),nama,concat(if(((trim(glblk) = '') or isnull(glblk)),'',concat(', ',glblk))))","peg_identpeg","nip='".$nip."'"),
						'catatan' => $kunker
					);
			$CI->db->insert('tt_userevent',$dataIn);
		}
	}
	
	function genFormatPK ($seqid, $fmt, $yr=0)
	{
		if ( $yr == 0) $yr4 = date('Y');
		if ( $yr == 0) $yr = date('y');
		$seq = nextSequence ($seqid, $yr);
		
		$ret = str_replace ('$y', $yr, $fmt);
		$ret = str_replace ('$Y', $yr4, $ret);
		$ret = str_replace ('$m', date('m'), $ret);
		
		$pos = strpos ( $ret, '$s');
		if ( $pos === false )
			return $ret;
			
		$num = (int) (substr ( $ret, $pos+2, 1));
		if ( $num > 0 ) {
			$strnum = substr ('0000000000' . $seq, -($num));
			$ret = str_replace ('$s'.$num, $strnum, $ret);
		}
		else
			$ret = str_replace ('$s', $seq, $ret);
		return $ret;
	}
	
	function nextSequence ( $seqid, $yr=0 )
	{
		$CI =& get_instance();
		if ( $yr == 0) $yr = date('y');
		$sql = "select no from tt_seq where year = $yr and seq_id = '$seqid'";
		$res = $CI->db->query($sql);
		
			
		$id = $res->num_rows();
		if ($id > 0) {
			$row = $res->row_array();
			$sql = "update tt_seq set no = no + 1 where year = $yr and seq_id = '$seqid'";
			$res = $CI->db->query($sql);
			return $row['no'];
		} 
		else {
			$sql = "insert into tt_seq (seq_id, year, no, descr) values (
						'$seqid', $yr, 2, 'generated')";
			//echo $sql; die;
			$CI->db->query($sql);
			return 1;
		} 
	}
	
	function getTemporary($table,$data,$where,$nosandi,$aksi)
	{
		$CI =& get_instance();
		if($aksi=='U'){
			$syntax = "UPDATE ".$table." SET ";
			$i=1;
			foreach($data as $key => $value){
				$syntax .= $key." = `".str_replace("'","\'",$value)."`".(($i==count($data))?'':', ');
				$i++;
			}
			$syntax .= " WHERE ".str_replace("'","\'",$where);
		}
		
		if($aksi=='A'){
			$syntax = "INSERT INTO ".$table;
			$i=1;
			$field='';
			$val='';
			foreach($data as $key => $value){
				$field .= (($i==1)?'(':'').$key.(($i==count($data))?')':', ');
				$val .= (($i==1)?'(':'').'`'.str_replace("'","\'",$value).'`'.(($i==count($data))?')':', ');
				$i++;
			}
			$syntax .= " ".$field." VALUES ".$val ;
		}
		
		$data['optr_id'] = $CI->session->userdata('s_username');
		$data['dedit'] = date('Y-m-d H:i:s');
		$data['opr'] = $aksi;
		$data['flag'] = 'N';
		$data['approve'] = null;
		$data['dapprove'] = null;
		$data['syntax'] = $syntax;
		$data['nosandi'] = $nosandi;
		$CI->db->insert('temp_'.$table,$data);
		
		$isian = getValue("nip","peg_approve", "nip='".$data['nip']."'" );
		if ($isian==''){
			$peg_Appr = " insert into peg_approve(nip,nilai,user) values ('".$data['nip']."','1','".$CI->session->userdata('s_username')."')";
			$CI->db->query($peg_Appr) ;
		} else {
			$peg_Appr = " update peg_approve set nilai = nilai + 1, user = '".$CI->session->userdata('s_username')."' where nip = '".$data['nip']."' ";
			$CI->db->query ($peg_Appr) ;
		}
	}
	
	function ambil_data($nip,$nosandi,$tab_update)
	{
		$CI =& get_instance();
		$sql = "select kol_update from tt_userevent where nourut='".$nosandi."' and tab_update='".$tab_update."'";
		$query = $CI->db->query($sql);
		$hasil='';
		if($query->num_rows() > 0){
			$field = $query->row_array();
			$hasil = str_replace('","','", "',$field['kol_update']);
		}
		
		return $hasil;
	}
	
	function nama_unit($kunker)
	{
		$ci =& get_instance();
		$data = $ci->db->query("select nunker from ref_unkerja where kunker = '".$kunker."'")->row_array();
		return $data['nunker'];
	}
	
	function alfabet($num)
	{
		$alfa = array( 1 => "A","B","C","D","E","F","G","H","I","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","p","q","r","s","t","u","v","w","x","y","z");
		
		return $alfa[$num];
	
	}
	
	function data_background($nama)
	{
		$CI =& get_instance();
		$sql = "select * from tb_background LIMIT 1";
		$query = $CI->db->query($sql);
		$hasil='';
		if($query->num_rows() > 0){
			$field = $query->row_array();
			$hasil = $field[$nama];
		}
		
		return $hasil;
	}

	function send_sms($pesan,$telp_pengguna){
		$CI =& get_instance();
      	$CI->db->where('sms', 'Y');
      	$data_sms = $CI->db->get('ref_setting_sms_email');

		$pesan        = rawurlencode($pesan);
  		if( $data_sms->num_rows() > 0  ){
  		  	$file_content = file_get_contents("http://60.253.116.68:8018/mysms/sms.php?number=$telp_pengguna&msg=$pesan&cid=hibah-bansos");
      	}

    	return true;
      
	}
	
?>