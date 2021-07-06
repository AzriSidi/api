<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiModel extends CI_Model{

	public function kutipanDB($kod,$tarikh){
		$this->db->select("*");
		$this->db->from('KUTIPAN.KUTIPAN');
		$this->db->where('KATEGORI', $kod);
		$this->db->where("TARIKH BETWEEN TO_DATE ('".$tarikh."', 'DD-MM-YYYY')");
		$this->db->where("TO_DATE ('".$tarikh."', 'DD-MM-YYYY') + 1");
		$this->db->where("STATUS","A");
		$query = $this->db->get();

		if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = "No Data";
        }
		$this->db->close();

		return $result;
	}

    public function getcekDB($account_no){
        $this->db->select("*");
        $this->db->from('SKB.CEK_KEMBALI');
        $this->db->where("ACCOUNT_NO","$account_no");
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = "No Data";
        }
        $this->db->close();

        return $result;
    }

    public function getpulangDB($account_no){
        $this->db->select("*");
        $this->db->from('SKB.PULANGBALIK_HASIL');
        $this->db->where("ACCOUNT_NO","$account_no");
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = "No Data";
        }
        $this->db->close();

        return $result;
    }

    public function getguamDB($account_no){
        $this->db->select("*");
        $this->db->from('SKB.GUAMAN');
        $this->db->where("ACCOUNT_NO","$account_no");
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = "No Data";
        }
        $this->db->close();

        return $result;
    }

	public function cekDB($input){
		$fiscal = $input['fiscal'];
		$transaction_date = $input['transaction_date'];
		$posting_date = $input['posting_date'];
		$tkh_batal = $input['tkh_batal'];

		$this->db->set('ACCOUNT_NO', $input['account_no']);
		$this->db->set('BILL_NO', $input['bill_no']);
		$this->db->set('RESIT_NO', $input['resit_no']);
		$this->db->set('FISCAL', "to_date('$fiscal','dd/mm/yyyy')",FALSE);
		$this->db->set('TRANSACTION_DATE',"to_date('$transaction_date','dd/mm/yyyy')",FALSE);
		$this->db->set('PAYMENT_METHOD', $input['payment_method']);
		$this->db->set('REF_NO', $input['ref_no']);
		$this->db->set('DEBIT_CREDIT', $input['debit_credit']);
		$this->db->set('TRANSACTION_CODE', $input['transaction_code']);
		$this->db->set('AMOUNT', $input['amount']);
		$this->db->set('DESC_DEBIT_CREDIT', $input['desc_debit_credit']);
		$this->db->set('VOT', $input['vot']);
		$this->db->set('COST_CENTRE', $input['cost_centre']);
		$this->db->set('ACCRUAL', $input['accrual']);
		$this->db->set('POSTING_DATE',"to_date('$posting_date','dd/mm/yyyy')",FALSE);
		$this->db->set('BATCH_NO', $input['batch_no']);
		$this->db->set('HUTANG_LAPUK', $input['hutang_lapuk']);
		$this->db->set('TKH_BATAL',"to_date('$tkh_batal','dd/mm/yyyy')",FALSE);
		$this->db->set('SEBAB_BATAL', $input['sebab_batal']);
		$this->db->set('PAYER_NAME' ,$input['payer_name']);
		$this->db->set('PHONE_NO', $input['phone_no']);
		$this->db->set('TRANSACTION_TYPE', $input['transaction_type']);
		$this->db->set('SUB_AKAUN', $input['sub_akaun']);
		$this->db->insert("SKB.CEK_KEMBALI");

		if($this->db->affected_rows() > 0){
            $mgs = "success";
        }else{
            $mgs = "no affected row";
        }
        $this->db->close();

    	return $mgs;
	}

	public function pulangDB($input){
        $fiscal = $input['fiscal'];
		$transaction_date = $input['transaction_date'];
		$posting_date = $input['posting_date'];
		$tkh_baucer = $input['tkh_baucer'];
		$refund_date = $input['refund_date'];

		$this->db->set('ACCOUNT_NO', $input['account_no']);
		$this->db->set('BILL_NO', $input['bill_no']);
		$this->db->set('RESIT_NO', $input['resit_no']);
		$this->db->set('FISCAL', "to_date('$fiscal','dd/mm/yyyy')",FALSE);
		$this->db->set('TRANSACTION_DATE',"to_date('$transaction_date','dd/mm/yyyy')",FALSE);
		$this->db->set('PAYMENT_METHOD', $input['payment_method']);
		$this->db->set('REF_NO', $input['ref_no']);
		$this->db->set('DEBIT_CREDIT', $input['debit_credit']);
		$this->db->set('TRANSACTION_CODE', $input['transaction_code']);
		$this->db->set('AMOUNT', $input['amount']);
		$this->db->set('DESC_DEBIT_CREDIT', $input['desc_debit_credit']);
		$this->db->set('VOT', $input['vot']);
		$this->db->set('COST_CENTRE', $input['cost_centre']);
		$this->db->set('ACCRUAL', $input['accrual']);
		$this->db->set('POSTING_DATE',"to_date('$posting_date','dd/mm/yyyy')",FALSE);
		$this->db->set('BATCH_NO', $input['batch_no']);
		$this->db->set('HUTANG_LAPUK', $input['hutang_lapuk']);
		$this->db->set('TKH_BAUCER',"to_date('$tkh_baucer','dd/mm/yyyy')",FALSE);
		$this->db->set('NO_BAUCER', $input['no_baucer']);
		$this->db->set('BANK_NAME', $input['bank_name']);
		$this->db->set('REFUND_DATE', "to_date('$refund_date','dd/mm/yyyy')",FALSE);
		$this->db->set('PAYER_NAME', $input['payer_name']);
		$this->db->set('PHONE_NO', $input['phone_no']);
		$this->db->set('REASON', $input['reason']);
		$this->db->set('TRANSACTION_TYPE', $input['transaction_type']);
		$this->db->set('SUB_AKAUN', $input['sub_akaun']);
        $this->db->insert("SKB.PULANGBALIK_HASIL");

        if($this->db->affected_rows() > 0){
            $mgs = "success";
        }else{
            $mgs = "no affected row";
        }
        $this->db->close();

    	return $mgs;
	}

	public function guamanDB($input){
		$transaction_date = $input['transaction_date'];
        $fiscal = $input['fiscal'];
		$posting_date = $input['posting_date'];

		$this->db->set('ACCOUNT_NO', $input['account_no']);
		$this->db->set('BILL_NO', $input['bill_no']);
		$this->db->set('TRANSACTION_DATE',"to_date('$transaction_date','dd/mm/yyyy')",FALSE);
		$this->db->set('FISCAL',"to_date('$fiscal','dd/mm/yyyy')",FALSE);
		$this->db->set('TRANSACTION_CODE', $input['transaction_code']);		
		$this->db->set('DESC_DEBIT_CREDIT', $input['desc_debit_credit']);
		$this->db->set('AMOUNT', $input['amount']);
		$this->db->set('POSTING_DATE',"to_date('$posting_date','dd/mm/yyyy')",FALSE);
        $this->db->insert("SKB.GUAMAN");

        if($this->db->affected_rows() > 0){
            $mgs = "success";
        }else{
            $mgs = "no affected row";
        }
        $this->db->close();

    	return $mgs;
	}

	function hutanglapukDB($account_no){
        $this->db->select("'x'");
        $this->db->from("CUKAI.AKAUN_SEMASA_SB");
        $this->db->where("NO_AKAUN", $account_no);
        $query = $this->db->get();

        $this->db->set('TKH_KEMASKINI',"to_date(sysdate,'dd/mm/yyyy')",FALSE);
        $this->db->set('FLAG_LAPUK', '1');
        $this->db->where('NO_AKAUN', $account_no);

        if($query->num_rows() > 0){
            $this->db->update("CUKAI.AKAUN_SEMASA_SB");
            if($this->db->affected_rows() > 0){
                $mgs = "success";
            }else{
                $mgs = "no affected row";
            }
        } else {
            $mgs = "account number not exist";
        }
        $this->db->close();

        return $mgs;
	}
	
	function rejectJournalDB($input){
		$tkh_journal = $input['tkh_journal'];
		
		$this->db->set('NO_JOURNAL', $input['no_journal']);
		$this->db->set('TARIKH_JOURNAL',"to_date('$tkh_journal','dd/mm/yyyy')",FALSE);
		$this->db->set('STATUS_PINDA', 'N');
		$this->db->insert("SKB.REJECT_JOURNAL");
		if($this->db->affected_rows() > 0){
			$mgs = "success";
		}else{
			$mgs = "no affected row";
		}
        
        $this->db->close();
    	return $mgs;
	}
	
	function checkRejectJournalDB($no_journal){
        $this->db->select("NO_JOURNAL,TARIKH_JOURNAL,STATUS_PINDA");
        $this->db->from('SKB.REJECT_JOURNAL');
        $this->db->where("NO_JOURNAL","$no_journal");
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = "No Data";
        }
        $this->db->close();

		return $result;
	}

	public function kutipBatalDB($input){
        $fiscal = $input['fiscal'];
		$transaction_date = $input['transaction_date'];
		$posting_date = $input['posting_date'];
		$tkh_batal = $input['tkh_batal'];

		$this->db->set('ACCOUNT_NO', $input['account_no']);
		$this->db->set('BILL_NO', $input['bill_no']);
		$this->db->set('RESIT_NO', $input['resit_no']);
		$this->db->set('FISCAL', "to_date('$fiscal','dd/mm/yyyy')",FALSE);
		$this->db->set('TRANSACTION_DATE',"to_date('$transaction_date','dd/mm/yyyy')",FALSE);
		$this->db->set('PAYMENT_METHOD', $input['payment_method']);
		$this->db->set('REF_NO', $input['ref_no']);
		$this->db->set('DEBIT_CREDIT', $input['debit_credit']);
		$this->db->set('TRANSACTION_CODE', $input['transaction_code']);
		$this->db->set('AMOUNT', $input['amount']);
		$this->db->set('VOT', $input['vot']);
		$this->db->set('COST_CENTRE', $input['cost_centre']);
		$this->db->set('POSTING_DATE',"to_date('$posting_date','dd/mm/yyyy')",FALSE);
		$this->db->set('BATCH_NO', $input['batch_no']);
		$this->db->set('TKH_BATAL',"to_date('$tkh_batal','dd/mm/yyyy')",FALSE);
		$this->db->set('SEBAB_BATAL', $input['sebab_batal']);
		$this->db->set('TRANSACTION_TYPE', $input['transaction_type']);
		$this->db->set('FLAG_BATAL', $input['flag_batal']);
		$this->db->set('BANK_CODE', $input['bank_code']);
        $this->db->insert("SKB.KUTIPAN_BATAL");

        if($this->db->affected_rows() > 0){
            $mgs = "success";
        }else{
            $mgs = "no affected row";
        }
        $this->db->close();

    	return $mgs;
	}

	function checkKutipBatalDB($no_journal){
        $this->db->select("*");
        $this->db->from('SKB.KUTIPAN_BATAL');
        $this->db->where("ACCOUNT_NO","$no_journal");
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $result = $query->result();
        } else {
            $result = "No Data";
        }
        $this->db->close();

		return $result;
	}

	function updatePayCukaiDB($input){	
		$checkInput = in_array("", $input, true);
		if(!$checkInput){	
			$tkh_bayar = $input['tkh_bayar'];

			$this->db->set('NO_AKAUN', $input['no_akaun'])
					->set('TKH_BAYAR',"to_date('$tkh_bayar','YYYY-MM-DD HH24:MI:SS')",FALSE)
					->set('STESYEN', $input['stesyen'])
					->set('KATEGORI', $input['kategori'])
					->set('AMAUN_BAYAR', $input['amaun'])
					->set('JENIS_BAYAR', $input['jenis_bayar'])
					->set('NO_RESIT', $input['no_resit'])
					->set('STATUS', $input['status'])
					->insert("SUBSISTEM.OUTPUT_STAGING_TABLE");
			$mgs = "success";
		}else{
			$mgs = "fail";
		}
        
        $this->db->close();
    	return $mgs;
	}

	function updateKontraDB($input){	
		$checkInput = in_array("", $input, true);
		if(!$checkInput){	
			$tkh_bayar = $input['tkh_bayar'];

			$this->db->set('NO_AKAUN', $input['no_akaun'])
					->set('TKH_BAYAR',"to_date('$tkh_bayar','YYYY-MM-DD HH24:MI:SS')",FALSE)
					->set('STESYEN', $input['stesyen'])
					->set('KATEGORI', $input['kategori'])
					->set('AMAUN_BAYAR', $input['amaun'])
					->set('JENIS_BAYAR', $input['jenis_bayar'])
					->set('NO_RESIT', $input['no_resit'])
					->set('STATUS', $input['status'])
					->set('ID_NO', $input['id_no'])
					->insert("SKB.KONTRA");
			$mgs = "success";
		}else{
			$mgs = "fail";
		}
        
        $this->db->close();
    	return $mgs;
	}

	function ipayDataDB($input){	
		$checkInput = in_array("", $input, true);
		if(!$checkInput){	
			$tarikh = $input['tarikh'];

			$this->db->set('NO_AKAUN', $input['no_akaun'])
					->set('KP', $input['kp'])
					->set('NO_PHONE', $input['no_phone'])
					->set('EMAIL', $input['email'])
					->set('TARIKH',"to_date('$tarikh','YYYY-MM-DD HH24:MI:SS')",FALSE)
					->set('STATUS', $input['status'])
					->insert("SUBSISTEM.IPAY_DATA");
			$mgs = "success";
		}else{
			$mgs = "fail";
		}
        
        $this->db->close();
    	return $mgs;
	}
}
