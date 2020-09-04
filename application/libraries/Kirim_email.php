<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE); 
/*
  Definisi class library tersendiri.
 */
  class Kirim_email{
    
   private $CI;
   
   function __construct(){
     $this->CI=& get_instance();
     
   }
   
   
   function Kirim_request_akses($email,$subjek,$isi){
    
    $this->CI->load->library('email');
   
    $config['protocol'] = 'smtp';
	$config['smtp_host'] = 'smtp.kemendagri.go.id';
	//$config['smtp_crypto'] ='tls';
    $config['smtp_port'] = '25';
    $config['smtp_timeout'] = '10';
    //$config['smtp_user'] = 'ulapeg@kemendagri.go.id'; 
	//$config['smtp_pass'] = 'Travelmate2017'; 
	$config['smtp_user'] = 'admin.ula@kemendagri.go.id'; 
	$config['smtp_pass'] = 'S10l4.2017'; 
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
	$config['mailtype'] = 'text'; // or html
	$config['validation'] = TRUE; // bool whether to validate email or not
	$config['mailtype'] = 'html'; 
			
	
			$this->CI->email->initialize($config);
      
			$this->CI->email->from('admin.ula@kemendagri.go.id', 'ULA KEMENDAGRI');
     
			//$this->CI->email->to($t->post('email', true));
			$this->CI->email->to($email);
			
      
			$this->CI->email->subject($subjek);
     
      
    // $e = $this->gen_huruf(6); 
     
     $this->CI->email->message($isi);
     
    // $this->CI->email->send();
	
	if (!$this->CI->email->send())
{    
echo $this->CI->email->print_debugger();

} 
	 
	
	 
	/* if (!$this->CI->email->send()) {  
    show_error($this->CI->email->print_debugger());   
   }else{  
    echo 'Success to send email';   
   }  
	 */
	 
     
   }
   
   



}