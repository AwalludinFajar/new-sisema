<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * 
	 */
	class User_management extends MX_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('m_user');
			// $this->database_three = $this->load->database('simpeg_baru', TRUE);
		}

		public function user($value='')
		{
			$data['user_sppd'] = $this->m_user->get_employee_from_sppd();
			$data['filter_komp'] = $this->m_user->filter_kom();
			$data['filter_bagian'] = $this->m_user->filter_bagian();
			$data['filter_univ'] = $this->m_user->filter_user('ref_unkerja','kunker');
			$data['user_cond'] = $this->m_user->grup_user();
			$data['sub_judul_form']="Data User";
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'data_master/m_user',
					'name' => 'User'
					)
				);
			$data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','user/v_user', $data);
		}

		public function unker($unkr)
		{
			$this->database_three->where('kunkom',$unkr);
			$this->database_three->group_by('kununit');
			$data = $this->database_three->get('ref_unkerja')->result();
			echo json_encode($data);
		}

		public function setsatker()
		{
			$this->database_three->where('kunkom', $this->input->post('idkomp'));
			$this->database_three->where('kununit', $this->input->post('idunt'));
			$this->database_three->group_by('ksatker');
			$data = $this->database_three->get('ref_unkerja')->result();
			echo json_encode($data);
		}

		public function setsubsatker()
		{
			$this->database_three->where('kunkom', $this->input->post('idkomp'));
			$this->database_three->where('kununit', $this->input->post('uniker'));
			$this->database_three->where('ksatker', $this->input->post('subker'));
			$data = $this->database_three->get('ref_unkerja')->result();
			echo json_encode($data);
		}

		public function setFilter()
		{
			$bantu_key	= $this->input->post('kod_bag');
			$nama 		= $this->input->post('nama_peg');
			$nip 		= $this->input->post('nip_peg');
			$whe = "WHERE ";
			if ($bantu_key != '' && $nama == '' && $nip == '') {
				$whe = $whe." a.kunker = '".$bantu_key."'";
			} else if ($bantu_key == '' && $nama != '' && $nip == '') {
				$whe = $whe." a.nama LIKE '".$nama."%'";
			} else if ($bantu_key == '' && $nama == '' && $nip != '') {
				$whe = $whe." a.nip = ".$nip;
			} else if ($bantu_key == '' && $nama != '' && $nip != '') {
				$whe = $whe." a.nama = ".$nama." AND a.nip = ".$nip;
			} else {
				if ($bantu_key == '0000000000') { 
					if($nama != '' && $nip == ''){
						$whe = $whe." a.nama LIKE '".$nama."%'";
					}else if($nama == '' && $nip != ''){
						$whe = $whe." a.nip LIKE '".$nip."%'";
					}
				} else { 
					if ($nip == '') {
					 	$whe = $whe." a.nama LIKE '".$nama."%'"; 
					} else {
					 	$whe = $whe." a.nama LIKE '".$nama."%' AND a.nip = ".$nip;
					}
				}
			}

			$data['user_sppd'] = $this->m_user->filtercalon($whe);
			$data['filter_komp'] = $this->m_user->filter_kom();
			$data['filter_bagian'] = $this->m_user->filter_bagian();
			$data['filter_univ'] = $this->m_user->filter_user('ref_unkerja','kunker');
			$data['user_cond'] = $this->m_user->grup_user();
			$data['sub_judul_form']="Data User";
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'user_management/user',
					'name' => 'User'
					)
				);
			// $data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','user/v_user', $data);
		}

		public function selectonly()
		{
			$filkey = "WHERE a.nip LIKE '%".$this->input->post('nip_peg')."%' AND a.nama LIKE '%".$this->input->post('nama_peg')."%'";
			$data = $this->m_user->filtercalon($filkey);
			echo json_encode($data);
		}

		public function setuserdata()
		{
			$bagianid = $this->input->post('bagian');
			$nip = $this->input->post('nip_pega');
			$nama = $this->input->post('nama_peg');
			$email = $this->input->post('mail');
			$hp = $this->input->post('nohp');
			$stat = $this->input->post('usaktif');
			$pasw = sha1(md5('userkrisna'));
			$level = $this->input->post('usgroup');
			$creat = date('d-m-Y h:i:s a');

			$cek_employee = "SELECT * FROM ark_mst_employee WHERE NIP = '".$nip."' AND Nama = '".$nama."'";
			if ($this->db->query($cek_employee)->num_rows() == 0) {
				$this->db->query("INSERT INTO ark_mst_employee (`BagianID`,`NIP`,`Nama`,`email`,`hp`,`Inactive`,`Password`,`userlevel_id`,`createTime`) VALUES (".$bagianid.",'".$nip."','".$nama."','".$email."','".$hp."','".$stat."','".$pasw."','".$level."','".$creat."')");
				echo "<script>
						alert('Data Berhasil di Tambahkan...');
						window.location = '".base_url()."user_management/user'"."
					  </script>";
			} else {
				echo "<script>alert('Data Tidak bisa Ditambahkan di karenakan Telah Ditambahkan Sebelumnya...'); history.go(-1);</script>";
			}
		}

		public function bagian($value='')
		{
			if (isset($_POST['cari_global'])) {
				$data1 = array('s_cari_global' => $_POST['cari_global']);
				$this->session->set_userdata($data1);
			}

			$data['data_bagian_kep'] = $this->m_user->get_data_bagian_kep();
			$data['sub_judul_form']="Data Bagian";
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'user_management/bagian',
					'name' => 'Bagian'
					)
				);
			$data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','user_management/bagian/bagian_kep', $data);
		}

		public function bagian_tambah($value='')
		{
			if (isset($_POST['cari_global'])) {
				$data1 = array('s_cari_global' => $_POST['cari_global']);
				$this->session->set_userdata($data1);
			}

			$data['filter_komp'] = $this->m_user->filter_kom();
			$data['sub_judul_form']="Data Bagian Tambah";
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'user_management/bagian',
					'name' => 'Bagian'
					),
				array (
					'link' => 'user_management/bagian_tambah',
					'name' => 'Tambah Bagian'
					)
				);
			// $data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','user_management/bagian/add_bagian_kepegawaian', $data);
		}

		public function tambah_bagian($val='')
		{
			$em_id = $this->session->userdata('sesi_employ_id');
			$nik = $this->session->userdata('sesi_username');
			$nama_L = $this->session->userdata('sesi_nama_lengkap');
			$time = date("d/m/Y h:i:s A");

			$data['KunkerID']		 = $this->input->post('kod_bag');
			$data['nunker']			 = $this->input->post('nuker');
			$data['Nama_bagian']	 = $this->input->post('nama_bag');
			$data['Status_active']	 = $this->input->post('stats');
			$data['UpdateBy']		 = $em_id."#".$nik."#".$nama_L."#".$time;

			$xss_data = $this->security->xss_clean($data);
			if ($val != '') {
				$this->db->where('BagianID',$val);
				$this->db->update('ref_bagian',$xss_data);
				echo "<script>alert('Data Berhasil di Edit...'); history.go(-2);</script>";
			} else {
				$this->db->insert("ref_bagian", $xss_data);
				echo "<script>alert('Data Berhasil di Tambahkan...'); history.go(-2);</script>";
			}
		}

		public function update_bagian($val)
		{
			$data['bagian'] = $this->m_user->get_data_bagian_kep($val);
			$data['sub_judul_form']="Edit data Bagian";
			$data['hilangkan']="style='display: none;'";
			$data['breadcrumbs'] = array(
				array (
					'link' => 'welcome',
					'name' => 'Home'
					),
				array (
					'link' => 'user_management/bagian',
					'name' => 'Bagian'
					),
				array (
					'link' => 'user_management/bagian_tambah',
					'name' => 'Edit Bagian'
					)
				);
			// $data['role'] = get_role($this->session->userdata('sesi_id'));
			$this->template->load('template_frontend','user_management/bagian/add_bagian_kepegawaian', $data);
		}

		public function delete_bagian($id)
		{
			$this->db->where('BagianID',$id);
			$this->db->delete('ref_bagian');
			echo "<script>alert('Data Berhasil di Hapus...'); history.go(-1);</script>";
		}
	}
?>