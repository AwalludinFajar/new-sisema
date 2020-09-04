<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Load_reciveing extends MX_Controller
{

  public function __construct() {
      parent::__construct();
      $this->masok();
      $this->load->model('m_reciveing');
  }

  public function masok(){
		if(!$this->session->userdata('atos_tiasa_leubeut')){
			redirect('loginapp');
		}
  }

  public function index($value='')
  {
    if (isset($_POST['cari_global'])) {
			$data1 = array('s_cari_global' => $_POST['cari_global']);
			$this->session->set_userdata($data1);
		}

    $per_page = 10;
    $qry = "SELECT * FROM tab_recive_storage ";

    if ($this->session->userdata('s_cari_global')!="") {
			$qry.="  WHERE no_rv like '%".$this->db->escape_like_str($this->session->userdata('s_cari_global'))."%'  ";
		} elseif ($this->session->userdata('s_cari_global')=="") {
			$this->session->unset_userdata('s_cari_global');
		}
    $qry.= " ORDER BY id ASC";

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
		$config['base_url']= base_url().'/load_reciveing/index';
		$config['suffix'] = '?'.http_build_query($_GET, '', "&");
		$this->pagination->initialize($config);

    $data['paginglinks'] = $this->pagination->create_links();
		$data['per_page'] = $this->uri->segment(3);
		$data['offset'] = $offset ;
		if($data['paginglinks']!= '') {
			$data['pagermessage'] = 'Showing '.((($this->pagination->cur_page-1)*$this->pagination->per_page)+1).' to '.($this->pagination->cur_page*$this->pagination->per_page).' of '.$this->db->query($qry)->num_rows();
		}

    $qry .= " limit {$per_page} offset {$offset} ";
		$data['found'] = $this->db->query($qry)->result_array();
    $data['addmore'] = $this->m_reciveing->load_norv();
    $data['breadcrumbs'] = array(
			array (
				'link' => 'welcome',
				'name' => 'Home'
			),
			array (
				'link' => 'load_reciveing',
				'name' => 'Reciveing'
			)
		);
    $data['sub_judul_form']="Reciveing Process";
    $this->template->load('template_frontend','v_index',$data);
  }

  public function add($value='')
  {
    $data['RvNo'] = $this->m_reciveing->load_norv();
    $data['breadcrumbs'] = array(
			array (
				'link' => 'welcome',
				'name' => 'Home'
			),
			array (
				'link' => 'load_reciveing',
				'name' => 'Reciveing'
			),
			array (
				'link' => 'load_reciveing/add',
				'name' => 'Add'
			)
		);
    $data['sub_judul_form']="Reciveing Add New";
    $this->template->load('template_frontend','v_add',$data);
  }

  public function save_and_changes()
  {
    foreach ($_POST['nomorrv'] as $key) {
      $data['no_rv'] = $key;
      $data['id_user_reciveing'] = $this->session->userdata('sesi_id');
      $data['name_user_reciveing'] = $this->session->userdata('sesi_nama_lengkap');
      $data['date_reciveing'] = date('yy-m-d H:i:s');
      $data['keterangan'] = 'Reciveing : '.$this->input->post('kete');

      $xss_data = $this->security->xss_clean($data);
      $this->db->insert('tab_recive_storage', $xss_data);
    }
    $this->session->set_flashdata('message_sukses', 'Data Berhasil Disimpan');
    $this->add();
  }

  public function delete()
  {
    $id=$this->uri->segment(3);
    $this->m_reciveing->fn_delete($id);
  	redirect('load_reciveing');
  }
}

?>
