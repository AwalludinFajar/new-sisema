<?php
class Welcome extends MX_Controller{
  //put your code here
  public function __construct() {
    parent::__construct();
		$this->atos_tiasa_leubeut();
		$this->load->model('user_management/m_user');
  }

	public function atos_tiasa_leubeut(){
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
  }

	public function index() {
    $data["xxx"]="";
    $userCaptcha = $this->input->post('userCaptcha');
    $this->template->load('template_frontend','v_index',$data);
  }
}
?>
