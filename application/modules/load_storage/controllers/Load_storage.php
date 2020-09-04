<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class Load_storage extends MX_Controller
{

  public function __construct() {
      parent::__construct();
  }

  public function index($value='')
  {
    $data['breadcrumbs'] = array(
			array (
				'link' => 'welcome',
				'name' => 'Home'
			),
			array (
				'link' => 'load_Storage',
				'name' => 'Storage'
			)
		);
    $data['sub_judul_form']="Storage Process";
    $this->template->load('template_frontend','v_index',$data);
  }
}

?>
