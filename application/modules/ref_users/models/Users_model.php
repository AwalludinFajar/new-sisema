<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model{

	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

	public function get_all($where = NULL){
      $this->db->select('*');
      $this->db->from('ref_users');
    	if(isset($where) or $where!=NULL){
      	$this->db->where('id',$where);
    	}
   		$query = $this->db->get();
    	if($query->num_rows()>0){
    		if(isset($where) or $where!=NULL){
      			return $query->row();
    		}else{
      			return $query->result();
    		}
    	}
    	return FALSE;
  	}

	public function get_group($where = NULL){
    	if(isset($where) or $where!=NULL){
      	$this->db->where($where);
    	}

   		$query = $this->db->get('ref_user_group');
    	if($query->num_rows()>0){
    		if(isset($where) or $where!=NULL){
      			return $query->row();
    		}else{
      			return $query->result();
    		}
    	}
    	return FALSE;
  	}
}
