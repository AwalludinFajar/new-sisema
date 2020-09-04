<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ref_users extends MX_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
		$this->load->helper('utility');

		$this->atos_tiasa_leubeut();

		Modules::run('ref_role/permissions');
		$this->load->model('users_model');
    }


	public function atos_tiasa_leubeut(){

		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
    }




	public function index( $offset = 0 ) {
		if (isset($_POST['cari_global'])) {
			$data1 = array('s_cari_global' => $_POST['cari_global']);
			$this->session->set_userdata($data1);
		}
		$per_page = 10;
		$qry = "SELECT * FROM ref_users a JOIN ref_user_group b ON a.id_user_group = b.id_user_group";

		if ($this->session->userdata('s_cari_global')!="") {
			$qry.="  WHERE a.nama_lengkap like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
		} elseif ($this->session->userdata('s_cari_global')=="") {
			$this->session->unset_userdata('s_cari_global');
		}
		$qry.= " ORDER BY a.id ASC";

		$offset = ($this->uri->segment(3) != '' ? $this->uri->segment(3):0);

		$config['total_rows'] = $this->db->query($qry)->num_rows();
		$config['per_page']= $per_page;
		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-right"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		$config['uri_segment'] = 3;
		$config['base_url']= base_url().'/ref_users/index';
		$config['suffix'] = '?'.http_build_query($_GET, '', "&");
		$this->pagination->initialize($config);

		$data['paginglinks'] = $this->pagination->create_links();
		$data['per_page'] = $this->uri->segment(3);
		$data['offset'] = $offset ;
		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}
		$qry .= " limit {$per_page} offset {$offset} ";
		$data['ListData'] = $this->db->query($qry)->result_array();

		$data['breadcrumbs'] = array(
			array (
				'link' => 'welcome',
				'name' => 'Settings'
			),
			array (
				'link' => 'ref_users',
				'name' => 'Users'
			)
		);

		$data['sub_judul_form']="Data Users ";
		$sqlceklogo		= "SELECT * FROM ref_profil_app";
		$data['ListLogo'] = $this->db->query($sqlceklogo)->result_array();
		$this->template->load('template_frontend','v_index',$data);
	}

	public function add() {

		$data['breadcrumbs'] = array(
			array (
				'link' => 'welcome',
				'name' => 'Settings'
			),
			array (
				'link' => 'ref_users',
				'name' => 'Users'
			),
			array (
				'link' => 'ref_users/add',
				'name' => 'Tambah Data'
			)
		);

		$data['judul_form']="Tambah Data";
		$data['sub_judul_form']="Users ";
		$data['user_group']=$this->users_model->get_group();
		//$data['filter_bagian']=$this->m_user->filter_bagian();
		$data['kondisi'] = "";
		$sqlceklogo		= "SELECT * FROM ref_profil_app";
		$data['ListLogo'] = $this->db->query($sqlceklogo)->result_array();
		$this->template->load('template_frontend','v_add',$data);
   }

    public function save_and_changes() {

	   try {
			$id = $this->input->post('id_users');
			$username = $this->input->post('nip_users');
			$nama = $this->input->post('nama_users');
			$email = $this->input->post('email_users');
			$hp = $this->input->post('hp_users');
			$group = $this->input->post('group_users');
			$status = $this->input->post('users_aktif');

			if ($id=='' || $id==null) {
				//cek username ganda
				$sql = "select count(username) as ceknik from ref_users where username = '".$username."'";
				$row = $this->db->query($sql)->row_array();
				if ($row['ceknik']==0) {
					$data['username']=$username;
					$data['nama_lengkap']=$nama;
					$data['email']=$email;
					$data['hp']=$hp;
					$data['status_aktif']=$status;
					$data['Password']=sha1(md5('sistemuser'));
					$data['id_user_group']=$group;
          $data['create_by']=$this->session->userdata('sesi_nama_lengkap');
					$data['create_time']=date('Y-m-d H:i:s');

					$xss_data = $this->security->xss_clean($data);
					$this->db->insert('ref_users', $xss_data);
					$this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
					$this->add();
				} else {
					$this->session->set_flashdata('message_sukses', 'User Name Yang Anda Masukan Sudah Ada !!!');
					$this->add();
				}
			} else {
				$data['username']=$username;
				$data['nama_lengkap']=$nama;
				$data['email']=$email;
				$data['hp']=$hp;
				$data['status_aktif']=$status;
				$data['id_user_group']=$group;
        $data['update_by']=$this->session->userdata('sesi_nama_lengkap');
				$data['update_time']=date('Y-m-d H:i:s');

				$xss_data = $this->security->xss_clean($data);
				$this->db->where('id',$id);
				$this->db->update('ref_users',$xss_data);

				$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
				redirect('ref_users');

				$data['judul_form']="Ubah Data";
				$data['sub_judul_form']="Users ";
				$data['field']=$this->users_model->get_all(array('id'=>$id));
				$data['breadcrumbs'] = array(
										array (
											'link' => 'welcome',
											'name' => 'Settings'
										),
										array (
											'link' => 'ref_users',
											'name' => 'Users'
										),
										array (
											'link' => 'ref_users/update/'.$id,
											'name' => 'Ubah Data'
										)
									);
				$sqlceklogo		= "SELECT * FROM ref_profil_app";
				$data['ListLogo'] = $this->db->query($sqlceklogo)->result_array();
				$this->template->load('template_frontend','v_add',$data);
			}
		} catch(Exception $err) {
			log_message("error",$err->getMessage());
			return show_error($err->getMessage());
		}
	}

   public function update() {
     $id=$this->uri->segment(3);
     $data['user_group']=$this->users_model->get_group();
     $data['kondisi'] = "readonly";
     // $data['field']=$this->users_model->get_all(array('id'=>$id));
     $data['field']=$this->users_model->get_all($id);

	   $data['breadcrumbs'] = array(
       array (
				'link' => 'welcome',
				'name' => 'Settings'
			 ),
			 array (
				'link' => 'ref_users',
				'name' => 'Users'
			 ),
			 array (
				'link' => 'ref_users/update/'.$id,
				'name' => 'Ubah Data'
			 )
	   );

	$data['judul_form']="Ubah Data";
	$data['sub_judul_form']="Users ";
	$sqlceklogo		= "SELECT * FROM ref_profil_app";
	$data['ListLogo'] = $this->db->query($sqlceklogo)->result_array();
	$this->template->load('template_frontend','v_add',$data);

   }

   public function delete() {

	$id=$this->uri->segment(3);
			try {

			$this->db->where('id',$id);
			$this->db->delete('ref_users');
			redirect('ref_users');

			}
			catch(Exception $err)
			{
			log_message("error",$err->getMessage());
			return show_error($err->getMessage());
			}

   }

   public function resetpasw($value)
   {
   		$data['Password']=sha1(md5('sistemuser'));
   		$xss_data = $this->security->xss_clean($data);
		  $this->db->where('id',$value);
		  $this->db->update('ref_users',$xss_data);
   }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
