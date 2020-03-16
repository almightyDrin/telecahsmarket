<?php 

class Telesales extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index( $key=NULL )
    {
        if ( is_null($key) || empty($key) ) {
            show_404();
        }
        $this->data['page_title'] = 'Telesales Tracking System';
        $this->load_view('pages/'.strtolower($key).'_telesales', $this->data);
    }
    public function register( $key )
    {
        $validate = $this->validate_fields('client_reg', 'Registration');
        if ( ! array_key_exists( 'success', $validate ) ) {
            echo json_encode( $validate );
            return FALSE;
        }

        $this->data['customer_info'] = [
            'full_name'     =>  ucwords($this->input->post('full_name')),
            'date_of_birth' =>  $this->input->post('date_field'),
            'email'         =>  $this->input->post('email_field'),
            'contact_num'   =>  $this->input->post('phone_field_phoneCode').$this->input->post('phone_field'),
            'ts_attended'   =>  $this->input->post('user_code'),
            'site_url'      =>  $this->input->post('current_url'),
            'cashmarket'    =>  strtolower($key),
        ];
        
        $result = $this->admin->store('tbl_customers', $this->data['customer_info'] );
        echo json_encode(['success' => $this->data['customer_info']]);
    }
    public function get_code( )
    {
        $params = [
            'columns'   =>  'username, user_code',
            'table'     =>  'tbl_user',
        ];

        $result = $this->admin->get($params);
        echo json_encode($result);
    }
    public function validate_fields($validate, $message)
    {   
        $vResult = [];
        if ($this->form_validation->run($validate) == FALSE) {            
            $vResult['errors'] = [
                'fullname'      =>   strip_tags(form_error('full_name')),
                'dateofbirth'   =>   strip_tags(form_error('date_field')),
                'email'         =>   strip_tags(form_error('email_field')),
                'phone'         =>   strip_tags(form_error('phone_field')),
                'telesales'      =>   strip_tags(form_error('user_code')),
            ];
        }else{
            $vResult['success'] = ucfirst($message)." Successfully!";
        }
        return $vResult;
    }
}


?>