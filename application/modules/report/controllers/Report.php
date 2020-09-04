<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* 
	*/
	class Report extends MX_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			$this->load->library('upload');
			$this->load->library('pdf');
			$this->load->library('excel');
			$this->load->model('m_report');
			$this->load->model('data_master/m_data_master');
			$this->load->model('parameter/m_parameter');
		}

		public function atos_tiasa_leubeut() 
		{
			if(!$this->session->userdata('atos_tiasa_leubeut')){
				redirect('loginapp');
			}
		}

		public function report_checklist($value='')
		{
			$data['sub_judul_form']="Report Checklist";
			$data['list_kdMak'] = $this->m_data_master->get_data_rkakl();
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'report/report_checklist',
					'name' => 'report checklist'
					)
				);
			// $data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','transaksi/checklist/re_checklist', $data);
		}

		public function reportChecklist($val='')
		{	
			$data = $this->m_report->report_ceklis_data($val);
			$isi = "<center style='font-family: arial; font-size: 18pt; text-align: center;'><b>KENDALI REALISAI ANGGGARAN</b></p><b>CHECKLIST REPORT</b></center><br>";
			$isi = $isi."<table style='font-family: arial; font-style: italic; font-size: 10pt; font-size: 14vw; border-collapse: collapse;' border='1' width='1200'>". 
					"<thead> ".
						"<tr style='font-family: arial;'> ".
							"<th>Kode MAK</th> ".
							"<th>Tipe Transaksi</th> ".
							"<th>Nip</th> ".
							"<th>Nama</th> ".
							"<th>Tanggal Awal</th> ".
							"<th>Tanggal Akhir</th> ".
							"<th>Jam Awal</th> ".
							"<th>Jam Akhir</th> ".
							"<th>Keterangan</th> ".
						"</tr> ".
					"</thead> ".
					"<tbody>";
			if (isset($data) && $data != NULL) {
				foreach ($data as $key) {
					$th = explode(' ', $key->TanggalAwal); $ta = explode('-', $th[0]);
					$tb = explode(' ', $key->TanggalAkhir); $tz = explode('-', $tb[0]);
					$isi = $isi."<tr>".
									"<td>".$key->KodeMAK."</td>".
									"<td>".$key->TypeTrans."</td>".
									"<td>".$key->NIP."</td>".
									"<td>".$key->Nama_peg."</td>".
									"<td>".$ta[2]."/".$ta[1]."/".$ta[0]."</td>".
									"<td>".$tz[2]."/".$tz[1]."/".$tz[0]."</td>".
									"<td>".$key->JamAwal."</td>".
									"<td>".$key->JamAkhir."</td>".
									"<td>".$key->Uraian."</td>".
								"</tr>";
				}
			} else {
				$isi = $isi."<tr>".
								"<td colspan='9'> Tidak ada Data yang di Tampilkan </td>".
						    "</tr>";
			}
			$isi = $isi."</tbody> </table>";

			$name_file = "checklist_report.pdf";
			$pdf = $this->pdf->load();
			$pdf->AddPage('L');
			$pdf->WriteHTML($isi);
	        $pdf->Output($name_file, 'I');
		}

		public function download_report_ceklis($value='')
		{
			$filen = 'Report_Checklist'.'.xlsx';

			$data = $this->m_report->report_ceklis_data();

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			// $objPHPExcel->createSheet(1);

			$textCenter = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
			$stabborder = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

			$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
			$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'KENDALI REALISAI ANGGGARAN');

			$objPHPExcel->getActiveSheet()->mergeCells('A2:J2');
			$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'CHECKLIST REPORT');

			$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'No')->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'KodeMAK')->getColumnDimension('B')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Tipe Transaksi')->getColumnDimension('C')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getStyle('D4')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Nip')->getColumnDimension('D')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('E4')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Nama')->getColumnDimension('E')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getStyle('F4')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Tanggal Awal')->getColumnDimension('F')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getStyle('G4')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Tanggal Akhir')->getColumnDimension('G')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getStyle('H4')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Jam Awal')->getColumnDimension('H')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getStyle('I4')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Jam Akhir')->getColumnDimension('I')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getStyle('J4')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Keterangan')->getColumnDimension('J')->setWidth(30);
			$yw = 5; $nom = 1;
			if (isset($data) && $data != NULL) {
				foreach ($data as $key => $value) {
					$th = explode(' ', $value->TanggalAwal); $t = explode('-', $th[0]);
					$tb = explode(' ', $value->TanggalAkhir); $z = explode('-', $tb[0]);
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$yw, $nom)->getColumnDimension('B')->setWidth(5);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$yw, $value->KodeMAK)->getColumnDimension('C')->setWidth(40);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$yw, $value->TypeTrans)->getColumnDimension('D')->setWidth(20);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$yw, $value->NIP)->getColumnDimension('E')->setWidth(30);
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$yw, $value->Nama_peg)->getColumnDimension('F')->setWidth(40);
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$yw, $t[2]."/".$t[1]."/".$t[0])->getColumnDimension('G')->setWidth(20);
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$yw, $z[2]."/".$z[1]."/".$z[0])->getColumnDimension('H')->setWidth(20);
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$yw, $value->JamAwal)->getColumnDimension('I')->setWidth(20);
					$objPHPExcel->getActiveSheet()->SetCellValue('I'.$yw, $value->JamAkhir)->getColumnDimension('J')->setWidth(20);
					$objPHPExcel->getActiveSheet()->SetCellValue('J'.$yw, $value->Uraian)->getColumnDimension('K')->setWidth(30);
					$yw++; $nom++;
				}
				$objPHPExcel->getActiveSheet()->getStyle('A4:J'.($yw-1))->applyFromArray($stabborder);
			} else {
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$yw.':J'.$yw);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$yw.':J'.$yw)->applyFromArray($textCenter);
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$yw, 'Tidak Ada Data Untuk Di tampilkan');
				$objPHPExcel->getActiveSheet()->getStyle('A4:J'.$yw)->applyFromArray($stabborder);
			}

			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        	$objWriter->save('downloads/'.$filen);

        	header("Content-Type: application/vnd.ms-excel");
        	header("Content-Disposition: attachment; filename=".$filen);
        	redirect('downloads/'.$filen);
		}

		public function report_anggaran($value='')
		{
			$data['sub_judul_form']="Report Anggaran";
			// $data['list_kdMak'] = $this->m_data_master->get_data_rkakl();
			$data['list_Bagian'] = $this->m_report->list_bagian();
			$data['view_stats'] = $this->m_parameter->parameter_warna();
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'report/report_anggaran',
					'name' => 'report anggaran'
					)
				);
			// $data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','transaksi/anggaran/re_anggaran', $data);
		}

		public function getRkaklId($value='')
		{
			$data = $this->m_data_master->set_per_bagian($value);
			echo json_encode($data);
		}

		public function getrkid($hah)
		{
			$bag = $this->input->post('bagian');
			$bln = $this->input->post('bulin');
			$thn = $this->input->post('tauh');
			$sta = $this->input->post('stats');
			$tipe_tipe = array('Tglrencana','Tglrealisasi'); $na = array('ark_trx_anggaran', 'ark_trx_anggarandetail');
			$wo = array();
			for ($i=0; $i < count($tipe_tipe); $i++) { 
				$dta = $this->m_report->getrkidfrom($bag,$hah,$bln,$thn,$tipe_tipe[$i],$na[$i]); $dzo = array();
				if (isset($dta) && $dta != NULL) {
					foreach ($dta as $key => $value) { $dzo[] = $value->RKAKLID; }
				}
				$wo[] = $dzo;
			}
			echo json_encode($wo);
		}

		public function reportAnggaranRencana($value='')
		{
			$bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			$bul = $this->input->post('bulin');
			$data = $this->m_report->report_anggaran_data($value);
			$ni = 100;
			$bulan = $bln[date("m")-1];
			$tahun = date("Y");
			$isi = "<center style='font-family: arial; font-size: 18pt; text-align: center;'><b>RENCANA ANGGARAN BIRO KEPEGAWAIAN</b></p><b>Anggaran REPORT (RENCANA)</b></center>";
			$isi = $isi."<center style='font-family: arial;'>Bulan : ".$bulan."</p>Tahun : ".$tahun."</center>";
			$isi = $isi."<table style='font-family: arial; font-style: italic; font-size: 10pt; font-size: 14vw; border-collapse: collapse;' border='1' width='1200'>". 
					"<thead> ".
						"<tr style='font-family: arial;'> ".
							"<th>Kode MAK</th> ".
							"<th>Uraian</th> ".
							"<th>Bagian</th> ".
							"<th>Pagu</th> ".
							"<th>Rencana Bulan Lalu</th> ".
							"<th>Rencana Bulan Ini</th> ".
							"<th>Rencana s.d Bulan Ini</th> ".
							"<th>Sisa Pagu</th> ".
							"<th>%</th> ".
							"<th>Status</th> ".
						"</tr> ".
					"</thead> ".
					"<tbody>";
			if (isset($data) && $data != NULL) {
				foreach ($data as $key) {
					$dlr = substr($key->e, 0,4);
					$wkz = 100-$dlr;
					$isi = $isi."<tr>".
									"<td>".$key->KodeMAK."</td>".
									"<td>".$key->Uraian."</td>".
									"<td>".$key->Nama_bagian."</td>".
									"<td style='text-align:right;'>".number_format($key->Jumlah,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($key->a,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($key->b,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($key->c,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($key->d,0,',','.')."</td>".
									"<td style='text-align:right;'>".$wkz."%</td>".
									"<td style='text-align:center; background:#".$key->Warna.";'>".$key->Nama."</td>".
								"</tr>";
				}
			} else {
				$isi = $isi."<tr>".
								"<td colspan='8'> Tidak ada Data yang di Tampilkan </td>".
						    "</tr>";
			}
			$isi = $isi."</tbody> </table>";

			$name_file = "Anggaran_report(Rencana).pdf";
			$pdf = $this->pdf->load();
			$pdf->AddPage('L');
	        $pdf->WriteHTML($isi);
	        $pdf->Output($name_file, 'I');
		}

		public function reportAnggaranRealisasi($value='')
		{
			$bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			$bul = $this->input->post('bulin');
			$data = $this->m_report->report_anggaran_data_nwe($value);
			$ni = 100;
			$bulan = $bln[date("m")-1];
			$tahun = date("Y");
			$isi = "<center style='font-family: arial; font-size: 18pt; text-align: center;'><b>REALISASI ANGGARAN BIRO KEPEGAWAIAN</b></p><b>Anggaran REPORT (REALISASI)</b></center>";
			$isi = $isi."<center style='font-family: arial;'>Bulan : ".$bulan."</p>Tahun : ".$tahun."</center>";
			$isi = $isi."<table style='font-family: arial; font-style: italic; font-size: 10pt; font-size: 14vw; border-collapse: collapse;' border='1' width='1200'>". 
					"<thead> ".
						"<tr style='font-family: arial;'> ".
							"<th>Kode MAK</th> ".
							"<th>Uraian</th> ".
							"<th>Bagian</th> ".
							"<th>Pagu</th> ".
							"<th>Realisasi Bulan Lalu</th> ".
							"<th>Realisasi Bulan Ini</th> ".
							"<th>Realisasi s.d Bulan Ini</th> ".
							"<th>Sisa Pagu</th> ".
							"<th>%</th> ".
							"<th>Status</th> ".
						"</tr> ".
					"</thead> ".
					"<tbody>";
			if (isset($data) && $data != NULL) {
				foreach ($data as $key) {
					$dlr = substr($key->e, 0,4);
					$wkz = 100-$dlr;
					$isi = $isi."<tr>".
									"<td>".$key->KodeMAK."</td>".
									"<td>".$key->Uraian."</td>".
									"<td>".$key->Nama_bagian."</td>".
									"<td style='text-align:right;'>".number_format($key->Jumlah,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($key->a,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($key->b,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($key->c,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($key->d,0,',','.')."</td>".
									"<td style='text-align:right;'>".$wkz."%</td>".
									"<td style='text-align:right; background:#".$key->Warna.";'>".$key->Nama."</td>".
								"</tr>";
				}
			} else {
				$isi = $isi."<tr>".
								"<td colspan='8'> Tidak ada Data yang di Tampilkan </td>".
						    "</tr>";
			}
			$isi = $isi."</tbody> </table>";

			$name_file = "Anggaran_report(Realisasi).pdf";
			$pdf = $this->pdf->load();
			$pdf->AddPage('L');
	        $pdf->WriteHTML($isi);
	        $pdf->Output($name_file, 'I');
		}

		public function reportRencanaRealisasi($value='')
		{
			$bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			$data1 = $this->m_report->report_anggaran_data($value);
			$data2 = $this->m_report->report_anggaran_data_nwe($value);
			$ni = 100;
			$bulan = $bln[date("m")-1];
			$tahun = date("Y");
			$isi = "<center style='font-family: arial; font-size: 18pt; text-align: center;'><b>RENCANA & REALISASI ANGGARAN BIRO KEPEGAWAIAN</b></p><b>Anggaran REPORT (REALISASI)</b></center>";
			$isi = $isi."<center style='font-family: arial;'>Bulan : ".$bulan."</p>Tahun : ".$tahun."</center>";
			$isi = $isi."<table style='font-family: arial; font-style: italic; font-size: 10pt; font-size: 14vw; border-collapse: collapse;' border='1' width='1200'>". 
					"<thead> ".
						"<tr style='font-family: arial;'> ".
							"<th>Kode MAK</th> ".
							"<th>Uraian</th> ".
							"<th>Bagian</th> ".
							"<th>Pagu</th> ".
							"<th>Rencana Bulan Lalu</th> ".
							"<th>Realisasi Bulan Lalu</th> ".
							"<th>Rencana Bulan Ini</th> ".
							"<th>Realisasi Bulan Ini</th> ".
							"<th>Rencana s.d Bulan Ini</th> ".
							"<th>Realisasi s.d Bulan Ini</th> ".
							"<th>Sisa Pagu dari Rencana</th> ".
							"<th>Sisa Pagu dari Realisasi</th> ".
							"<th>% Rencana</th> ".
							"<th>% Realisasi</th> ".
						"</tr> ".
					"</thead> ".
					"<tbody>";
			if (isset($data1) && $data1 != NULL || isset($data2) && $data2 != NULL) {
				foreach ($data1 as $key => $va) {
					foreach ($data2 as $key => $ue) {
						$dlr = substr($va->e, 0,4); $wkz = 100-$dlr;
						$ddr = substr($ue->e, 0,4); $wkk = 100-$ddr;
						if ($va->RKAKLID == $ue->RKAKLID) {
							$isi = $isi."<tr>".
									"<td>".$va->KodeMAK."</td>".
									"<td>".$va->Uraian."</td>".
									"<td>".$va->Nama_bagian."</td>".
									"<td style='text-align:right;'>".number_format($ue->Jumlah,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($va->a,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($ue->a,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($va->b,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($ue->b,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($va->c,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($ue->c,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($va->d,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($ue->d,0,',','.')."</td>".
									"<td style='text-align:right;'>".$wkz."%</td>".
									"<td style='text-align:right;'>".$wkk."%</td>".
								"</tr>";
						} else {
							$isi = $isi."<tr>".
									"<td>".$va->KodeMAK."</td>".
									"<td>".$va->Uraian."</td>".
									"<td>".$va->Nama_bagian."</td>".
									"<td style='text-align:right;'>".number_format($ue->Jumlah,0,',','.')."</td>".
									"<td style='text-align:right;'>".number_format($va->a,0,',','.')."</td>".
									"<td style='text-align:right;'>0</td>".
									"<td style='text-align:right;'>".number_format($va->b,0,',','.')."</td>".
									"<td style='text-align:right;'>0</td>".
									"<td style='text-align:right;'>".number_format($va->c,0,',','.')."</td>".
									"<td style='text-align:right;'>0</td>".
									"<td style='text-align:right;'>".number_format($va->d,0,',','.')."</td>".
									"<td style='text-align:right;'>0</td>".
									"<td style='text-align:right;'>".$wkz."%</td>".
									"<td style='text-align:right;'>0%</td>".
								"</tr>";
						}
					}
				}
			}
			$isi = $isi."</tbody> </table>";

			$name_file = "Anggaran_report(gabungan).pdf";
			$pdf = $this->pdf->load();
			$pdf->AddPage('L');
	        $pdf->WriteHTML($isi);
	        $pdf->Output($name_file, 'I');
		}

		public function download_report_all_anggaran($value='')
		{
			$filen = 'Report_Anggaran'.'.xlsx';

			$ang = $this->m_report->report_anggaran();
			$woho = $this->m_report->bulan_bulan();

			$month = date('m'); $yer = date('Y');
			$mname = date('F', mktime(0,0,0,$month,10));
			//set satu tahun
			$bln = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			$no_to_car=array('I6:L6','M6:P6','Q6:T6','U6:X6','Y6:AB6','AC6:AF6','AG6:AJ6','AK6:AN6','AO6:AR6','AS6:AV6','AW6:AZ6','BA6:BD6');
			$crra = array(array('I7:J7','K7:L7'),array('M7:N7','O7:P7'),array('Q7:R7','S7:T7'),array('U7:V7','W7:X7'),array('Y7:Z7','AA7:AB7'),array('AC7:AD7','AE7:AF7'),array('AG7:AH7','AI7:AJ7'),array('AK7:AL7','AM7:AN7'),array('AO7:AP7','AQ7:AR7'),array('AS7:AT7','AU7:AV7'),array('AW7:AX7','AY7:AZ7'),array('BA7:BB7','BC7:BD7'));
			$crrd = array('I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD');

			$kk = array();
			for ($e=0; $e < count($ang); $e++) { 
				$xa = explode(',', json_encode($ang[$e])); $dg = array();
				for ($i=7; $i < count($xa); $i++) { 
					$ed = explode(':', str_replace("\"", "", $xa[$i])); 
					$kq = substr($ed[0],0, strlen($ed[0])-2);
					$yu = explode('_', $kq);
					if ($yu[0] == 'presentase') {
						$dg[] = substr($ed[1], 0,2).'%';
					} else {
						$dg[] = number_format((int)$ed[1],0,',','.');
					}
				}
				$kk[] = $dg;
			}
			// var_dump($kk); die();

			$objPHPExcel = new PHPExcel();

			$textCenter = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
			$stabborder = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
		
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
			$objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'KEMENTERIAN DALAM NEGERI');

			$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
			$objPHPExcel->getActiveSheet()->getStyle('A2:F2')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Anggaran REPORT');

			$objPHPExcel->getActiveSheet()->mergeCells('A5:C5');
			$objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Tahun : '.$yer);

			$objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A6', 'KodeMAK')->getColumnDimension('A')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('B6', 'Uraian')->getColumnDimension('B')->setWidth(60);
			$objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Vol')->getColumnDimension('C')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('D6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('D6', 'Satuan')->getColumnDimension('D')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('E6', 'HargaSatuan')->getColumnDimension('E')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Jumlah')->getColumnDimension('F')->setWidth(30);
			
			$objPHPExcel->getActiveSheet()->SetCellValue('A8', '1');
			$objPHPExcel->getActiveSheet()->SetCellValue('B8', '2');
			$objPHPExcel->getActiveSheet()->SetCellValue('C8', '3');
			$objPHPExcel->getActiveSheet()->SetCellValue('D8', '4');
			$objPHPExcel->getActiveSheet()->SetCellValue('E8', '5');
			$objPHPExcel->getActiveSheet()->SetCellValue('F8', '6');
			$objPHPExcel->getActiveSheet()->getStyle('A8:F8')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->getStyle('A6:F8')->applyFromArray($stabborder);

			$objPHPExcel->getActiveSheet()->mergeCells('H6:H8');
			$objPHPExcel->getActiveSheet()->getStyle('H6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->getStyle('H6:H8')->applyFromArray($stabborder);
			$objPHPExcel->getActiveSheet()->SetCellValue('H6', 'Bagian')->getColumnDimension('H')->setWidth(30);
			
			for ($i=0; $i < count($woho); $i++) { 
				$objPHPExcel->getActiveSheet()->mergeCells($no_to_car[$i]);
				$objPHPExcel->getActiveSheet()->getStyle($no_to_car[$i])->applyFromArray($stabborder);
				$objPHPExcel->getActiveSheet()->getStyle($no_to_car[$i])->applyFromArray($textCenter);
				$epo = explode(':', $no_to_car[$i]);
				$objPHPExcel->getActiveSheet()->SetCellValue($epo[0], $bln[($woho[$i]-1)]);

				$objPHPExcel->getActiveSheet()->mergeCells($crra[$i][0]);
				$objPHPExcel->getActiveSheet()->getStyle($crra[$i][0])->applyFromArray($stabborder);
				$objPHPExcel->getActiveSheet()->getStyle($crra[$i][0])->applyFromArray($textCenter);
				$ep1 = explode(':', $crra[$i][0]);
				$objPHPExcel->getActiveSheet()->SetCellValue($ep1[0], 'Rencana');
				$objPHPExcel->getActiveSheet()->mergeCells($crra[$i][1]);
				$objPHPExcel->getActiveSheet()->getStyle($crra[$i][1])->applyFromArray($stabborder);
				$objPHPExcel->getActiveSheet()->getStyle($crra[$i][1])->applyFromArray($textCenter);
				$ep2 = explode(':', $crra[$i][1]);
				$objPHPExcel->getActiveSheet()->SetCellValue($ep2[0], 'Realisasi');
				for ($x=0; $x < count($crra[$i]); $x++) { 
					$ka = explode(':', $crra[$i][$x]);
					$eo1 = explode('7', $ka[0]); $eo2 = explode('7', $ka[1]);
					$objPHPExcel->getActiveSheet()->SetCellValue($eo1[0].'8', 'Total')->getColumnDimension($eo1[0])->setWidth(20);
					$objPHPExcel->getActiveSheet()->SetCellValue($eo2[0].'8', '%')->getColumnDimension($eo2[0])->setWidth(20);
					
					$objPHPExcel->getActiveSheet()->getStyle($eo1[0].'8:'.$eo2[0].'8')->applyFromArray($stabborder);
					$objPHPExcel->getActiveSheet()->getStyle($eo1[0].'8:'.$eo2[0].'8')->applyFromArray($textCenter);
				}
			}
			$yw = 9;
			if (isset($ang) && $ang != NULL) {
				foreach ($ang as $key => $value) {
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$yw, $value->KodeMAK)->getColumnDimension('A')->setWidth(40);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$yw, $value->Uraian)->getColumnDimension('B')->setWidth(40);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$yw, $value->VolumeKegiatan)->getColumnDimension('C')->setWidth(10);
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$yw, $value->Satuan)->getColumnDimension('D')->setWidth(10);
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$yw, $value->HargaSatuan)->getColumnDimension('E')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$yw)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$yw, $value->Jumlah)->getColumnDimension('F')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getStyle('F'.$yw)->getNumberFormat()->setFormatCode('#,##0.00');

					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$yw, $value->Nama_bagian)->getColumnDimension('H')->setWidth(60);
					$objPHPExcel->getActiveSheet()->getStyle('H'.$yw)->applyFromArray($stabborder);
					for ($i=0; $i < count($woho); $i++) {
						for ($x=0; $x < count($crra[$i]); $x++) {
							$ka = explode(':', $crra[$i][$x]);
							$eo1 = explode('7', $ka[0]); $eo2 = explode('7', $ka[1]);
							$objPHPExcel->getActiveSheet()->getStyle($eo1[0].$yw.':'.$eo2[0].$yw)->applyFromArray($stabborder);
						}
					}
					$yw++;
				}
				$da = 9;
				for ($q=0; $q < count($kk); $q++) { 
					for ($i=0; $i < count($kk[$q]); $i++) { 
						if ($kk[$q][$i] == 'nu%') {
							$objPHPExcel->getActiveSheet()->SetCellValue($crrd[$i].$da, '0');
						} else {
							$objPHPExcel->getActiveSheet()->SetCellValue($crrd[$i].$da, $kk[$q][$i]);
						}
					}
					$da++;
				}
				$objPHPExcel->getActiveSheet()->getStyle('A9:F'.($yw-1))->applyFromArray($stabborder);
			}

			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        	$objWriter->save('downloads/'.$filen);

        	header("Content-Type: application/vnd.ms-excel");
        	header("Content-Disposition: attachment; filename=".$filen);
        	redirect('downloads/'.$filen);	
		}

		public function download_report_anggaran($value='')
		{
			$filen = 'Report_Anggaran'.'.xlsx';

			$ren = $this->m_report->report_anggaran_data();
			$rel = $this->m_report->report_anggaran_data_nwe();
			$month = date('m'); $yer = date('Y');
			$mname = date('F', mktime(0,0,0,$month,10));

			$objPHPExcel = new PHPExcel();
			$objPHPExcel->createSheet(1);

			$textCenter = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
			$stabborder = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));

			//sheet 1
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
			$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'KEMENTERIAN DALAM NEGERI');

			$objPHPExcel->getActiveSheet()->mergeCells('A2:J2');
			$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Anggaran REPORT (RENCANA)');

			$objPHPExcel->getActiveSheet()->mergeCells('A4:C4');
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Bulan : '.$mname);
			$objPHPExcel->getActiveSheet()->mergeCells('A5:C5');
			$objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Tahun : '.$yer);

			$objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A6', 'No')->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('B6', 'KodeMAK')->getColumnDimension('B')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Uraian')->getColumnDimension('C')->setWidth(60);
			$objPHPExcel->getActiveSheet()->getStyle('D6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('D6', 'Bagian')->getColumnDimension('D')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Pagu')->getColumnDimension('E')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Rencana Bulan Lalu')->getColumnDimension('F')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Rencana Bulan Ini')->getColumnDimension('G')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('H6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('H6', 'Rencana s.d Bulan Ini')->getColumnDimension('H')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('I6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('I6', 'Sisa Pagu')->getColumnDimension('I')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('J6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('J6', 'Presentase Rencana')->getColumnDimension('J')->setWidth(20);
			$yw = 7; $nom = 1;
			if (isset($ren) && $ren != NULL) {
				foreach ($ren as $key => $value) {
					$dlr = substr($value->e, 0,4); $wkz = 100-$dlr;
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$yw, $nom)->getColumnDimension('A')->setWidth(5);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$yw, $value->KodeMAK)->getColumnDimension('B')->setWidth(40);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$yw, $value->Uraian)->getColumnDimension('C')->setWidth(60);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$yw)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$yw, $value->Nama_bagian)->getColumnDimension('D')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$yw)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$yw, $value->Jumlah)->getColumnDimension('E')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('F'.$yw)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$yw, $value->a)->getColumnDimension('F')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('G'.$yw)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$yw, $value->b)->getColumnDimension('G')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('H'.$yw)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$yw, $value->c)->getColumnDimension('H')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('I'.$yw)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('I'.$yw, $value->d)->getColumnDimension('I')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('J'.$yw)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('J'.$yw, $wkz.'%')->getColumnDimension('J')->setWidth(20);
					$yw++; $nom++;
				}
				$objPHPExcel->getActiveSheet()->getStyle('A6:J'.($yw-1))->applyFromArray($stabborder);
			} else {
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$yw.':J'.$yw);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$yw.':J'.$yw)->applyFromArray($textCenter);
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$yw, 'Tidak Ada Data Untuk Di tampilkan');
				$objPHPExcel->getActiveSheet()->getStyle('A6:J'.$yw)->applyFromArray($stabborder);
			}

			//sheet 2
			$objPHPExcel->setActiveSheetIndex(1);
			$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
			$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'KEMENTERIAN DALAM NEGERI');

			$objPHPExcel->getActiveSheet()->mergeCells('A2:J2');
			$objPHPExcel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'Anggaran REPORT (REALISASI)');

			$objPHPExcel->getActiveSheet()->mergeCells('A4:C4');
			$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Bulan : '.$mname);
			$objPHPExcel->getActiveSheet()->mergeCells('A5:C5');
			$objPHPExcel->getActiveSheet()->SetCellValue('A5', 'Tahun : '.$yer);

			$objPHPExcel->getActiveSheet()->getStyle('A6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('A6', 'No')->getColumnDimension('A')->setWidth(5);
			$objPHPExcel->getActiveSheet()->getStyle('B6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('B6', 'KodeMAK')->getColumnDimension('B')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getStyle('C6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('C6', 'Uraian')->getColumnDimension('C')->setWidth(60);
			$objPHPExcel->getActiveSheet()->getStyle('D6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('D6', 'Bagian')->getColumnDimension('D')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('E6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('E6', 'Pagu')->getColumnDimension('E')->setWidth(60);
			$objPHPExcel->getActiveSheet()->getStyle('F6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('F6', 'Realisasi Bulan Lalu')->getColumnDimension('F')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('G6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('G6', 'Realisasi Bulan Ini')->getColumnDimension('G')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('H6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('H6', 'Realisasi s.d Bulan Ini')->getColumnDimension('H')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('I6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('I6', 'Sisa Pagu')->getColumnDimension('I')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getStyle('J6')->applyFromArray($textCenter);
			$objPHPExcel->getActiveSheet()->SetCellValue('J6', 'Presentase Realisasi')->getColumnDimension('J')->setWidth(20);
			$yz = 7; $non = 1;
			if (isset($rel) && $rel != NULL) {
				foreach ($rel as $key => $value) {
					$dlr = substr($value->e, 0,4); $wkz = 100-$dlr;
					$objPHPExcel->getActiveSheet()->SetCellValue('A'.$yz, $non)->getColumnDimension('A')->setWidth(5);
					$objPHPExcel->getActiveSheet()->SetCellValue('B'.$yz, $value->KodeMAK)->getColumnDimension('B')->setWidth(40);
					$objPHPExcel->getActiveSheet()->SetCellValue('C'.$yz, $value->Uraian)->getColumnDimension('C')->setWidth(60);
					$objPHPExcel->getActiveSheet()->getStyle('D'.$yz)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('D'.$yz, $value->Nama_bagian)->getColumnDimension('D')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('E'.$yz)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('E'.$yz, $value->Jumlah)->getColumnDimension('E')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('F'.$yz)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('F'.$yz, $value->a)->getColumnDimension('F')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('G'.$yz)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('G'.$yz, $value->b)->getColumnDimension('G')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('H'.$yz)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('H'.$yz, $value->c)->getColumnDimension('H')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('I'.$yz)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('I'.$yz, $value->d)->getColumnDimension('I')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getStyle('J'.$yz)->getNumberFormat()->setFormatCode('#,##0.00');
					$objPHPExcel->getActiveSheet()->SetCellValue('J'.$yz, $wkz.'%')->getColumnDimension('J')->setWidth(20);
					$yz++; $non++;
				}
				$objPHPExcel->getActiveSheet()->getStyle('A6:J'.($yz-1))->applyFromArray($stabborder);
			} else {
				$objPHPExcel->getActiveSheet()->mergeCells('A'.$yz.':J'.$yz);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$yz.':J'.$yz)->applyFromArray($textCenter);
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$yz, 'Tidak Ada Data Untuk Di tampilkan');
				$objPHPExcel->getActiveSheet()->getStyle('A6:J'.$yz)->applyFromArray($stabborder);
			}

			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        	$objWriter->save('downloads/'.$filen);

        	header("Content-Type: application/vnd.ms-excel");
        	header("Content-Disposition: attachment; filename=".$filen);
        	redirect('downloads/'.$filen);	
		}

		public function report_perencanaan($value='')
		{
			$data['sub_judul_form']="Report Perencanaan";
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'report/report_perencanaan',
					'name' => 'report perencanaan'
					)
				);
			// $data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','perencanaan/re_perencanaan', $data);
		}

		public function report_realisasi($value='')
		{
			$data['sub_judul_form']="Report Realisasi";
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'report/report_realisasi',
					'name' => 'report realisasi'
					)
				);
			// $data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','realisasi/re_realisasi', $data);
		}

		public function barang_inventaris($value='')
		{
			$data['sub_judul_form']="Report Inventaris Barang";
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'report/barang_inventaris',
					'name' => 'report Inventaris Barang'
					)
				);
			// $data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','inventaris_barang/re_inventaris_barang', $data);
		}

		public function report_sppd($value='')
		{
			$data['sub_judul_form']="Report Surat Pengajuan Perjalanan Dinas";
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'report/report_sppd',
					'name' => 'report SPPD'
					)
				);
			// $data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','sppd/re_sppd', $data);
		}

		public function reportInventarisBarang($value='')
		{
			$isi = '';
			$query = $this->db->query('SELECT * FROM ref_profil_app');
   			$sql = $query->result();
   			$logo = base_url().'uploads/profil_app/'.$sql[0]->logo;
			$data = $this->m_report->report_inventaris_barang();

			if (isset($data) && $data != NULL) {
				foreach ($data as $key) {
					$gfd = explode(' ', $key->nama_barang); $gag = "";
					if (count($gfd) == 1) {
						$gag = $key->nama_barang;
					} else {
						$gigs = ""; for ($i=0; $i < count($gfd); $i++) { $gigs .= $gfd[$i].'_'; }
						$gag = substr($gigs,0,strlen($gigs)-1);
					}
					$image_name = $key->kode_barang.'-'.$gag.'-'.$key->nup.'.png';
					$locimg = base_url().'/assets/images/qrcod/'.$image_name;

					$isi = $isi.'<div class="form-group" style="margin-bottom: 10px;">
									<div class="col-lg-5" style="border: 1px solid black; height: 110px;">
										<img src="'.$logo.'" style="width: 70px; height: 85px; margin: 10px;">
										<div style="border: 1px solid black; width: 460px; height: 80px; margin-bottom: 5px; margin-left: 100px; margin-top: -95px; float: left;">
											<table style="margin: 5px; font-size: 11px;">
												<tr>
													<th>Bagian</th>
													<td>:</td>
													<td>'.$key->Nama_bagian.'</td>
												</tr>
												<tr>
													<th>Kode Barang</th>
													<td>:</td>
													<td>'.$key->kode_barcod.'</td>
												</tr>
												<tr>
													<th>Nama Barang</th>
													<td>:</td>
													<td>'.$key->nama_barang.'</td>
												</tr>
												<tr>
													<th>NUP</th>
													<td>:</td>
													<td>'.$key->nup.'</td>
												</tr>
											</table>
										</div>
										<div id="qrcode" style="margin: 5px;"><img src='.$locimg.' width="89" style="margin-left: 10px;"></div>
									</div>
								</div>';
				}
			} else {
				$isi = $isi.'';
			}
			
			$name_file = "Inventaris_barang_report.pdf";
			$pdf = $this->pdf->load();
			$pdf->AddPage('P');
	        $pdf->WriteHTML($isi);
	        $pdf->Output($name_file, 'I');
		}
	}
?>