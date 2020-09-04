<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * 
	 */
	class M_report extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function report_ceklis_data($value='')
		{
			$where = "";
			if ($value == '') {	$where = ""; } else { $where = " WHERE rk.KodeMAK = '".$value."'"; }
			$sql = "SELECT rk.KodeMAK,ck.TypeTrans,ck.NIP,ck.Nama_peg,ck.TanggalAwal,ck.TanggalAkhir,ck.JamAwal,ck.JamAkhir,rk.Uraian
					FROM ark_trx_checklist ck
					LEFT JOIN ark_mst_rkakl rk ON ck.RKAKLID = rk.RKAKLID".$where;
			$query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		public function list_bagian($value='')
		{
			$this->db->order_by('BagianID','asc');
   			$query = $this->db->get('ref_bagian');
   			return $query->result();
		}

		public function getrkidfrom($gia,$va,$lu,$ue,$nya,$ha)
		{
			$sq_dr_rencana="SELECT a.RKAKLID FROM ".$ha." a 
							JOIN ark_mst_rkakl b ON a.RKAKLID = b.RKAKLID
							JOIN ark_mst_rkakl_perbagian o ON b.RKAKLID = o.RKAKLID 
							WHERE b.KodeMAK = '".$va."' 
							AND SUBSTRING(a.".$nya.",6,2)=".$lu." 
							AND SUBSTRING(a.".$nya.",1,4)=".$ue." 
							AND o.BagianID = ".$gia."
							GROUP BY a.RKAKLID";
			$query = $this->db->query($sq_dr_rencana);
			if($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		public function bulan_bulan($value='')
		{
			function cmmp($a, $b) {
				if ($a == $b) { return 0; }
	    		return ($a < $b) ? -1 : 1;
			}
			$morn = "SELECT a.* FROM (SELECT SUBSTR(Tglrencana,6,2) AS cdn FROM ark_trx_anggaran) a GROUP BY a.cdn";
			$morl = "SELECT a.* FROM (SELECT SUBSTR(Tglrealisasi,6,2) AS cdn FROM ark_trx_anggarandetail) a GROUP BY a.cdn";
			$query_rencana = $this->db->query($morn)->result();
			$query_realisasi = $this->db->query($morl)->result();
			$unt = array();
			foreach ($query_rencana as $key => $value) { $unt[] = $value->cdn; }
			foreach ($query_realisasi as $key => $va) { $unt[] = $va->cdn; }
			usort($unt, "cmmp");
			$xx = ""; foreach ($unt as $key => $value) { $xx .= $value.","; }
			$gup = explode(',', substr($xx, 0,strlen($xx)-1));
			$has = "";
			for ($i=0; $i < count($gup); $i++) { 
				if ($gup[$i] != $gup[$i+1]) { $has .= $gup[$i].','; }
				error_reporting(0);
			}
			$exlp = explode(',', substr($has, 0,strlen($has)-1));
			return $exlp;
		}
		

		public function report_anggaran($value='')
		{
			function cmp($a, $b) {
				if ($a == $b) { return 0; }
	    		return ($a < $b) ? -1 : 1;
			}
			$morn = "SELECT a.* FROM (SELECT SUBSTR(Tglrencana,6,2) AS cdn FROM ark_trx_anggaran) a GROUP BY a.cdn";
			$morl = "SELECT a.* FROM (SELECT SUBSTR(Tglrealisasi,6,2) AS cdn FROM ark_trx_anggarandetail) a GROUP BY a.cdn";
			$query_rencana = $this->db->query($morn)->result();
			$query_realisasi = $this->db->query($morl)->result();

			$unt ="";
			foreach ($query_rencana as $key => $value) { $unt .= $value->cdn.','; }
			foreach ($query_realisasi as $key => $va) { $unt .= $va->cdn.','; }
			$rray = explode(',', substr($unt, 0,strlen($unt)-1));
			usort($rray, "cmp");
			$xx = ""; foreach ($rray as $key => $value) { $xx .= $value.","; }
			$gup = explode(',', substr($xx, 0,strlen($xx)-1));
			$has = "";
			for ($i=0; $i < count($gup); $i++) { 
				if ($gup[$i] != $gup[$i+1]) { $has .= $gup[$i].','; }
				error_reporting(0);
			}
			$exlp = explode(',', substr($has, 0,strlen($has)-1));
			$kz = ""; $ku = ""; $kp = "";
			for ($i=0; $i < count($exlp); $i++) { 
				$kz .= "SUM(IF(".$exlp[$i]." = SUBSTR(Tglrencana,6,2),Nilai_rencana,0)) AS rencana".$exlp[$i].",";
				$ku .= "SUM(IF(".$exlp[$i]." = SUBSTR(Tglrealisasi,6,2),Nilai_realisasi,0)) AS realisasi".$exlp[$i].",";
				$kp .= "d.rencana".$exlp[$i].",((a.Jumlah/100)/(d.rencana".$exlp[$i]."/100))*100 AS presentase_rencana".$exlp[$i].",";
				$kp .= "e.realisasi".$exlp[$i].",((a.Jumlah/100)/(e.realisasi".$exlp[$i]."/100))*100 AS presentase_realisasi".$exlp[$i].",";
			}

			$gtkd = substr($kz, 0,strlen($kz)-1);
			$gtko = substr($ku, 0,strlen($ku)-1);
			$gtke = substr($kp, 0,strlen($kp)-1);

			$sql = "SELECT a.KodeMAK,a.Uraian,a.VolumeKegiatan,a.Satuan,a.HargaSatuan,a.Jumlah,c.Nama_bagian,".$gtke."
					FROM ark_mst_rkakl a 
					JOIN ark_mst_rkakl_perbagian b ON a.RKAKLID = b.RKAKLID
					JOIN ref_bagian c ON b.BagianID = c.BagianID
					LEFT JOIN (SELECT RKAKLID,Tglrencana,".$gtkd." FROM ark_trx_anggaran) d ON a.RKAKLID = d.RKAKLID
					LEFT JOIN (SELECT RKAKLID,Tglrealisasi,".$gtko." FROM ark_trx_anggarandetail) e ON a.RKAKLID = e.RKAKLID";
			// var_dump($sql); die();
			$query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		public function report_anggaran_data($value='')
		{
			$where = "";
			if ($value == '') {	
				$where = ""; 
			} else { 
				$isit = explode('a', $value);
				if (count($isit) > 2) {
					$msp = substr($value, 1,strlen($isit)-1);
					$where = " WHERE dta.RKAKLID IN (".$msp.")";
				} else {
					$where = " WHERE dta.RKAKLID = ".$isit[0];
				} 
			}
			$sql = "SELECT l.*, o.Nama, o.Warna FROM (
					 SELECT dta.*, (dta.a+dta.b) AS c, (dta.Jumlah-(dta.a+dta.b)) AS d, ((dta.Jumlah-(dta.a+dta.b))/dta.Jumlah*100) AS e,
					 IF(((dta.Jumlah-(dta.a+dta.b))/dta.Jumlah*100) = 100, 1,  
					   IF((dta.a+dta.b) = dta.Jumlah, 3, 
					    IF((dta.a+dta.b) > dta.Jumlah, 4, 
					     IF((dta.a+dta.b) < dta.Jumlah, 2, 0)))) AS wrna 
					FROM (
					 SELECT rk.RKAKLID, rk.KodeMAK, rk.Uraian, bg.Nama_bagian, rk.Jumlah,
					  SUM(IF(SUBSTRING(ra.Tglrencana,6,2) < SUBSTRING(CURDATE(),6,2),ra.Nilai_rencana,IF(SUBSTRING(ra.Tglrencana,6,2) = 12,ra.Nilai_rencana,0))) AS a,
					  SUM(IF(SUBSTRING(ra.Tglrencana,6,2) = SUBSTRING(CURDATE(),6,2),ra.Nilai_rencana,0)) AS b 
					 FROM ark_trx_anggaran ra
					 JOIN ark_mst_rkakl rk ON ra.RKAKLID = rk.RKAKLID
					 JOIN ark_mst_rkakl_perbagian dw ON rk.RKAKLID = dw.RKAKLID
					 JOIN ref_bagian bg ON dw.Id_perbagian = bg.BagianID
					 GROUP BY rk.RKAKLID ) AS dta ".$where.") l
					 JOIN chart_parameter o ON l.wrna = o.idParameter ORDER BY l.RKAKLID";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		public function report_anggaran_data_nwe($value='')
		{
			$where = "";
			$where = "";
			if ($value == '') {	
				$where = ""; 
			} else { 
				$isit = explode('a', $value);
				if (count($isit) > 2) {
					$msp = substr($value, 1,strlen($isit)-1);
					$where = " WHERE dta.RKAKLID IN (".$msp.")";
				} else {
					$where = " WHERE dta.RKAKLID = ".$isit[0];
				} 
			}
			$sql = "SELECT l.*, o.Nama, o.Warna FROM ( 
					 SELECT  dta.*, (dta.a+dta.b) AS c, (dta.Jumlah-(dta.a+dta.b)) AS d, ((dta.Jumlah-(dta.a+dta.b))/dta.Jumlah*100) AS e,
					 IF((dta.a+dta.b) < dta.Jumlah, 2, 
					  IF((dta.a+dta.b) > dta.Jumlah, 4, 
					   IF((dta.a+dta.b) = dta.Jumlah, 3, 0))) AS wrna 
					FROM (
					 SELECT rk.RKAKLID, rk.KodeMAK, rk.Uraian, bg.Nama_bagian, rk.Jumlah,
					  SUM(IF(SUBSTRING(rs.Tglrealisasi,6,2) < SUBSTRING(CURDATE(),6,2),rs.Nilai_realisasi,IF(SUBSTRING(rs.Tglrealisasi,6,2) = 12,rs.Nilai_realisasi,0))) AS a,
					  SUM(IF(SUBSTRING(rs.Tglrealisasi,6,2) = SUBSTRING(CURDATE(),6,2),rs.Nilai_realisasi,0)) AS b
					 FROM ark_trx_anggarandetail rs
					 JOIN ark_mst_rkakl rk ON rs.RKAKLID = rk.RKAKLID
					 JOIN ark_mst_rkakl_perbagian dw ON rk.RKAKLID = dw.RKAKLID
					 JOIN ref_bagian bg ON dw.Id_perbagian = bg.BagianID
					 GROUP BY rk.RKAKLID ) AS dta ".$where.") l
					 JOIN chart_parameter o ON l.wrna = o.idParameter ";
			$query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		public function report_inventaris_barang($value='')
		{
			$sql = "SELECT v.*, f.Nama_bagian 
					FROM ref_mst_inventory_barang v 
					LEFT JOIN ref_bagian f ON v.id_bagian = f.BagianID";
   			$query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}
	}
?>