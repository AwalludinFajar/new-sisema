<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_profil_app extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->atos_tiasa_leubeut();
    }   
	
	public function atos_tiasa_leubeut(){
		if($this->session->userdata('atos_tiasa_leubeut')!=1){
			redirect('loginapp');
		} 
    }
	
	public function index()
	{
		$userCaptcha = $this->input->post('userCaptcha');
		$sqlceklogo		= "SELECT * FROM ref_profil_app";
		$data['ListLogo'] = $this->db->query($sqlceklogo)->result_array(); 
		$this->template->load('template_frontend','v_index',$data);	
	}
	public function add() {

		$judul		= $this->input->post('jdl_applikasi');
		$cond		= $this->input->post('shw_judul');

		$lgo_w = $this->input->post('lg_width');
		$lgo_h = $this->input->post('lg_height');
		// $bgr_w = $this->input->post('bg_width');
		// $bgr_h = $this->input->post('bg_height');
		$hdr_w = $this->input->post('hd_width');
		$hdr_h = $this->input->post('hd_height');

		$note_logo = $this->input->post('ket_logo');
		$note_bgr  = $this->input->post('ket_bgr');
		$note_head = $this->input->post('ket_head');

		$config['upload_path']   = './uploads/profil_app'; 
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = 2048;  
		$this->load->library('upload', $config);
		
		if($this->upload->do_upload('filelogo') && !$this->upload->do_upload('filebg') && !$this->upload->do_upload('filehd')){
			// script upload file pertama
			$this->upload->do_upload('filelogo');
			$file1 = $this->upload->data();
			$data['nama_aplikasi'] 	= $judul;
			$data['text_j_header']	= $cond;
			$data['logo']	= $file1['file_name'];
			$data['lgo_width'] = $lgo_w;
			$data['lgo_height'] = $lgo_h;
			$data['note_lo'] = $note_logo;

			$xss_data = $this->security->xss_clean($data);
			$this->db->where('id_ref_profil_app',1);
			$this->db->update('ref_profil_app',$xss_data);
			$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
			redirect('ref_profil_app');  
		}
		
		else if(!$this->upload->do_upload('filelogo') && $this->upload->do_upload('filebg') && !$this->upload->do_upload('filehd')){
			// script uplaod file kedua
			$this->upload->do_upload('filebg');
			$file2 = $this->upload->data();
			$data['nama_aplikasi'] 	= $judul;
			$data['text_j_header']	= $cond;
			$data['background']	= $file2['file_name'];
			// $data['bgr_width'] = $bgr_w;
			// $data['bgr_height'] = $bgr_h;
			$data['note_bg'] = $note_bgr;

			$xss_data = $this->security->xss_clean($data);
			$this->db->where('id_ref_profil_app',1);
			$this->db->update('ref_profil_app',$xss_data);
			$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
			redirect('ref_profil_app');  
		}

		else if(!$this->upload->do_upload('filelogo') && !$this->upload->do_upload('filebg') && $this->upload->do_upload('filehd')){
			// script uplaod file ketiga
			$this->upload->do_upload('filebg');
			$file2 = $this->upload->data();
			$data['nama_aplikasi'] 	= $judul;
			$data['text_j_header']	= $cond;
			$data['header']	= $file2['file_name'];
			$data['hdr_width'] = $hdr_w;
			$data['hdr_height'] = $hdr_h;
			$data['note_hd'] = $note_head;

			$xss_data = $this->security->xss_clean($data);
			$this->db->where('id_ref_profil_app',1);
			$this->db->update('ref_profil_app',$xss_data);
			$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
			redirect('ref_profil_app');  
		}
		else if($judul != "" &&  $judul == ""){
			$data['nama_aplikasi'] 	= $judul;
			$data['text_j_header']	= $cond;
			$xss_data = $this->security->xss_clean($data);
			$this->db->where('id_ref_profil_app',1);
			$this->db->update('ref_profil_app',$xss_data);
			$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
			redirect('ref_profil_app');  
		}
		else if ($judul != "" && $this->upload->do_upload('filelogo') && $this->upload->do_upload('filebg') && $this->upload->do_upload('filehd') ){
			// script upload file pertama
			$this->upload->do_upload('filelogo');
			$file1 = $this->upload->data();
			
			// script uplaod file kedua
			$this->upload->do_upload('filebg');
			$file2 = $this->upload->data();

			// script uplaod file kedua
			$this->upload->do_upload('filehd');
			$file3 = $this->upload->data();

			$data['nama_aplikasi'] 	= $judul;
			$data['text_j_header']	= $cond;
			$data['logo']	= $file1['file_name'];
			$data['background']	= $file2['file_name'];
			$data['header']	= $file3['file_name'];
			
			//note tiap gambar
			$data['note_lo'] = $note_logo;
			$data['note_bg'] = $note_bgr;
			$data['note_hd'] = $note_head;

			//mengetur size width dan height image yg di upload
			$data['lgo_width'] = $lgo_w;
			$data['lgo_height'] = $lgo_h;
			// $data['bgr_width'] = $bgr_w;
			// $data['bgr_height'] = $bgr_h;
			$data['hdr_width'] = $hdr_w;
			$data['hdr_height'] = $hdr_h;
			// var_dump($lgo_w,$lgo_h,$bgr_w,$bgr_h,$hdr_w,$hdr_h); die();

			$xss_data = $this->security->xss_clean($data);
			$this->db->where('id_ref_profil_app',1);
			$this->db->update('ref_profil_app',$xss_data);
			$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
			redirect('ref_profil_app');  
		}else{
			$data['nama_aplikasi'] 	= $judul;
			$data['text_j_header']	= $cond;
			
			//note tiap gambar
			$data['note_lo'] = $note_logo;
			$data['note_bg'] = $note_bgr;
			$data['note_hd'] = $note_head;
			
			$data['lgo_width'] = $lgo_w;
			$data['lgo_height'] = $lgo_h;
			// $data['bgr_width'] = $bgr_w;
			// $data['bgr_height'] = $bgr_h;
			$data['hdr_width'] = $hdr_w;
			$data['hdr_height'] = $hdr_h;
			// var_dump($lgo_w,$lgo_h,$bgr_w,$bgr_h,$hdr_w,$hdr_h); die();

			$xss_data = $this->security->xss_clean($data);
			$this->db->where('id_ref_profil_app',1);
			$this->db->update('ref_profil_app',$xss_data);
			$this->session->set_flashdata('message_sukses', 'Perubahan Data Berhasil Disimpan');
			redirect('ref_profil_app'); 
		}
		


		
		//var_dump($file1,$file2);die;
		
		
	}    

	function keluar(){
		$this->session->sess_destroy();
        redirect('loginapp');
	}
	
	
	
	 
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
