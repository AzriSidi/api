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

        $this->db->set('TKH_KEMASKINI',"to_char(sysdate,'DD/MON/YY')",FALSE);
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
}