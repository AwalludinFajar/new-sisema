<?php
class Loginapp extends MX_Controller{

  public function __construct() {
    parent::__construct();
	}

  public function index() {
		$this->form_validation->set_rules('username', 'Email', 'required');
		$this->form_validation->set_rules('user_password', 'Password', 'required');

		if($this->session->userdata('atos_tiasa_leubeut')){
			redirect('welcome');
		} else {
			if ($this->form_validation->run() == false) {
				$sqlceklogo		= "SELECT * FROM ref_profil_app";
				$data['ListLogo'] = $this->db->query($sqlceklogo)->result_array();
				$this->template->load('template_frontend','index',$data);
			} else {
				$username=$this->input->post('username');
				$user_password= sha1(md5($this->input->post('user_password')));
        //cek kueri
        $sqlcek="SELECT * FROM ref_users WHERE username = ? AND `password` = ?";
				$querycek = $this->db->query($sqlcek,array($username,$user_password));
				$ceking=$querycek->num_rows();
				if ($ceking==0) {
					$sqlceklogo		= "SELECT * FROM ref_profil_app";
					$data['ListLogo'] = $this->db->query($sqlceklogo)->result_array();
					$data["pesan"]="NIP / Password Anda Salah !!!";
					$this->template->load('template_frontend','index',$data);
				} else {
          //cek kueri
          $sqlcek2="SELECT * FROM ref_users WHERE username = ? AND `password` = ?";
					$querycek2 = $this->db->query($sqlcek2,array($username,$user_password));
					$ceking2=$querycek2->num_rows();
					if ($ceking2==0) {
						$data["pesan"]="NIP / Password Anda Belum di Aktifkan!!!";
						$this->template->load('template_frontend','index',$data);
					} else {
						$row2 = $querycek2->row();
						if ($row2->status_aktif == 'Y') {
							$data2 = array(
								'sesi_id' => $row2->id,
								'sesi_username' => $row2->username,
								'sesi_user_group' =>$row2->id_user_group,
								'sesi_nama_lengkap' =>$row2->nama_lengkap,
								'atos_tiasa_leubeut' => TRUE
							);
							$this->session->set_userdata($data2);
              if (!is_dir('./uploads/'.$this->session->userdata('sesi_username'))) {
								 mkdir('./uploads/'.$this->session->userdata('sesi_username'), 0777, true);
							}
							redirect('welcome');
						} else {
							$sqlceklogo		= "SELECT * FROM ref_profil_app";
							$data['ListLogo'] = $this->db->query($sqlceklogo)->result_array();
							$data["pesan"]="Mohon Maaf Username dan Password Anda Belum Aktif....";
							$this->template->load('template_frontend','index',$data);
						}
					}
				}
			}
		}
  }


   public function logout(){
	  $id_user = $this->session->userdata["sesi_id"];
		$data['ip']=$this->input->ip_address();
		$data['logout_time']=date('Y-m-d H:i:s');
		$xss_data = $this->security->xss_clean($data);
		$this->db->where('id', $id_user);
		$this->db->update('ref_users',$xss_data);
		$this->session->sess_destroy();
    redirect('loginapp');
	}
}
