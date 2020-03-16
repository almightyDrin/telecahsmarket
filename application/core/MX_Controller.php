<?php 
class MX_Controller extends CI_Controller {
    protected $data = Array();
    public $title;
    public $record_per_page = 50;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Admin_model', 'admin');
        $this->data['session'] = $this->session->userdata('administrator');
        $this->check_activemodule();
        // $this->show_sidebar();
        // no_cache();
    }
    public function check_usersession()
    {
        if ($this->session->has_userdata('administrator')) {
            return TRUE;
        }else {
            return FALSE;
        }
    }
    public function load_view($view, $data, $template = 'default')
    {   
        $view_templates = $this->config->item('view_templates');
        if (!isset($view_templates[$template])) {
            throw new Exception('Specified view template is not yet configured.');
        }
        $view_templates = $view_templates[$template];
        if (isset($view_templates['header']))
            $this->load->view($view_templates['header'], $data);
        $this->load->view($view, $data);
        if (isset($view_templates['footer']))
            $this->load->view($view_templates['footer'], $data);
    }
    public function check_activemodule()
    {
        $this->data['controller'] = $this->router->fetch_class();
        $this->data['method']     = $this->router->fetch_method();
    }
    public function img_upload($directory, $img) 
    {
        $config['upload_path']    = './'.$directory;
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['max_size']       = 0;

        $this->upload->initialize($config);
        $this->upload->do_upload($img);
        
        return $this->upload->data();
    }
    public function post_thumbnail($full_path) {
        list($img_width, $img_height) = getimagesize($full_path);
        $center_x = round($img_width / 2);
        $center_y = round($img_height / 2);
        $crop_width = round(440 / 2);
        $crop_height = round(320 / 2);
        $x1 = max(0, $center_x - $crop_width);
        $y1 = max(0, $center_y - $crop_height);
        $x2 = min($img_width, $center_x + $crop_width);
        $y2 = min($img_height, $center_y + $crop_height);


        $crop['image_library'] = 'gd2';
        $crop['create_thumb'] = TRUE;
        $crop['maintain_ratio'] = TRUE;
        $crop['quality'] = '60%';
        $crop['x_axis'] = $x1;
        $crop['y_axis'] = $y1;
        $crop['width'] = $x2 - $x1;
        $crop['height'] = $y2 - $y1;
        $crop['thumb_marker'] = '_thumb';
        $crop['source_image'] = $full_path;
        echo $crop['width'].'  -  ';
        echo $crop['height'].'<br />';
        echo $crop['x_axis'].'  -  ';
        echo $crop['y_axis'];
        
        $this->image_lib->initialize($crop);
        if (!$this->image_lib->crop()) {
            echo 'log1';
            echo $this->upload->data();
            echo $this->image_lib->display_errors();
        }else{
            echo 'log2';
            print_return($this->upload->data());
            echo $this->image_lib->display_errors();
        }
    }
    public function tinyMCE_img_upload()
    {
        // Allowed origins to upload images
        $accepted_origins = array("http://localhost");

        // Images upload path
        $upload_path = base_url().'uploads/';
        $upload_folder = './uploads/';

        reset($_FILES);
        $temp = current($_FILES);
        if(is_uploaded_file($temp['tmp_name'])){
            if(isset($_SERVER['HTTP_ORIGIN'])){
                // Same-origin requests won't set an origin. If the origin is set, it must be valid.
                if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)){
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                }else{
                    header("HTTP/1.1 403 Origin Denied");
                    return;
                }
            }
        
            // Sanitize input
            if(preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])){
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }
        
            // Verify extension
            if(!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png", "jpeg"))){
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }
        
            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $upload_folder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);
            
            $full_path = $upload_path . $temp['name'];
            
            // Respond to the successful upload with JSON.
            echo json_encode(array('location' => $full_path));
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }
    }
    public function paginate_config($info,$module='')
    {
        switch($module){
            case 'administration': $module = "/admin/";         break;
            case 'modulemanager' : $module = "/modulemanager/"; break;
            case 'datatransfer'  : $module = "/datatransfer/";  break;
            case 'reports'       : $module = "/reports/";       break;
            case 'dashboard'     : $module = "/dashboard/";       break;
            default:
                $module = "";
        }
        $config['base_url']         = base_url().$module.'list/'.$info.'/';
        $config['uri_segment']      = (!empty($module) && $module != NULL)? 4 : 3 ;
        $config['use_page_numbers'] = TRUE;
        $config['num_links']        = 1;
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']   = '<span aria-hidden="true"></span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']   = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close']  = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']   = '</span></li>';
        $config['total_rows']       = $this->data['count'];
        $config['per_page']         = $this->record_per_page;
        return $this->pagination->initialize($config);
    }

    public function datatables($valid_columns = Array(), $tbl_name, $filter=NULL, $join=NULL, $group_by=NULL) {
        $this->data['post_dataTables'] = [
            'draw' => intval($this->input->post("draw")),
            'start' => intval($this->input->post("start")),
            'length' => intval($this->input->post("length")),
            'order' => $this->input->post("order"),
            'search'=> $this->input->post("search")['value'],
            'col' => 0,
            'dir' => ""
        ];

            if(!empty($this->data['post_dataTables']['order'])) {
                foreach($this->data['post_dataTables']['order'] as $o) {
                    $this->data['post_dataTables']['col'] = $o['column'];
                    $this->data['post_dataTables']['dir']= $o['dir'];
                }
            }

            if($this->data['post_dataTables']['dir'] != "asc" && $this->data['post_dataTables']['dir'] != "desc") {
                $this->data['post_dataTables']['dir'] = "desc";
            }

            if(!isset($valid_columns[$this->data['post_dataTables']['col']])) {
                $this->data['post_dataTables']['order'] = null;
            }else {
                $this->data['post_dataTables']['order'] = $valid_columns[$this->data['post_dataTables']['col']];
            }

        $params = [
            'table'         =>  $tbl_name,
            'columns'       =>  $valid_columns,
            'limit'         =>  $this->data['post_dataTables']['length'],
            'offset'        =>  $this->data['post_dataTables']['start'],
            'order_val'     =>  $this->data['post_dataTables']['order'],
            'order_dir'     =>  $this->data['post_dataTables']['dir'],
            'search_val'    =>  $this->data['post_dataTables']['search'],
            'filter'        =>  $filter,
            'join'          =>  $join,
            'group_by'      =>  $group_by,
        ];

        $this->data['result'] = $this->admin->get_table($params);
        // $this->data['result'] = $this->admin->get_table($tbl_name, $valid_columns, $this->data['post_dataTables']['length'], $this->data['post_dataTables']['start'], $this->data['post_dataTables']['order'], $this->data['post_dataTables']['dir'], $this->data['post_dataTables']['search']);

        return $this->data;
    }

    public function show_sidebar()
    {
        $params = [
            'table' =>  'tbl_top_scorer',
        ];

        $result = $this->admin->get($params);

        foreach ($result as $key => $value) {
            $this->data['top_scorer'] = $value['content'];
        }

        return $this->data['top_scorer'];
    }
}