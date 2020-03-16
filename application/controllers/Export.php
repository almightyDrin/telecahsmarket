<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require './vendor/autoload.php';
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Style\Alignment;
use \PhpOffice\PhpSpreadsheet\Style\Conditional;
use \PhpOffice\PhpSpreadsheet\Style\Fill;
use \PhpOffice\PhpSpreadsheet\Style\Color;
 
class Export extends MX_Controller {

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

    public function index()
    {       
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'something !');
        
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $this->data['session']['cashmarket'] .'_customers.xlsx"'); 
 
        $writer->save('php://output'); // will create and save the file in the root of the project
 
    }
 
    public function customers( $ts=NULL )
    {
        $this->is_logged_in();
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load("./assets/spreadsheet-layout/customers.xlsx");
        $sheet = $spreadsheet->getActiveSheet();
        $start_row = 5;
        $content_row = 5;
        $file_name_prefix = $this->data['session']['cashmarket'];
        $params = [
            'columns'   =>  'deposit, full_name, email, contact_num, ts_attended, cashmarket, created_date',
            'table'     =>  'tbl_customers',
            'order_col' =>  [
                'cashmarket'    =>  'asc',
                'full_name'     =>  'asc'
            ],
        ];
        if ( $this->data['session']['cashmarket'] !== 'all' ) {
            $params['where_col'] = ['cashmarket'    =>  $this->data['session']['cashmarket'],];
        }
        if ( !is_null( $ts ) ) {
            if ( isset($params['where_col']) ) {
                $params['where_col']  +=  ['ts_attended'   =>  $ts,];
            }else {
                $params['where_col']  =  ['ts_attended'   =>  $ts,];
            }
            $file_name_prefix = $ts;
        }

        $result = $this->admin->get($params);
        // print_return($result);exit;

        /* Fill Content Cells */
        $sheet->setCellValue('A1', strtoupper($this->data['session']['cashmarket'].' customers') );
        foreach ($result as $key => $value) {
            $sheet->insertNewRowBefore($content_row+1, 1);
            $sheet->setCellValue('A'.$content_row, ($value['deposit'] === '1') ? 'Yes' : 'N/A' )
                  ->setCellValue('B'.$content_row, $value['full_name'])
                  ->setCellValue('C'.$content_row, $value['email'])
                  ->setCellValue('D'.$content_row, $value['contact_num'])
                  ->setCellValue('E'.$content_row, $value['ts_attended'])
                  ->setCellValue('F'.$content_row, $value['cashmarket'])
                  ->setCellValue('G'.$content_row, date("F j, Y, g:i a", strtotime($value['created_date'])));
            $content_row++;
        }

        /* Remove Last Emptry Rows */
        $sheet->removeRow($content_row+2, 2);
        

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $file_name_prefix .'_customers.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output'); // download file 
 
    }

    public function telesales()
    {
        $this->is_logged_in();
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load("./assets/spreadsheet-layout/telesales.xlsx");
        $sheet = $spreadsheet->getActiveSheet();
        $start_row = 5;
        $content_row = 5;
        $file_name_prefix = $this->data['session']['cashmarket'];
        $params = [
            'columns'   =>  'U.username, U.cashmarket, U.created_date, C.attended',
            'table'     =>  'tbl_user AS U',
            'join'      =>  [
                '(SELECT COUNT(*) AS attended, ts_attended FROM tbl_customers GROUP BY ts_attended ORDER BY attended DESC) AS C' 
                => 'U.username = C.ts_attended|left'
            ],
            'where_col' =>  [
                'acc_level' =>  '0555'
            ],
            'order_col' =>  [
                'cashmarket'    =>  'asc',
                'username'     =>  'asc'
            ]
        ];
        if ( $this->data['session']['cashmarket'] !== 'all' ) $params['where_col'] += [
            'cashmarket'    =>  $this->data['session']['cashmarket']
        ];
        $result = $this->admin->get($params);

        /* Fill Content Cells */
        $sheet->setCellValue('A1', strtoupper($this->data['session']['cashmarket'].' telesales') );
        foreach ($result as $key => $value) {
            $sheet->insertNewRowBefore($content_row+1, 1);
            $sheet->setCellValue('A'.$content_row, $value['username'])
                  ->setCellValue('B'.$content_row, $value['cashmarket'])
                  ->setCellValue('C'.$content_row, ($value['attended']) ?? '0')
                  ->setCellValue('D'.$content_row, date("F j, Y, g:i a", strtotime($value['created_date'])));
            $content_row++;
        }

        /* Remove Last Emptry Rows */
        $sheet->removeRow($content_row+2, 2);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $file_name_prefix .'_telesales.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output'); // download file 
    }
}