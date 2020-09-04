<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emaillayanan {
    function Emaillayanan() {
        $this->CI =& get_instance();
        $this->CI->load->library('email');        
    }
    private $emailTo; 
    private $isiPesan; 
    private $subjectPesan; 
    

    function setConfigEmail() {    
        $config['protocol'] = "smtp";        
        $config['smtp_host']= "smtp.kemendagri.go.id";
        $config['smtp_user']= "ulapeg@kemendagri.go.id";
        $config['smtp_pass']= "Travelmate2017";
        $config['smtp_port']= "25";
        $config['mailtype'] = "html";
        $config['charset']  = "utf-8";
        $config['newline']  ='\r\n';
        $config['starttls'] = true;
        $config['smtp_crypto']= "tls";
        return $config;
    }

    function kirimEmail() {
       // $cek_email = getValue("email","ref_set_notif","(1=1) limit 1");
        // kalau $cek_email=1 berarti off
        // $cek_email = 1;
       // if($cek_email==1){
            $this->CI->email->initialize($this->setConfigEmail());
            $this->CI->email->set_newline("\r\n");
            $this->CI->email->from('admin.ula@kemendagri.go.id', 'ULA KEMENDAGRI');                        
            $this->CI->email->to($this->emailTo);
            $this->CI->email->subject('tessssss');
            $this->CI->email->message($this->isiPesan);
            $this->CI->email->send();            
        //}
    }
    public function getEmailTo(){
        return $this->emailTo;
    }

    public function setEmailTo($emailTo){
        $this->emailTo = $emailTo;
    }

    public function getIsiPesan(){
        return $this->isiPesan;
    }

    public function setIsiPesan($isiPesan){
        $this->isiPesan = $isiPesan;
    }

    public function getSubjectPesan(){
        return $this->subjectPesan;
    }

    public function setSubjectPesan($subjectPesan){
        $this->subjectPesan = $subjectPesan;
    }
}