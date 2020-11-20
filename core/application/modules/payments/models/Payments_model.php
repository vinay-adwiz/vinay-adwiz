<?php defined('BASEPATH') || exit('No direct script access allowed');

class Payments_model extends BF_Model
{
    protected $table_name	= 'payment';
	protected $key			= 'id';
	protected $date_format	= 'datetime';

	protected $log_user 	= false;
	protected $set_created	= false;
	protected $set_modified = false;
	protected $soft_deletes	= false;


	// Customize the operations of the model without recreating the insert,
    // update, etc. methods by adding the method names to act as callbacks here.
	protected $before_insert 	= array();
	protected $after_insert 	= array();
	protected $before_update 	= array();
	protected $after_update 	= array();
	protected $before_find 	    = array();
	protected $after_find 		= array();
	protected $before_delete 	= array();
	protected $after_delete 	= array();

	// For performance reasons, you may require your model to NOT return the id
	// of the last inserted row as it is a bit of a slow method. This is
    // primarily helpful when running big loops over data.
	protected $return_insert_id = true;

	// The default type for returned row data.
	protected $return_type = 'object';

	// Items that are always removed from data prior to inserts or updates.
	protected $protected_attributes = array();

	// You may need to move certain rules (like required) into the
	// $insert_validation_rules array and out of the standard validation array.
	// That way it is only required during inserts, not updates which may only
	// be updating a portion of the data.
	protected $validation_rules 		= array(
		array(
			'field' => 'payment_id',
			'label' => 'lang:payments_field_payment_id',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'reference_number',
			'label' => 'lang:payments_field_reference_number',
			'rules' => 'required|unique[bf_payment.reference_number,bf_payment.id]|alpha_numeric|max_length[16]',
		),
		array(
			'field' => 'payment_status',
			'label' => 'lang:payments_field_payment_status',
			'rules' => 'required|alpha_numeric|max_length[3]',
		),
		array(
			'field' => 'amount',
			'label' => 'lang:payments_field_amount',
			'rules' => 'required|max_length[14]',
		),
		array(
			'field' => 'currency',
			'label' => 'lang:payments_field_currency',
			'rules' => 'required|alpha|max_length[3]',
		),
		array(
			'field' => 'reference_date',
			'label' => 'lang:payments_field_reference_date',
			'rules' => 'required|is_numeric|max_length[16]',
		),
		array(
			'field' => 'transaction_number',
			'label' => 'lang:payments_field_transaction_number',
			'rules' => 'max_length[64]',
		),
		array(
			'field' => 'approval_code',
			'label' => 'lang:payments_field_approval_code',
			'rules' => 'max_length[32]',
		),
		array(
			'field' => 'transaction_date',
			'label' => 'lang:payments_field_transaction_date',
			'rules' => 'trim|is_numeric|max_length[16]',
		),
	);
	protected $insert_validation_rules  = array();
	protected $skip_validation 			= false;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_payment($payment_data) {

		$this->db->insert($this->table_name, $payment_data);
		$payment_id = $this->db->insert_id();

		return $payment_id;

    }

    public function load_payment($reference_number) {

		$this->db->where('reference_number', $reference_number);
		$this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->order_by("id", "desc"); 
        $this->db->limit(1);
                
        $query = $this->db->get();
        $result = $query->result_array();
        
        if (empty($result)) {
        	return false;
        } else {
        	return $result[0];
        }

    }

    public function generate_SCB_URL($user_id, $payment_data) {

        $this->load->model('users/user_model');
        $user = $this->user_model->find_user_and_meta($user_id);

        $url = SCB_GATEWAY;
        
        $url .= '?mid=' . SCB_MERCHANT_ID;
        $url .= '&command=' . SCB_COMMAND_AUTH;
        $url .= '&terminal=' . SCB_TERMINAL;
        $url .= '&ref_date=' . $payment_data['reference_date'];
        $url .= '&ref_no=' . $payment_data['reference_number'];
        $url .= '&cust_id=';
        $url .= '&cur_abbr=' . SCB_CURRENCY;
        $url .= '&amount=' . $payment_data['amount'];
        $url .= '&cust_lname=' . $user->last_name;
        $url .= '&cust_fname=' . $user->first_name;
        $url .= '&cust_email=' . $user->email;
        $url .= '&cust_country=' . @$user->country;
        $url .= '&cust_address1=' . @$user->address_1;
        $url .= '&cust_address2=' . @$user->address_2;
        $url .= '&cust_city=' . @$user->city;
        $url .= '&cust_province=' . @$user->state;
        $url .= '&cust_zip=' . @$user->postcode;
        $url .= '&cust_phone=' . @$user->phone_number;
        $url .= '&description=' . $payment_data['description'];
        $url .= '&backURL=' . SCB_BACKURL . $payment_data['reference_number'] . '/'; 
        $url .= '&settlement_flag=';
        $url .= '&service_id=' . SCB_SERVICE_ID; 

        return $url;
    }

    public function generate_SCB_Enquiry_URL($payment_data) {

        $url = SCB_GATEWAY;        
        $url .= '?mid=' . SCB_MERCHANT_ID;
        $url .= '&command=' . SCB_COMMAND_ENQ;
		$url .= '&terminal=' . SCB_TERMINAL;
        $url .= '&ref_date=' . $payment_data['reference_date'];
        $url .= '&ref_no=' . $payment_data['reference_number'];
		$url .= '&cur_abbr=' . SCB_CURRENCY;
		$url .= '&amount=' . $payment_data['amount'];
        $url .= '&version=1';
        $url .= '&service_id=' . SCB_SERVICE_ID; 

        return $url;
    }

    public function get_scb_card_type($code) {

        switch ($code) {
            case 'C01':
                return 'Visa';
                break;
            case 'C02':
                return 'MasterCard';
                break;
            case 'C03':
                return 'JCB';
                break;
            case 'C04':
                return 'SCB';
                break;            
            default:
                return false;
                break;
        }
    }

    public function get_scb_response($code) {

        switch ($code) {
            case '002':
                return 'Host Approve';
                break;
            case '003':
                return 'Host Reject';
                break;
            case '004':
                return 'Settlement';
                break;
            case '005':
                return 'Cancel';
                break;            
            default:
                return false;
                break;
        }
    }

    // reference number made up of subscription id and date
    public function generate_reference_number($subscription_id) {
        return 'REF' . $subscription_id . date('ymd');
    }

    public function update_payment($payment_id, $data) {
        
        if (empty($data) === false) {
            $this->db->where('id', $payment_id);
            $this->db->update($this->table_name, $data); 
        }
        
        return true;
    }
}