<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';
use api\libraries\REST_Controller;

class ApiController extends REST_Controller {

    public function index(){
        echo "This is home controller";
	}
	
	public function __construct(){
            parent::__construct();
			// Your own constructor code
			$this->load->model('ApiModel');
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
        $db['records'] = $this->ApiModel->kutipanDB($kod,$tarikh);
        $this->load->view('KutipanView',$db);
    }

    function getcekkembali_get($account_no){
        $data['CEK_KEMBALI'] = $this->ApiModel->getcekDB($account_no);
        $this->response($data);
    }

    function getpulangbalik_get($account_no){
        $data['PULANG_BALIK_HASIL'] = $this->ApiModel->getpulangDB($account_no);
        $this->response($data);
    }

    function getguaman_get($account_no){
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
			$input['payer_name'] = $item->payer_name;
			$input['phone_no'] = $item->phone_no;
			$input['transaction_type'] = $item->transaction_type;
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
            $input['tkh_baucer'] = $item->tkh_baucer;
			$input['no_baucer'] = $item->no_baucer;
			$input['bank_name'] = $item->bank_name;
			$input['refund_date'] = $item->refund_date;
			$input['payer_name'] = $item->payer_name;
			$input['phone_no'] = $item->phone_no;
			$input['reason'] = $item->reason;
			$input['transaction_type'] = $item->transaction_type;
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
            $data['message'] = $this->ApiModel->guamanDB($input);
        }
        $this->response($data);
    }

    function hutanglapuk_post(){
        $items = json_decode(json_encode($this->post()));
        foreach($items as $item){
            $account_no = $item->account_no;
            $data['message'] = $this->ApiModel->hutanglapukDB($account_no);
        }
        $this->response($data);
	}
	
	function rejectJournal_post(){
        $items = json_decode(json_encode($this->post()));
        foreach($items as $item){
			$input['no_journal'] = $item->no_journal;
			$input['tkh_journal'] = $item->tkh_journal;
            $data['message'] = $this->ApiModel->rejectJournalDB($input);
        }
        $this->response($data);
	}
	
	function checkRejectJournal_get($no_journal){
        $data['rejectJournal'] = $this->ApiModel->checkRejectJournalDB($no_journal);
        $this->response($data);
    }
	
	function kutipBatal_post(){
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
            $input['vot'] = $item->vot;
			$input['cost_centre'] = $item->cost_centre;
			$input['posting_date'] = $item->posting_date;
			$input['batch_no'] = $item->batch_no;
            $input['tkh_batal'] = $item->tkh_batal;
            $input['sebab_batal'] = $item->sebab_batal;
            $input['transaction_type'] = $item->transaction_type;
            $input['flag_batal'] = $item->flag_batal;
            $input['bank_code'] = $item->bank_code;
			$data['message'] = $this->ApiModel->kutipBatalDB($input);
        }
        $this->response($data);
	}

	function checkKutipBatal_get($no_journal){
        $data['kutipan_batal'] = $this->ApiModel->checkKutipBatalDB($no_journal);
        $this->response($data);
	}
	
	function updatePayCukai_post(){
		$items = json_decode(json_encode($this->post()));
        foreach($items as $item){
			$input['no_akaun'] = $item->no_akaun;
			$input['tkh_bayar'] = $item->tkh_bayar;
			$input['stesyen'] = $item->stesyen;
			$input['kategori'] = $item->kategori;
			$input['amaun'] = $item->amaun;
			$input['jenis_bayar'] = $item->jenis_bayar;
			$input['no_resit'] = $item->no_resit;
			$input['status'] = $item->status;
            $data['message'] = $this->ApiModel->updatePayCukaiDB($input);
        }
    	$this->response($data);
	}

	function updateKontra_post(){
		$items = json_decode(json_encode($this->post()));
        foreach($items as $item){
			$input['no_akaun'] = $item->no_akaun;
			$input['tkh_bayar'] = $item->tkh_bayar;
			$input['stesyen'] = $item->stesyen;
			$input['kategori'] = $item->kategori;
			$input['amaun'] = $item->amaun;
			$input['jenis_bayar'] = $item->jenis_bayar;
			$input['no_resit'] = $item->no_resit;
            $input['status'] = $item->status;
            $input['id_no'] = $item->id_no;
            $data['message'] = $this->ApiModel->updateKontraDB($input);
        }
    	$this->response($data);
	}
}
