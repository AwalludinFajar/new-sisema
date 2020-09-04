<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 */
class M_reciveing extends CI_Model
{

  function __construct(){
    parent::__construct();
  }

  public function reciveingdata($where = NULL)
  {
    $query = $this->db->get('tab_recive_storage');
    if(isset($where) or $where!=NULL){
      $this->db->where('no_rv',$where);
    }
    $this->db->order_by('id','asc');
    if($query->num_rows()>0){
      if(isset($where) or $where!=NULL){
          return $query->row();
      }else{
          return $query->result();
      }
    }
    return FALSE;
  }

  public function load_norv()
  {
    $arrv = array(); $arvv = array();
    $data_all = $this->reciveingdata();
    if ($data_all>0) {
      foreach ($data_all as $kee) {
        $arrv[] = $kee->no_rv;
      }
    }

    $query = $this->db->get('tab_rv')->result();
    foreach ($query as $key) {
      $this->db->where('no_rv',$key->no_rv);
      $query = $this->db->get('tab_recive_storage');
      if($query->num_rows()>0){
        $arvv[] = 'x';
      } else {
        $arvv[] = $key->no_rv;
      }
    }

    $res = array();
    for ($i=0; $i < count($arvv); $i++) {
      if ($arvv[$i] != 'x') {
        $res[] = $arvv[$i];
      }
    }

    return $res;
    // return $query->result();
  }

  public function fn_delete($value)
  {
    try {
      $this->db->where('id',$value);
  		$this->db->delete('tab_recive_storage');
  	} catch(Exception $err) {
  		log_message("error",$err->getMessage());
  		return show_error($err->getMessage());
    }
  }
}

?>
