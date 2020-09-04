<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Editpass extends CI_Controller {

	public function Editpass()
	{
		parent::__construct();
		$this->atos_tiasa_leubeut();

	}
	
	
	public function atos_tiasa_leubeut()
	{
		if($this->session->userdata('atos_tiasa_leubeut')!=1){
			redirect('loginapp');
		} 
	}
	
	public function index()
	{
		$userCaptcha = $this->input->post('userCaptcha');
		$this->template->load('template_frontend','v_editpass');
	}
	
	
	public function submit ()
	{
		try 
		{
		
			$kunci_masuk_lama = $this->input->post('kunci_masuk_lama');
			$kunci_masuk_baru = sha1(md5($this->input->post('kunci_masuk_baru')));
			$kunci_masuk_lama_enkripsi = sha1(md5($kunci_masuk_lama));
			
			$sql = "select Password from ark_mst_employee where EmployeeID = '".$this->session->userdata('sesi_employ_id')."'";
			$row = $this->db->query($sql)->row_array();
			
			// var_dump($row['Password'], $kunci_masuk_lama_enkripsi); die();			
			if ($row['Password']==$kunci_masuk_lama_enkripsi) {
				$data=array(
					'Password' => $kunci_masuk_baru
				);
				$this->db->where('EmployeeID', $this->session->userdata('sesi_employ_id'));
				$this->db->update('ark_mst_employee', $data);
						
				echo "<script>alert('Password Anda Berhasil Diubah, Silahkan Login Menggunakan Password Baru Anda');window.location='".site_url('editpass/keluar')."';</script>"; 
				$this->session->sess_destroy();
			} else {
				echo "<script>alert('Password Lama Anda Salah');window.location='".site_url('editpass')."';</script>"; 
			}
		
		}
		catch (Exception $e)
		{
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
            $this->showError($e);
			$this->template->load('template_frontend','v_editpass',$data);
		}
	}
	

	function keluar(){
		$this->session->sess_destroy();
        redirect('loginapp');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
