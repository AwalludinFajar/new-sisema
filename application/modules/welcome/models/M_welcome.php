<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * 
	 */
	class M_welcome extends CI_Model
	{
		
		function __construct()
		{
			parent::__construct();
		}

		public function data_chart($bagian='',$waktu='')
		{	
			$set1 = ""; $set2 = "";
			if ($bagian != '' || $waktu != '') { $set1 = $bagian; $set2 = $waktu; } else { $set1 = ""; $set2 = ""; }
			$sql = "SELECT 
					 da.waktu_rencana,
					 da.bulan, 
					 da.bagian,
					 da.rencanan AS Rencana, 
					 da.realisasi AS Realisasi, 
					 param_one.Nama AS status_realisasi, 
					 param_two.Nama AS status_rencana, 
					 param_one.Warna AS warna_realisasi, 
					 param_two.Warna AS warna_rencana 
					FROM (
					 SELECT 
					  rencana.Tglrencana AS waktu_rencana, 
					  bag.Nama_bagian AS bagian, 
					  MONTH(rencana.Tglrencana) AS bln_nu, 
					  MONTHNAME(rencana.Tglrencana) AS bulan, 
					  SUM(rkakl.Jumlah) AS nilai_pagu, 
					  IF(COUNT(rencana.Nilai_rencana) > 1, rencana.Nilai_rencana, SUM(rencana.Nilai_rencana)) AS rencanan, 
					  SUM(realisasi.Nilai_realisasi) AS realisasi, 
					  IF(SUM(realisasi.Nilai_realisasi) IS NULL, 1, 
					   IF(SUM(rkakl.Jumlah) > IF(COUNT(rencana.Nilai_rencana) > 1, rencana.Nilai_rencana, SUM(rencana.Nilai_rencana)), 2, 
					    IF(SUM(rkakl.Jumlah) = IF(COUNT(rencana.Nilai_rencana) > 1, rencana.Nilai_rencana, SUM(rencana.Nilai_rencana)), 3, 
					     IF(SUM(rkakl.Jumlah) < IF(COUNT(rencana.Nilai_rencana) > 1, rencana.Nilai_rencana, SUM(rencana.Nilai_rencana)), 4, NULL)))) AS status_rencana, 
					  IF(IF(COUNT(rencana.Nilai_rencana) > 1, rencana.Nilai_rencana, SUM(rencana.Nilai_rencana)) > SUM(realisasi.Nilai_realisasi), 2, 
					   IF(IF(COUNT(rencana.Nilai_rencana) > 1, rencana.Nilai_rencana, SUM(rencana.Nilai_rencana)) < SUM(realisasi.Nilai_realisasi), 4, 
					    IF(IF(COUNT(rencana.Nilai_rencana) > 1, rencana.Nilai_rencana, SUM(rencana.Nilai_rencana)) = SUM(realisasi.Nilai_realisasi), 3, 
					     IF(SUM(realisasi.Nilai_realisasi) IS NULL, 1, NULL)))) AS status_realisasi 
					 FROM 
					  ark_trx_anggaran rencana 
					  LEFT JOIN ref_bagian bag ON rencana.BagianID = bag.BagianID 
					  LEFT JOIN ark_mst_rkakl rkakl ON rkakl.RKAKLID = rencana.RKAKLID 
					  LEFT JOIN ark_trx_anggarandetail realisasi ON rencana.AnggaranID = realisasi.AnggaranID
					 ".$set1." ".$set2."
					 GROUP BY bln_nu
					) AS da LEFT JOIN chart_parameter param_one ON da.status_realisasi = param_one.idParameter 
							LEFT JOIN chart_parameter param_two ON da.status_rencana = param_two.idParameter";
			// var_dump($sql);
			$query = $this->db->query($sql);
			if($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}
	}
?>