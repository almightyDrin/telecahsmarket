<?php 

class Cms_admin extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['is_logged_in'] = $this->check_usersession();
    }

    public function is_logged_in() {
        if ($this->data['is_logged_in'] == FALSE) {
            redirect('admin');
            return FALSE;
        }
    }
    public function auth( ) {
        $validate = $this->validate_fields('admin_login', 'Success login');

        if ( ! array_key_exists('success', $validate) ) {
            echo json_encode($validate);
            return FALSE;
        }

        $username = $this->input->post('admin_user');
        $password = $this->input->post('admin_pword');

        $permission = $this->auth->authenticate($username, $password, $key=NULL);
        // print_return($_SESSION);
        if ($permission === TRUE) {
            echo json_encode(['success' => 'Login Success']);
        }else{
            echo json_encode(['errors' => 'Login Credentials is Incorrect']);
            return false;
        }
    }
    public function login() {
        if ($this->data['is_logged_in'] == TRUE) {
            redirect('cms_admin/admin');
            return TRUE;
        }
        $this->data['page_title'] = "Login";
        $this->load_view('cms_admin/login', $this->data, 'admin');
    }
    public function register() {
        $this->is_logged_in();
        $this->data['page_title'] = "Register";
        $this->load_view('cms_admin/register', $this->data, 'admin');
    }
    public function admin() {
        $this->is_logged_in();
        $this->data['page_title'] = "CMS Admin";
        $this->load_view('cms_admin/admin', $this->data, 'admin');
    }
    public function customers() {
        $this->is_logged_in();
        $this->data['page_title'] = "Customers";
        $this->load_view('cms_admin/customers', $this->data, 'admin');
    }
    public function telesales() {
        $this->is_logged_in();
        $this->data['page_title'] = "Telesales";
        $this->load_view('cms_admin/telesales', $this->data, 'admin');
    }
    public function users()
    {
        $this->is_logged_in();
        $this->data['page_title'] = 'Users';
        $this->load_view('cms_admin/users', $this->data, 'admin');
    }
    public function logout() {
        $this->is_logged_in();
        if ($this->data['is_logged_in'] == TRUE) {
            $this->session->unset_userdata('administrator');
            $this->session->sess_destroy();
            redirect('admin');
        }
    }

    public function store_user()
    {
        $this->is_logged_in();
        $validate = $this->validate_fields('admin_reg', 'Created User');

        if ( ! array_key_exists('success', $validate) ) {
            echo json_encode($validate);
            return FALSE;
        }

        $this->data['new_user'] = [
            'username'      =>  $this->input->post('reg_user'),
            'password'      =>  $this->input->post('reg_pass'),
            'acc_level'     =>  $this->input->post('account_level'),
            'cashmarket'    =>  $this->input->post('cashmarket'),
            'user_code'     =>  $this->input->post('cashmarket').'-'.create_uid(),
            'created_by'    =>  $this->data['session']['username'],
        ];
        $this->admin->store('tbl_user', $this->data['new_user']);
        echo json_encode($validate);
    }

    public function get_customers()
    {
        $this->is_logged_in();
        $this->data['tbl'] = 'tbl_customers';
        $valid_columns = ['deposit','full_name','email','contact_num','ts_attended','cashmarket','created_date'];
        $filter = ($this->data['session']['cashmarket'] === 'all') ? NULL : [
            'cashmarket' => $this->data['session']['cashmarket']
        ] ;

        $result = $this->datatables($valid_columns, $this->data['tbl'], $filter);

        if (!empty($result['result']['data'])) {
            /* Column Arrangements */
            foreach ($result['result']['data'] as $key => $value) {
                $actions = '<a id="viewCustomer" data-toggle="modal" href="'.base_url().'cms_admin/show_customer/'.base64_encode($value['id']).'" data-target=".bd-example-modal-lg" class="btn btn-info btn-circle btn-sm fas fa-eye" title="View User">
                                
                            </a>';

                $this->data['customers'][] = [
                    ($value['deposit'] > 0) ? $deposit_flag = '<i class="fas fa-circle d-yes"></i>' : $deposit_flag = '<i class="fas fa-circle d-no"></i>' ,
                    $value['full_name'],
                    $value['email'],
                    $value['contact_num'],
                    $value['ts_attended'],
                    $value['cashmarket'],
                    date("F j, Y, g:i a", strtotime($value['created_date'])),
                    $actions,
                ];
            }
        } else {
            $this->data['customers'][] = ['', 'No Record Found...', '', ''];
        }
        
        /* Prepare Data Outputs */
        $output = [
            'draw'              =>  $result['post_dataTables']['draw'],
            'recordsTotal'      =>  $result['result']['count'],
            'recordsFiltered'   =>  $result['result']['count'],
            'data'              =>  $this->data['customers'],
        ];
        
        echo json_encode($output);
    }

    public function get_tele_clients( $ts )
    {
        $this->is_logged_in();
        $this->data['tbl'] = 'tbl_customers';
        $valid_columns = ['deposit','full_name','created_date'];
        $filter = ['ts_attended' => $ts];
        ($this->data['session']['cashmarket'] === 'all') ? NULL : $filter['cashmarket'] = $this->data['session']['cashmarket'];

        $result = $this->datatables($valid_columns, $this->data['tbl'], $filter);

        if (!empty($result['result']['data'])) {
            /* Column Arrangements */
            foreach ($result['result']['data'] as $key => $value) {
                $actions = '<a id="viewCustomer" data-toggle="modal" href="'.base_url().'cms_admin/show_customer/'.base64_encode($value['id']).'" data-target=".bd-example-modal-lg" class="btn btn-info btn-circle btn-sm fas fa-eye" title="View User">
                            </a>';

                $this->data['customers'][] = [
                    ($value['deposit'] > 0) ? $deposit_flag = '<i class="fas fa-circle d-yes"></i>' : $deposit_flag = '<i class="fas fa-circle d-no"></i>' ,
                    $value['full_name'],
                    date("F j, Y, g:i a", strtotime($value['created_date'])),
                    $actions,
                ];
            }
        } else {
            $this->data['customers'][] = ['', 'No Record Found...', '', ''];
        }
        
        /* Prepare Data Outputs */
        $output = [
            'draw'              =>  $result['post_dataTables']['draw'],
            'recordsTotal'      =>  $result['result']['count'],
            'recordsFiltered'   =>  $result['result']['count'],
            'data'              =>  $this->data['customers'],
        ];
        
        echo json_encode($output);
    }

    public function show_customer( $id )
    {
        $this->is_logged_in();
        $this->data['page_title'] = "Customer Info";
        $params = [
            'table'     =>  'tbl_customers',
            'where_col' =>  'id',
            'where_val' =>  base64_decode($id),
            'limit'     =>  1,
        ];

        $result = $this->admin->get($params);
        $this->data['customer'] = $result[0];
        $this->load->view('cms_admin/single_customer', $this->data);
    }

    public function get_telesales()
    {
        $this->is_logged_in();
        $this->data['tbl'] = 'tbl_user AS U';
        // $valid_columns = ['U.id', 'U.username', 'U.cashmarket', 'C.ts_attended', 'U.created_date'];
        $valid_columns = ['U.id', 'U.username', 'U.cashmarket', 'U.created_date'];
        $filter = [
            'U.acc_level' => '0555', 
        ];
        if ( $this->data['session']['cashmarket'] !== 'all' ) $filter['U.cashmarket'] = $this->data['session']['cashmarket'];
        // $join = [
        //     '(SELECT COUNT(*) AS attended, ts_attended FROM tbl_customers GROUP BY ts_attended ORDER BY attended DESC) AS C'
        //     =>  'U.username = C.ts_attended|left',
        // ];

        $ts = $this->datatables($valid_columns, $this->data['tbl'], $filter);

        if (!empty($ts['result']['data'])) {
            /* Column Arrangements */
            foreach ($ts['result']['data'] as $ts_key => $ts_value) {
                $actions = '<a id="viewTelesales" href="./cms_admin/show_telesale/'.base64_encode($ts_value['id']).'" class="btn btn-info btn-circle btn-sm" toggle="tooltip" data-placement="top" title="View Telesale">
                                <i class="fas fa-eye"></i>
                            </a>';

                $this->data['telesales'][] = [
                    $ts_value['id'],
                    $ts_value['username'],
                    $ts_value['cashmarket'],
                    // ($ts_value['attended']) ?? '0',
                    date("F j, Y, g:i a", strtotime($ts_value['created_date'])),
                    $actions,
                ];
            }
        } else {
            $this->data['telesales'][] = ['', 'No Record Found...', '', ''];
        }
        
        /* Prepare Data Outputs */
        $output = [
            'draw'              =>  $ts['post_dataTables']['draw'],
            'recordsTotal'      =>  $ts['result']['count'],
            'recordsFiltered'   =>  $ts['result']['count'],
            'data'              =>  $this->data['telesales'],
        ];
        
        echo json_encode($output);
    }

    public function show_telesale( $id )
    {
        $this->is_logged_in();
        $this->data['page_title'] = 'Telesales Info';
        $params = [
            'table'     =>  'tbl_user',
            'where_col' =>  'id',
            'where_val' =>  base64_decode($id),
            'limit'     =>  1,
        ];

        $result = $this->admin->get($params);
        $this->data['telesale'] = $result[0];

        $this->load_view('cms_admin/single_telesale', $this->data, 'admin');
    }

    public function get_users()
    {
        $this->is_logged_in();
        $this->data['tbl'] = 'tbl_user';
        $valid_columns = ['id', 'username', 'acc_level', 'cashmarket', 'created_date'];
        $result = $this->datatables($valid_columns, $this->data['tbl']);

        if (!empty($result['result']['data'])) {
            /* Column Arrangements */
            foreach ($result['result']['data'] as $key => $value) {
                $actions = '<a id="editUser" data-toggle="modal" href="'.base_url().'cms_admin/edit_user/'.base64_encode($value['id']).'" data-target=".bd-example-modal-lg" class="btn btn-warning btn-circle btn-sm fas fa-edit text-dark" title="Edit User">
                </a>';
                $actions .= '<a id="deleteUser" href="'.base_url().'cms_admin/delete_user/'.base64_encode($value['id']).'" class="btn btn-danger btn-circle btn-sm mx-3" title="Delete User"> 
                                <i class="fas fa-trash-alt"></i>
                            </a>';

                $this->data['telesales'][] = [
                    $value['id'],
                    $value['username'],
                    $value['acc_level'],
                    $value['cashmarket'],
                    date("F j, Y, g:i a", strtotime($value['created_date'])),
                    $actions,
                ];
            }
        } else {
            $this->data['telesales'][] = ['', 'No Record Found...', '', ''];
        }
        
        /* Prepare Data Outputs */
        $output = [
            'draw'              =>  $result['post_dataTables']['draw'],
            'recordsTotal'      =>  $result['result']['count'],
            'recordsFiltered'   =>  $result['result']['count'],
            'data'              =>  $this->data['telesales'],
        ];
        
        echo json_encode($output);
    }

    public function edit_user( $id )
    {
        $this->is_logged_in();
        $params = [
            'table'     =>  'tbl_user',
            'where_col' =>  'id',
            'where_val' =>  base64_decode($id),
        ];
        $result = $this->admin->get($params);
        $this->data['user'] = $result[0];
        $this->load->view('cms_admin/single_user', $this->data);
    }

    public function update_user( $id )
    {
        $this->is_logged_in();
        $this->data['tbl'] = 'tbl_user';
        $this->data['update_user'] = [
            'username'  =>  $this->input->post('update_user'),
            'password'  =>  $this->input->post('update_pass'),
        ];
        $this->admin->update($this->data['tbl'], $this->data['update_user'], 'id', $id);
        redirect('cms_admin/users');
    }
    
    public function delete_user( $id )
    {
        $this->is_logged_in();
        $this->admin->delete('tbl_user', base64_decode($id));
        redirect('cms_admin/users');
    }

    public function validate_fields($validate, $message, $action=NULL)
    {   
        $vResult = array();

        if ($this->form_validation->run($validate) == FALSE) {            

            $vResult['errors'] = array(
                'username'  =>  strip_tags(form_error('admin_user')),
                'user_reg'  =>  strip_tags(form_error('reg_user')),
                'password'  =>  strip_tags(form_error('admin_pword')),
                'pass_reg'  =>  strip_tags(form_error('reg_pass')),
            );

        }else{

            $vResult['success'] = ucfirst($message)." Successfully!";

        }

        return $vResult;
    }

}


?>