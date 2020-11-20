<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Student_subscriptions controller
 */
class Student_subscriptions extends Front_Controller
{
    protected $permissionCreate = 'Student_subscriptions.Student_subscriptions.Create';
    protected $permissionDelete = 'Student_subscriptions.Student_subscriptions.Delete';
    protected $permissionEdit   = 'Student_subscriptions.Student_subscriptions.Edit';
    protected $permissionView   = 'Student_subscriptions.Student_subscriptions.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('student_subscriptions/student_subscriptions_model');
        $this->lang->load('student_subscriptions');
        
        $this->load->library('form_validation');
        $this->load->library('users/auth');
        $this->load->model('users/user_model');

        Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
        Assets::add_js('jquery-ui-1.8.13.min.js');
        Assets::add_css('jquery-ui-timepicker.css');
        Assets::add_js('jquery-ui-timepicker-addon.js');
        
        $this->load->helper('curl');


        Assets::add_module_js('student_subscriptions', 'student_subscriptions.js');
    }

    /**
     * Display a list of Student Subscriptions data.
     *
     * @return void
     */
    public function index()
    {
        
        $records = $this->student_subscriptions_model->find_all();

        Template::set('records', $records);
        

        Template::render();
    }

    /**
     * Check response from SCB server
     *
     * @return void
     */
    public function response($reference_number)
    {

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        
        $this->load->model('payments/payments_model');

        // Load details by reference number
        $payment_details = $this->payments_model->load_payment($reference_number);
        $payment_id = $payment_details['id'];

        // check and reset lang to correct language if required
        if ( @$this->current_user->language !== 'thai') {
            $this->lang->is_loaded = array();
            $this->lang->language = array();
            $this->lang->load('application', $this->current_user->language);
        } 


        if ($payment_details) {

            $subscription_id = $payment_details['subscription_id'];

            // Get student id from subscription
            $subscription = $this->student_subscriptions_model->load_subscription($subscription_id);
            $student_id = $subscription['student_id'];

            $payment_data = array();
            $payment_data['amount'] = $payment_details['amount'];
            $payment_data['reference_number'] = $payment_details['reference_number'];
            $payment_data['reference_date'] = $payment_details['reference_date'];

            $scb_enquiry_url = $this->payments_model->generate_SCB_Enquiry_URL($payment_data);
            $scb_return = get_web_page($scb_enquiry_url);

            // Load details for email
            $student = $this->user_model->find_user_and_meta($student_id);
            $name = $student->first_name . " " . $student->last_name;
            $email = $student->email;
            $phone = $student->phone_number;
            $amount  = $payment_details['amount'];
            $url = EDIT_USER_URL . $student_id;

            $to = SUPPORT_EMAIL;
            $admin_details_array = array('name' => $name,
                                        'email' => $email, 
                                        'phone' => $phone,
                                        'payment_type' => 'SCB', 
                                        'amount' => $amount,
                                        'url'=>$url);

            
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <no-reply@englishgang.com>' . "\r\n";
            // End load details for email

            $this->load->library('email');
            $config = array(
                'protocol'  => 'mail',
                'smtp_host' => SMTP_SERVER,
                'smtp_port' => 465,
                'smtp_user' => SMTP_USERNAME,
                'smtp_pass' => SMTP_PASSWORD,
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            ); 
            
            $admin_to = SUPPORT_EMAIL;

            if ($scb_return['http_code'] == 200) {

                $scb_ret = $scb_return['content'];
                parse_str($scb_ret, $scb_output);

                if (is_array($scb_output) && isset($scb_output['payment_status'])) {

                    $sub_data_update = array();
                    $sub_data_update['payment_id'] = $payment_id;

                    $payment_data_update = array();
                    $payment_data_update['payment_status'] = $scb_output['payment_status'];

                    $admin_to = ADMIN_CLASS_NOTIFICATION;

                    if ($scb_output['payment_status'] == '002') { // Approved
                        
                        // Update new subscription to status 
                        $sub_data_update['status'] = SUBSCRIPTION_STATUS_ACTIVE;
                        $this->student_subscriptions_model->update_subscription($subscription_id, $sub_data_update);

                        // Update payment
                        $payment_data_update['transaction_number'] = $scb_output['trans_no']; 
                        $payment_data_update['approval_code'] = $scb_output['appr_code']; 
                        $payment_data_update['payment_type'] = $scb_output['payment_type']; 
                        $payment_data_update['transaction_date'] = $scb_output['trans_date']; 
                        $this->payments_model->update_payment($payment_id, $payment_data_update);

                        $message = $this->load->view('_emails/payment_successful',$admin_details_array, TRUE);
                        $subject = "Successful Payment";

                        $this->email->clear();
                        $this->email->initialize($config);
                        $this->email->set_mailtype("html");
                        $this->email->set_newline("\r\n");
                        
                        $this->email->to($admin_to);
                        $this->email->from(SUPPORT_EMAIL, EMAIL_FROM);
                        $this->email->subject($subject);
                        $this->email->message($message);
                        $this->email->send();
                        
                        // $this->session->set_flashdata('subscription_id',$subscription_id);
                        // Template::redirect('/users/book_new_class');

                        Template::set_message(lang('subscription_payment_accepted'), 'success');    

                    } else { // Declined

                        // Update new subscription to status payment failed
                        $sub_data_update['status'] = SUBSCRIPTION_STATUS_PAYMENT_FAILED;
                        $this->student_subscriptions_model->update_subscription($subscription_id, $sub_data_update);

                        // Update payment
                        $this->payments_model->update_payment($payment_id, $payment_data_update);

                        $subject = "Unsuccessful Payment";
                        $message = $this->load->view('_emails/payment_unsuccessful',$admin_details_array, TRUE);
                        
                        $this->email->clear();
                        $this->email->initialize($config);
                        $this->email->set_mailtype("html");
                        $this->email->set_newline("\r\n");

                        $this->email->to($admin_to);
                        $this->email->from(SUPPORT_EMAIL, EMAIL_FROM);
                        $this->email->subject($subject);
                        $this->email->message($message);
                        $this->email->send();

                        Template::set_message(lang('subscription_payment_failed'), 'error');
                    }


                } else {

                    $message = $this->load->view('_emails/payment_unsuccessful',$admin_details_array, TRUE);
                    $subject = "Unsuccessful Payment";
                    
                    $this->email->clear();
                    $this->email->initialize($config);
                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");

                    $this->email->to($admin_to);
                    $this->email->from(SUPPORT_EMAIL, EMAIL_FROM);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $this->email->send();

                    // Incomplete response from server
                    Template::set_message(lang('error_processing_payment'), 'error');
                }

            } else {

                $message = $this->load->view('_emails/payment_unsuccessful',$admin_details_array, TRUE);
                $subject = "Unsuccessful Payment";

                $this->email->clear();
                $this->email->initialize($config);
                $this->email->set_mailtype("html");
                $this->email->set_newline("\r\n");

                $this->email->to($admin_to);
                $this->email->from(SUPPORT_EMAIL, EMAIL_FROM);
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();

                // Not a 200 response from server
                Template::set_message(lang('error_processing_payment'), 'error');
            }


        } else {

            // Invalid reference number
            Template::set_message(lang('invalid_refererence_number'), 'error');
        }

        Template::set_view('response');
        Template::render();

    }
    
    public function response_2c2p(){
        
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        
        $this->load->model('payments/payments_model');
        
        if ( @$this->current_user->language !== 'thai') {
            $this->lang->is_loaded = array();
            $this->lang->language = array();
            $this->lang->load('application', $this->current_user->language);
        } 

        if($this->input->post()){
            
            if($this->input->post('payment_status')){
                
                $subscription_id = $this->input->post('order_id');

                // Load details for email
                $_subscription = $this->student_subscriptions_model->load_subscription($subscription_id);
                $student_id = $_subscription['student_id'];

                $student = $this->user_model->find_user_and_meta($student_id);
                $name = $student->first_name . " " . $student->last_name;
                $email = $student->email;
                $phone = $student->phone_number;
                $amount  = $payment_details['amount'];
                $url = EDIT_USER_URL . $student_id;

                $to = SUPPORT_EMAIL;
                $admin_details_array = array('name' => $name,
                                            'email' => $email, 
                                            'phone' => $phone,
                                            'payment_type' => '2C2P', 
                                            'amount' => $amount,
                                            'url'=>$url);

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // More headers
                $headers .= 'From: <no-reply@englishgang.com>' . "\r\n";
                // End load details for email

                $this->db->where('subscription_id', $subscription_id);
        		$this->db->select("*");
                $this->db->from('payment');
                $this->db->order_by("id", "desc"); 
                $this->db->limit(1);
                        
                $query = $this->db->get();
                $payment_details = $query->row();
                
                $payment_id = $payment_details->id;
    
                $data = array();
                $data['amount'] = $payment_details->amount;
                $data['reference_number'] = $payment_details->reference_number;
                $data['reference_date'] = $payment_details->reference_date;
                
                //$data['reference_date'] = $this->input->post('request_timestamp');
                $data['gateway_version'] = $this->input->post('version');
                //$data['currency'] = $this->input->post('currency');
                //$data['subscription_id'] = $this->input->post('order_id');
                //$amount = ltrim($this->input->post('amount'), '0');
                //$data['amount'] = substr($amount, 0, -2);
                //$data['reference_number'] = $this->input->post('invoice_no');
                $data['transaction_number'] = $this->input->post('transaction_ref');
                $data['approval_code'] = $this->input->post('approval_code');
                $transaction_datetime = $this->input->post('transaction_datetime');
                $data['transaction_date'] = date("YmdHis", strtotime($transaction_datetime));
                $data['payment_channel'] = $this->input->post('payment_channel');
                $data['payment_status'] = $this->input->post('payment_status');
                $data['channel_response_code'] = $this->input->post('channel_response_code');
                $data['channel_response_desc'] = $this->input->post('channel_response_desc');
                $data['payment_scheme'] = $this->input->post('payment_scheme');
                $data['hash_value'] = $this->input->post('hash_value');
                
                $updated_details = $this->payments_model->update_payment($payment_id,$data);
                
                switch($this->input->post('payment_status')){
                    case '000':

                        $message = $this->load->view('_emails/payment_successful',$admin_details_array, TRUE);
                        $subject = "Successful Payment";
                        mail($to,$subject,$message,$headers);

                        $sub_data_update['status'] = SUBSCRIPTION_STATUS_ACTIVE;
                        $this->student_subscriptions_model->update_subscription($subscription_id, $sub_data_update);
                        
                        // $this->session->set_flashdata('subscription_id',$subscription_id);
                        // Template::redirect('/users/book_new_class');
                        
                        Template::set_message(lang('subscription_payment_accepted'), 'success');              
                    break;
                    case '001':

                        $message = $this->load->view('_emails/payment_unsuccessful',$admin_details_array, TRUE);
                        $subject = "Unsuccessful Payment";
                        mail($to,$subject,$message,$headers);

                        $sub_data_update['status'] = SUBSCRIPTION_STATUS_PENDING;
                        $this->student_subscriptions_model->update_subscription($subscription_id, $sub_data_update);
                        Template::set_message(lang('subscription_payment_pending'), 'error');
                    break;
                    case '002':

                        $message = $this->load->view('_emails/payment_unsuccessful',$admin_details_array, TRUE);
                        $subject = "Unsuccessful Payment";
                        mail($to,$subject,$message,$headers);

                        $sub_data_update['status'] = SUBSCRIPTION_STATUS_PAYMENT_FAILED;
                        $this->student_subscriptions_model->update_subscription($subscription_id, $sub_data_update);
                        Template::set_message(lang('subscription_payment_rejected'), 'error');
                    break;
                    case '003':

                        $message = $this->load->view('_emails/payment_unsuccessful',$admin_details_array, TRUE);
                        $subject = "Unsuccessful Payment";
                        mail($to,$subject,$message,$headers);

                        $sub_data_update['status'] = SUBSCRIPTION_STATUS_CANCELLED;
                        $this->student_subscriptions_model->update_subscription($subscription_id, $sub_data_update);
                        Template::set_message(lang('subscription_payment_cancelled'), 'error');
                    break;
                    case '999':

                        $message = $this->load->view('_emails/payment_unsuccessful',$admin_details_array, TRUE);
                        $subject = "Unsuccessful Payment";
                        mail($to,$subject,$message,$headers);

                        $sub_data_update['status'] = SUBSCRIPTION_STATUS_PAYMENT_FAILED;
                        $this->student_subscriptions_model->update_subscription($subscription_id, $sub_data_update);
                        Template::set_message(lang('subscription_payment_failed'), 'error');
                    break;
                    default:
                }   
            }
            else{

                Template::set_message(lang('subscription_payment_failed'), 'error');
            }
            
        }
        else{
            Template::set_message(lang('subscription_payment_failed'), 'error');
        }
        
        Template::set_view('response');
        Template::render();
    }
    
    public function response_alipay(){
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        
        $this->load->model('payments/payments_model');
        
        if ( @$this->current_user->language !== 'thai') {
            $this->lang->is_loaded = array();
            $this->lang->language = array();
            $this->lang->load('application', $this->current_user->language);
        } 
        
        if(!empty($_REQUEST)){
            
            if(isset($_REQUEST['TxnStatus'])){
                
                $subscription_id = $_REQUEST['OrderNumber'];

                // Load details for email
                $_subscription = $this->student_subscriptions_model->load_subscription($subscription_id);
                $student_id = $_subscription['student_id'];

                $student = $this->user_model->find_user_and_meta($student_id);
                $name = $student->first_name . " " . $student->last_name;
                $email = $student->email;
                $phone = $student->phone_number;
                $amount  = $payment_details['amount'];
                $url = EDIT_USER_URL . $student_id;

                $to = SUPPORT_EMAIL;
                $admin_details_array = array('name' => $name,
                                            'email' => $email, 
                                            'phone' => $phone,
                                            'payment_type' => 'AliPay', 
                                            'amount' => $amount,
                                            'url'=>$url);

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // More headers
                $headers .= 'From: <no-reply@englishgang.com>' . "\r\n";
                // End load details for email


                $this->db->where('subscription_id', $subscription_id);
        		$this->db->select("*");
                $this->db->from('payment');
                $this->db->order_by("id", "desc"); 
                $this->db->limit(1);
                        
                $query = $this->db->get();
                $payment_details = $query->row();
                
                $payment_id = $payment_details->id;
     
                $data = array();
                $data['amount'] = $payment_details->amount;
                $data['reference_number'] = $payment_details->reference_number;
                $data['reference_date'] = $payment_details->reference_date;
                
                $data['transaction_number'] = $_REQUEST['TxnID'];
                $data['payment_type'] = $_REQUEST['PymtMethod'];
                $data['transaction_date'] = date("YmdHis");
                $data['payment_status'] = $_REQUEST['TxnStatus'];
                $data['transaction_message'] = $_REQUEST['TxnMessage'];
                $data['hash_value'] = $_REQUEST['HashValue'];
                
                $updated_details = $this->payments_model->update_payment($payment_id,$data);
                
                switch($_REQUEST['TxnStatus']){
                    case '0':

                        $message = $this->load->view('_emails/payment_successful',$admin_details_array, TRUE);
                        $subject = "Successful Payment";
                        mail($to,$subject,$message,$headers);
                        
                        $sub_data_update['status'] = SUBSCRIPTION_STATUS_ACTIVE;
                        $this->student_subscriptions_model->update_subscription($subscription_id, $sub_data_update);
                        
                        // $this->session->set_flashdata('subscription_id',$subscription_id);
                        // Template::redirect('/users/book_new_class');
                        
                        Template::set_message(lang('subscription_payment_accepted'), 'success');
                    break;
                    case '1':

                        $message = $this->load->view('_emails/payment_unsuccessful',$admin_details_array, TRUE);
                        $subject = "Unsuccessful Payment";
                        mail($to,$subject,$message,$headers);

                        $sub_data_update['status'] = SUBSCRIPTION_STATUS_PAYMENT_FAILED;
                        $this->student_subscriptions_model->update_subscription($subscription_id, $sub_data_update);
                        Template::set_message(lang('subscription_payment_failed'), 'error');
                    break;
                    case '2':

                        $message = $this->load->view('_emails/payment_unsuccessful',$admin_details_array, TRUE);
                        $subject = "Unsuccessful Payment";
                        mail($to,$subject,$message,$headers);

                        $sub_data_update['status'] = SUBSCRIPTION_STATUS_PENDING;
                        $this->student_subscriptions_model->update_subscription($subscription_id, $sub_data_update);
                        Template::set_message(lang('subscription_payment_pending'), 'error');
                    break;
                    default:
                }
                
            }
            else{
                Template::set_message(lang('subscription_payment_cancelled'), 'error');
            }
            
        }
        else{
            Template::set_message(lang('subscription_payment_failed'), 'error');
        }
        
        Template::set_view('response');
        Template::render();
            
    }
    
}