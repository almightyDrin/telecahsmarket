<?php 

class Auth_model extends CI_Model {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function authenticate($username = NULL, $password = NULL, $key = NULL)
    {
        $qry = $this->db->distinct()
             ->select('U.username, U.acc_level, U.cashmarket, P.*')
             ->where('U.username', $username)
             ->where('U.password', $password)
             ->join('tbl_acc_privilege AS P', 'P.acc_code = U.acc_level')
             ->limit(1)
             ->get('tbl_user AS U');
        
        if ($qry->num_rows() > 0) {
            $sess = $qry->result_array();
            
            $this->session->set_userdata('administrator', $sess[0]);
            return TRUE;
        }else{
            return FALSE;
        }
    }

}

?>