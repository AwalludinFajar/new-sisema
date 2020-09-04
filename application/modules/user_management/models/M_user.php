<?php defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 *
	 */
	class M_user extends CI_Model
	{
		public function __construct()
		{
			parent::__construct();
			// $this->database_three = $this->load->database('simpeg_baru', TRUE);
		}

		public function get_employee_from_sppd($value='')
		{
			$sql = "SELECT a.*, b.neselon FROM datapokoksimpeg a LEFT JOIN ref_eselon b ON a.keselon = b.keselon;";
			$query = $this->database_three->query($sql);
			if($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		public function filter_user($dbase=NULL, $order=NULL)
		{
			$this->database_three->order_by($order,'asc');
   			$query = $this->database_three->get($dbase);
   			return $query->result();
		}

		public function filter_bagian($where=NULL)
		{
			if(isset($where) or $where!=NULL){
	      		$this->db->where('BagianID',$where);
	    	}

			$this->db->order_by('BagianID','asc');
   			$query = $this->db->get('ref_bagian');
   			return $query->result();
		}

		public function filter_kom()
		{
			$sql = "SELECT * FROM ref_unkerja WHERE kununit = 00 AND ksatker = 00 AND kssatker = 00";
			$query = $this->database_three->query($sql);
			if($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		public function filtercalon($fill)
		{
			$sql = "SELECT a.*, b.neselon, z.nunker AS ukr FROM datapokoksimpeg a LEFT JOIN ref_eselon b ON a.keselon = b.keselon LEFT JOIN ref_unkerja z ON a.kunker = z.kunker ".$fill;
			$query = $this->database_three->query($sql);
			if($query->num_rows() > 0) {
				return $query->result();
			} else {
				return 0;
			}
		}

		public function grup_user()
		{
			$this->db->order_by('id_user_group','asc');
   			$query = $this->db->get('ref_user_group');
   			return $query->result();
		}

		public function get_data_bagian_kep($where=NULL)
		{
			if(isset($where) or $where!=NULL){
	      		$this->db->where('BagianID',$where);
	    	}

			$this->db->order_by('BagianID','asc');
   			$query = $this->db->get('ref_bagian');
   			return $query->result();
		}
	}
?>
