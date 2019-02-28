<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
use api\libraries\REST_Controller;

class ApiController extends REST_Controller {

    public function index(){
        echo "This is home controller";
    }

    function cekkembali_get() {
        $date = date('d/m/Y', time());
        $data[] = array('account_no'=>'string', 'bill_no'=>'string' , 'resit_no'=>'string',
            'fiscal'=>$date, 'transaction_date'=>$date, 'payment_method'=>'8',
            'ref_no'=>'string', 'debit_credit'=>'DR', 'transaction_code'=>'001',
            'amount'=>'0.00', 'desc_debit_credit'=>'string', 'vot'=>'string',
            'cost_centre'=>'string', 'accrual'=>'1', 'posting_date'=>$date,
            'batch_no'=>'string', 'hutang_lapuk'=>'0' , 'tkh_batal'=>$date,
            'sebab_batal'=>'string');
        $this->response($data);
    }

    function pulangbalik_get(){
        $date = date('d/m/Y', time());
        $data[] = array('account_no'=>'string', 'bill_no'=>'string' , 'resit_no'=>'string',
            'fiscal'=>$date, 'transaction_date'=>$date, 'payment_method'=>'8',
            'ref_no'=>'string', 'debit_credit'=>'DR', 'transaction_code'=>'1',
            'amount'=>'0.00', 'desc_debit_credit'=>'string', 'vot'=>'string',
            'cost_centre'=>'string', 'accrual'=>'1', 'posting_date'=>$date,
            'batch_no'=>'string', 'hutang_lapuk'=>'0' , 'tkh_baucer'=>$date,
            'no_baucer'=>'string');
        $this->response($data);
    }

    function guaman_get(){
        $date = date('d/m/Y', time());
        $data[] = array('account_no'=>'string', 'bill_no'=>'string',
            'transaction_date'=>$date, 'fiscal'=>$date,
            'transaction_code'=>'509', 'desc_debit_credit'=>'string',
            'amount'=>'0.00', 'posting_date'=>$date);
        $this->response($data);
    }

    function hutanglapuk_get(){
        $data[] = array('account_no'=>'string');
        $this->response($data);
    }

    public function getKutipan_get() {
        $kod = $this->uri->segment('3');
        $tarikh = $this->uri->segment('5');
        $this->load->model('ApiModel');
        $db['records'] = $this->ApiModel->kutipanDB($kod,$tarikh);
        $this->load->view('KutipanView',$db);
    }

    function getcekkembali_get(){
        $account_no = $this->get('account_no');
        $this->load->model('ApiModel');
        $data['CEK_KEMBALI'] = $this->ApiModel->getcekDB($account_no);
        $this->response($data);
    }

    function getpulangbalik_get(){
        $account_no = $this->get('account_no');
        $this->load->model('ApiModel');
        $data['PULANG_BALIK_HASIL'] = $this->ApiModel->getpulangDB($account_no);
        $this->response($data);
    }

    function getguaman_get(){
        $account_no = $this->get('account_no');
        $this->load->model('ApiModel');
        $data['GUAMAN'] = $this->ApiModel->getguamDB($account_no);
        $this->response($data);
    }
     
    function cekkembali_post() {
        $items = json_decode(json_encode($this->post()));
        foreach($items as $item){
            $input['account_no'] = $item->account_no;
            $input['bill_no'] = $item->bill_no;
            $input['resit_no'] = $item->resit_no;
            $input['fiscal'] = $item->fiscal;
            $input['transaction_date'] = $item->transaction_date;
            $input['payment_method'] = $item->payment_method;
            $input['ref_no'] = $item->ref_no;
            $input['debit_credit'] = $item->debit_credit;
            $input['transaction_code'] = $item->transaction_code;
            $input['amount'] = $item->amount;
            $input['desc_debit_credit'] = $item->desc_debit_credit;
            $input['vot'] = $item->vot;
            $input['cost_centre'] = $item->cost_centre;
            $input['accrual'] = $item->accrual;
            $input['posting_date'] = $item->posting_date;
            $input['batch_no'] = $item->batch_no;
            $input['hutang_lapuk'] = $item->hutang_lapuk;
            $input['tkh_batal'] = $item->tkh_batal;
            $input['sebab_batal'] = $item->sebab_batal;

            $this->load->model('ApiModel');
            $data['message'] = $this->ApiModel->CekDB($input);
        }
        $this->response($data);
    }    

    function pulangbalik_post(){
        $items = json_decode(json_encode($this->post()));
        foreach($items as $item){
            $input['account_no'] = $item->account_no;
            $input['bill_no'] = $item->bill_no;
            $input['resit_no'] = $item->resit_no;
            $input['fiscal'] = $item->fiscal;
            $input['transaction_date'] = $item->transaction_date;
            $input['payment_method'] = $item->payment_method;
            $input['ref_no'] = $item->ref_no;
            $input['debit_credit'] = $item->debit_credit;
            $input['transaction_code'] = $item->transaction_code;
            $input['amount'] = $item->amount;
            $input['desc_debit_credit'] = $item->desc_debit_credit;
            $input['vot'] = $item->vot;
            $input['cost_centre'] = $item->cost_centre;
            $input['accrual'] = $item->accrual;
            $input['posting_date'] = $item->posting_date;
            $input['batch_no'] = $item->batch_no;
            $input['hutang_lapuk'] = $item->hutang_lapuk;
            $input['tkh_batal'] = $item->tkh_batal;
            $input['no_baucer'] = $item->no_baucer;

            $this->load->model('ApiModel');
            $data['message'] = $this->ApiModel->pulangDB($input);
        }
        $this->response($data);
    }

    function guaman_post(){
        $items = json_decode(json_encode($this->post()));
        foreach($items as $item){
            $input['account_no'] = $item->account_no;
            $input['bill_no'] = $item->bill_no;
            $input['transaction_date'] = $item->transaction_date;
            $input['fiscal'] = $item->fiscal;
            $input['transaction_code'] = $item->transaction_code;
            $input['desc_debit_credit'] = $item->desc_debit_credit;
            $input['amount'] = $item->amount;
            $input['posting_date'] = $item->posting_date;

            $this->load->model('ApiModel');
            $data['message'] = $this->ApiModel->guamanDB($input);
        }
        $this->response($data);
    }

    function hutanglapuk_post(){
        $items = json_decode(json_encode($this->post()));
        foreach($items as $item){
            $account_no = $item->account_no;
            $this->load->model('ApiModel');
            $data['message'] = $this->ApiModel->hutanglapukDB($account_no);
        }
        $this->response($data);
    }
}