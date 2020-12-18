<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2014, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

/**
 * Users Controller.
 *
 * Provides front-end functions for users, including access to login and logout.
 *
 * @package Bonfire\Modules\Users\Controllers\Users
 * @author     Bonfire Dev Team
 * @link    http://cibonfire.com/docs/developer
 */
class Users extends Front_Controller
{
    /** @var array Site's settings to be passed to the view. */
    private $siteSettings;
    
    private $calendarapi;

    /**
     * Setup the required libraries etc.
     *
     * @retun void
     */
    public function __construct()
    {
        parent::__construct();
        
        // Load facebook library
        $this->load->library('facebook');

        $this->load->helper('form');
        $this->load->helper('zoom');
        $this->load->helper('date');
        $this->load->helper('learncube');

        $this->load->library('form_validation');
        $this->load->library('users/auth');

        $this->load->model('users/user_model');


        $this->load->model('curriculum/curriculum_model');
        $this->load->model('student_subscriptions/student_subscriptions_model');
        $this->load->model('class_cancellations/class_cancellations_model');
        $this->load->model('class_schedules/class_schedules_model');
        $this->load->model('plans/plans_model');

        
        $this->lang->load('users');
        $this->siteSettings = $this->settings_lib->find_all();
        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_module_js('users', 'password_strength.js');
            Assets::add_module_js('users', 'jquery.strength.js');
        }
    }

    // -------------------------------------------------------------------------
    // Authentication (Login/Logout)
    // -------------------------------------------------------------------------

    /**
     * Present the login view and allow the user to login.
     *
     * @return void
     */
    public function login()
    {
        //reset lang to chinese
        if (isset($_GET['lang'])) {
            if ($_GET['lang'] == 'zh') {
                $this->lang->is_loaded = array();
                $this->lang->language = array();
                $this->lang->load('application', 'chinese');
            } elseif ($_GET['lang'] == 'en') {
                $this->lang->is_loaded = array();
                $this->lang->language = array();
                $this->lang->load('application', 'english');
            }
        } 


        
        if(isset($_GET['0'])){
            Template::set_message(lang('us_no_access_login'), 'error');
        }
        
        // If the user is already logged in, go home.
        if ($this->auth->is_logged_in() !== false) {
            Template::redirect('/');
        }
        
        // Try to login.
        if (isset($_POST['log-me-in'])
            && true === $this->auth->login(
                $this->input->post('login'),
                $this->input->post('password'),
                $this->input->post('remember_me') == '1'
            )
        ) {
            $user_id = $this->auth->user_id();
            
            $user = $this->user_model->find($user_id);
            if($user->user_type == 'teacher'){
                $this->auth->logout();
                Template::set_message(lang('us_no_access_login'), 'error');

            }else{
                
                if(!empty($user_id)){
                    require_once(APPPATH.'controllers/Zoom_auth.php'); 
                    $Zoom_auth =  new Zoom_auth();
                }
                
                log_activity(
                    $this->auth->user_id(),
                    lang('us_log_logged') . ': ' . $this->input->ip_address(),
                    'users'
                );
                
                // Now redirect. (If this ever changes to render something, note that
                // auth->login() currently doesn't attempt to fix `$this->current_user`
                // for the current page load).
    
                // If the site is configured to use role-based login destinations and
                // the login destination has been set...
                if ($this->settings_lib->item('auth.do_login_redirect')
                    && ! empty($this->auth->login_destination)
                ) {
                    Template::redirect($this->auth->login_destination);
                }
    
                // If possible, send the user to the requested page.
                if (! empty($this->requested_page)) {
                    Template::redirect($this->requested_page);
                }
    
                // If there is nowhere else to go, go home.
                Template::redirect('/');    
            }            
            

        }
        Template::set('authUrl', $this->facebook->login_url());
        // Prompt the user to login.
        Template::set('page_title', 'Login');
        Template::render('login');
    }

    /**
     * Log out, destroy the session, and cleanup, then redirect to the home page.
     *
     * @return void
     */
    public function logout()
    {
        if (isset($this->current_user->id)) {
            // Login session is valid. Log the Activity.
            log_activity(
                $this->current_user->id,
                lang('us_log_logged_out') . ': ' . $this->input->ip_address(),
                'users'
            );
        }

        // Always clear browser data (don't silently ignore user requests).
        $this->auth->logout();
        Template::redirect('/');
    }

    // -------------------------------------------------------------------------
    // User Management (Register/Update Profile)
    // -------------------------------------------------------------------------

    /**
     * Allow a user to edit their own profile information.
     *
     * @return void
     */
    public function profile()
    {

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $this->load->helper('date');

        $this->load->config('address');
        $this->load->config('languages_list');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');

        Template::set('meta_fields', $meta_fields);

        if (isset($_POST['save'])) {
            
            $user_id = $this->current_user->id;
            
            if ($this->saveUser('update', $user_id, $meta_fields)) {
                
                $user_data['language'] = $this->input->post('language');
                $this->user_model->update($user_id, $user_data);
                
                $meta_data['first_name'] = $this->input->post('u_fname');
                $meta_data['last_name'] = $this->input->post('u_lname');
                $meta_data['phone_number'] = $this->input->post('phone_number');    
                $meta_data['country'] = $this->input->post('select_country');
                $meta_data['state'] = $this->input->post('select_state');
                $meta_data['city'] = $this->input->post('city');
                $meta_data['timezone'] = $this->input->post('select_timezone');
                $meta_data['address_1'] = $this->input->post('address_1');
                $meta_data['address_2'] = $this->input->post('address_2');
                $meta_data['post_code'] = $this->input->post('post_code');

                $meta_data['facebook_id'] = $this->input->post('facebook_id');
                $meta_data['line_id'] = $this->input->post('line_id');
                $meta_data['child_dob'] = $this->input->post('child_dob');
                $meta_data['child_gender'] = $this->input->post('child_gender');
                $meta_data['pref_teacher_gender'] = $this->input->post('pref_teacher_gender');
                $meta_data['child_grade_level'] = $this->input->post('child_grade_level');
                $meta_data['child_school'] = $this->input->post('child_school');
                $meta_data['child_hours_english'] = $this->input->post('child_hours_english');
                
                if (is_numeric($user_id) && ! empty($meta_data)) {
                    $this->user_model->save_meta_for($user_id, $meta_data);
                }
                                
                $user = $this->user_model->find($user_id);
                $log_name = empty($user->display_name) ?
                    ($this->settings_lib->item('auth.use_usernames') ? $user->username : $user->email)
                    : $user->display_name;

                log_activity(
                    $this->current_user->id,
                    lang('us_log_edit_profile') . ": {$log_name}",
                    'users'
                );

                Template::set_message(lang('us_profile_updated_success'), 'success');

                // Redirect to make sure any language changes are picked up.
                Template::redirect('/users/profile');
            } 

            Template::set_message(lang('us_profile_updated_error'), 'error');
        }

        // Get the current user information.
        $user = $this->user_model->find_user_and_meta($this->current_user->id);

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }
        
        
        // Generate password hint messages.
        $this->user_model->password_hints();
        
        $list_of_countries = $this->config->item('address.countries');
        $list_of_states = $this->config->item('address.states');
        $list_of_languages = $this->config->item('_languages');

        Template::set('menu_page_type', 'my_account');
        Template::set('menu_subpage_type', 'update_profile');

        Template::set('user', $user);
        Template::set('list_of_countries', $list_of_countries);
        Template::set('list_of_languages', $list_of_languages);
        Template::set('list_of_states', $list_of_states);
        Template::set('languages', unserialize($this->settings_lib->item('site.languages')));

        Template::set_view('profile');
        Template::render();
    }

    /**
     * Allow a user to buy a new package
     *
     * @return void
     */
    public function packages()
    {
        $this->load->model('payments/payments_model');

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $user_id = $this->current_user->id;
        $user = $this->user_model->find_user_and_meta($user_id);

        if ( @$user->language !== 'thai') {
            $this->lang->is_loaded = array();
            $this->lang->language = array();
            $this->lang->load('application', $user->language);
        } 

        $remaining_credit = $this->student_subscriptions_model->get_total_remaining_classes($user_id);

        $all_packages = $this->plans_model->get_all_packages();
        $this->load->config('payment_options_list');
        if (isset($_POST['process'])) {

            

            // Do validation
            $this->form_validation->set_rules('package_id', lang('price_package'), 'required');
            $this->form_validation->set_rules('payment_option', lang('pkg_payment_option'), 'required');
            
            // Validation ok. 
            if ($this->form_validation->run() !== false) {

                $selected_package_id = $this->input->post('package_id');
                $selected_plan = $this->plans_model->load_plan($selected_package_id);
                $selected_payment_option = $this->input->post('payment_option');

                // Insert into subscriptions as pending
                $sub_data = array();
                $sub_data['student_id'] = $user_id;
                $sub_data['plan_id'] = $selected_package_id;
                $sub_data['status'] = SUBSCRIPTION_STATUS_PENDING;
                $sub_data['created_on'] = date('Y-m-d H:i:s');
                $subscription_id = $this->student_subscriptions_model->insert_sub($sub_data);

                $reference_number = $this->payments_model->generate_reference_number($subscription_id);
                $reference_date = date('YmdHis');

                // Insert into payments as pending
                $payment_data = array();
                $payment_data['subscription_id'] = $subscription_id;
                $payment_data['reference_number'] = $reference_number;
                $payment_data['payment_status'] = PAYMENT_STATUS_PENDING;
                $payment_data['amount'] =$selected_plan['price'];
                $payment_data['currency'] = SCB_CURRENCY;
                $payment_data['reference_date'] = $reference_date;
                $payment_data['payment_option'] = $selected_payment_option;
                $payment_id = $this->payments_model->insert_payment($payment_data);
                
                if ($payment_id) {  // Create url and redirect to SCB

                    if ($payment_data['payment_option'] == PAYMENT_OPTION_SCB) {
                        $package_data = array();
                        $package_data['amount'] = $selected_plan['price'];
                        $package_data['description'] = $selected_plan['name'];
                        $package_data['reference_number'] = $reference_number;
                        $package_data['reference_date'] = $reference_date;

                        $scb_pay_url = $this->payments_model->generate_SCB_URL($user_id, $package_data);
                        Template::redirect($scb_pay_url);

                    } elseif ($payment_data['payment_option'] == PAYMENT_OPTION_2C2P) {

                        $response = $this->load->view('users/2c2p_form',array('selected_plan' => $selected_plan,'order_id'=>$subscription_id), TRUE);
                        print_r($response);
                        exit;                        
                    
                    } elseif ($payment_data['payment_option'] == PAYMENT_OPTION_ALI) {

                        $response = $this->load->view('users/alipay_form',array('selected_plan' => $selected_plan,'order_id'=>$subscription_id, 'payment_id' => $payment_id,'user'=>$user), TRUE);
                        print_r($response);
                        exit;    
                    }

                } else {
                    Template::set_message(lang('error_buying_package'), 'error');
                }
            }

        }

        $payment_options = $this->config->item('_payment_options');
        Template::set('payment_options', $payment_options);
        Template::set('remaining_credit', $remaining_credit);
        Template::set('all_packages', $all_packages);

        Template::set_view('packages');
        Template::render();
    }

    /**
     * Allow a user to buy a new package
     *
     * @return void
     */
    public function feedback()
    {

        $this->load->model('feedback/feedback_model');

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $user_id = $this->current_user->id;
        $user = $this->user_model->find_user_and_meta($user_id);

        $feedbacks = $this->feedback_model->load_student_feedback($user_id);
        $feedback_details = '';
        if(!empty($feedbacks)){
            $feedback_details = $this->feedback_model->load_feedback_details($feedbacks);    
        }
        
        if ( @$user->language !== 'thai') {
            $this->lang->is_loaded = array();
            $this->lang->language = array();
            $this->lang->load('application', $user->language);
        } 

        Template::set('feedbacks', $feedback_details);
        Template::set('menu_page_type', 'my_classes');
        Template::set('menu_subpage_type', 'my_feedback');
        Template::set_view('feedback');
        Template::render();
    }

    
        /*
     * Display the user list and manage the user deletions/banning/purge.
     *
     * @param string $filter The filter to apply to the list.
     * @param int    $offset The offset from which the list will start.
     *
     * @return  void
     */
    public function manage_users()
    {
         // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $user_id = $this->current_user->id;

        $all_users = $this->user_model->get_company_users($user_id);
        $email_error = '';

        if (isset($_POST['process_user_emails']) && $_POST['process_user_emails'] == '1') {

            $emails = $this->input->post('users_emails');
            $all_emails = explode(PHP_EOL, $emails);

            
            foreach ($all_emails as $user_email) {
                if (empty($user_email) === false) {
                    if ($this->form_validation->valid_email(trim($user_email)) === false) {
                        $email_error .= $user_email . lang('is_invalid_email');
                    }
                }
            }

            if (empty($email_error)) {

                $this->user_model->clear_company_users($user_id);

                foreach ($all_emails as $user_email) {
                    if (empty($user_email) === false) {
                        $this->user_model->insert_company_users($user_id, $user_email);
                    }
                }

                Template::set_message(lang('users_successfully_updated'), 'success');   
            } else {
                $error_message = lang('has_following_errors');
                $error_message .= $email_error;
                Template::set_message($error_message, 'error');
            }
        }

        Template::set('email_error', $email_error);
        Template::set('all_users', $all_users);

        Template::set('menu_page_type', 'my_account');
        Template::set('menu_subpage_type', 'manage_users');

        Template::set_view('manage_users');
        Template::render();
    }



    /**
     * Cancel an account. Allow a user to request a refund is eligible
     *
     * @return void
     */
    public function cancel()
    {
        $this->load->model('cancellations/cancellations_model');

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        $user_id = $this->current_user->id;

        $current_package = $this->student_subscriptions_model->get_current_package($user_id);
        $subscription_id = $current_package[0]['id'];

        if ($current_package) {
            if ($this->student_subscriptions_model->if_eligible_refund($user_id)) {
                $current_package[0]['eligible_refund'] = 1;
            } else {
                $current_package[0]['eligible_refund'] = 0;
            }
        }

        if (isset($_POST['send_feedback']) && $_POST['send_feedback'] == '1') {

            // Do validation
            $this->form_validation->set_rules('reason', lang('cancellation_reason'), 'required');
            $this->form_validation->set_rules('accept_checkbox', lang('cancellation_accept'), 'required');
            
            // Validation ok. 
            if ($this->form_validation->run() !== false) {

                // Cancel account (soft purge)
                if ($this->user_model->delete($user_id)) {
                
                    $logName = $this->current_user->email;
                    log_activity(
                        $this->auth->user_id(),
                        'Student cancelled account' . ": {$logName}",
                        'users'
                    );

                    // Add to cancellations table
                    $data = array(
                        'user_id' => $user_id,
                        'cancellation_reason' => $this->input->post('reason'),
                        'is_refunded' => 0 ,
                        'cancellation_date' => date("Y-m-d H:i:s")
                    );

                    $this->cancellations_model->insert_cancellation($data);

                    // Cancel sub
                    $this->student_subscriptions_model->cancel_subscription($subscription_id, SUBSCRIPTION_STATUS_CANCELLED);  // or refunded?

                    // Send email to admin to process refund manually
                    if (isset($_POST['request_refund']) && $_POST['request_refund'] == 'refund') {

                        $to = SUPPORT_EMAIL;
                        $subject = "Refund request";
                        $url = site_url().'admin/content/public_profile/edit/'.$user_id;
                        $message = "Student ID <a href='".$url."'>". $user_id ."</a> has requested a refund. Please process manually.";
                        
                        // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        
                        // More headers
                        $headers .= 'From: <no-reply@englishgang.com>' . "\r\n";
                        
                        mail($to,$subject,$message,$headers);
                    }


                    $this->auth->logout();
                    Template::redirect('/users/cancelled');
                }
            }
        }

        Template::set('current_package', $current_package);

        Template::set('menu_page_type', 'my_account');
        Template::set('menu_subpage_type', 'cancel_account');

        Template::set_view('cancel');
        Template::render();
    }

    /**
     * Display cancelled success page
     *
     * @return void
     */
    public function cancelled()
    {
        Template::set('page_type', 'cancelled');
        Template::set_view('cancelled');
        Template::render();
    }

    /**
     * Show upcoming classes
     *
     * @return void
     */
    public function upcoming_classes()
    {

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $user_id = $this->current_user->id;

        $all_upcoming_classes = $this->student_subscriptions_model->get_classes($user_id, CLASS_STATUS_BOOKED);

        $upcoming_classes = array();
        if (empty($all_upcoming_classes) === false) {    
            
            foreach ($all_upcoming_classes as $class) {

                // Dont include past classes
                $class_start_time = strtotime($class['class_start_date'] . " " . $class['class_start_time']);
                $class_start_time_plus_fifteen = $class_start_time + 900; // 900 seconds = 15 minutes
                if ($class_start_time_plus_fifteen > time()) {
                    $upcoming_classes[] = $class;
                 }
            }
        }

        Template::set('upcoming_classes', $upcoming_classes);

        Template::set('menu_page_type', 'my_classes');
        Template::set('menu_subpage_type', 'upcoming_classes');

        Template::set_view('upcoming_classes');
        Template::render();
    }

    /**
     * Show upcoming classes
     *
     * @return void
     */
    public function cancel_class($class_id)
    {
        if (empty($class_id)) {
            Template::redirect('/users/upcoming_classes');
        }

        // Invalid class id
        if ($this->class_cancellations_model->class_exists($class_id) === false) {
            Template::redirect('/users/upcoming_classes');
        }

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $user_id = $this->current_user->id;

        $curriculum_id = $this->curriculum_model->get_curriculum_id_from_class($class_id);
        if ($curriculum_id === false) {
            Template::redirect('/users/upcoming_classes');
        }

        $curriculum_details = $this->curriculum_model->load_curriculum_details($curriculum_id);
        if (empty($curriculum_details)) {
            Template::redirect('/users/upcoming_classes');
        }

        $is_chargeable = $this->class_cancellations_model->is_chargeable_cancellation($class_id);

         // Handle the form
        if (isset($_POST['process_cancel'])) {

            // Do validation
            $this->form_validation->set_rules('cancellation_reason', lang('cancellation_reason'), 'required');

            if ($is_chargeable) {
                $this->form_validation->set_rules('accept_checkbox', lang('cancellation_paid_accept_error'), 'required');
            }

            // Validation ok. lets insert
            if ($this->form_validation->run() !== false) {

                $data = array();
                $data['class_id'] = $class_id;
                $data['cancelled_by'] = $user_id;
                $data['is_chargeable'] = $is_chargeable;
                $data['cancellation_reason'] = $this->input->post('cancellation_reason');
                
                if ($this->class_cancellations_model->cancel_class($data)) {

                    $class_details = $this->class_schedules_model->load_class_details($class_id);

                    $calendarId = $this->config->item('calendar_id');

                    $this->load->library('googleapi');
                    $this->calendarapi = new Google_Service_Calendar($this->googleapi->client());
                    
                    $this->db->select('calendar_event_id');
                    $this->db->from('class_schedules');
                    $this->db->where(array('teacher_id'=>$class_details['teacher_id'],'class_start_date'=>$class_details['class_start_date'],'class_start_time'=>$class_details['class_start_time'],'class_end_date'=>$class_details['class_end_date'],'class_end_time'=>$class_details['class_end_time']));
                    
                    $prevClassQuery = $this->db->get();
                    $prevClassCheck = $prevClassQuery->num_rows();
                    $resultClass = $prevClassQuery->result_array();
                    
                    if($prevClassCheck > 0){
                        for ($i=0; $i < sizeof($resultClass) ; $i++) { 
                            if(!empty($resultClass[$i]['calendar_event_id'])){
                                $this->calendarapi->events->delete($calendarId,trim($resultClass[$i]['calendar_event_id']));
                            }    
                        }
                    }                 

                    // Re-open teacher slot
                    $this->class_schedules_model->open_teacher_availability($class_details['class_start_date'], $class_details['class_start_time'], $class_details['teacher_id']);

                    // Notify teacher
                    $student_name = $class_details['student']->first_name . " " . $class_details['student']->last_name;
                    $class_datetime = format_class_date_time($class_details['class_start_date'], $class_details['class_start_time']);

                    $message = $this->load->view('_emails/class_cancel_teacher_notification',array('student_name' => $student_name,'class_datetime'=>$class_datetime), TRUE); 
                    $to = $class_details['teacher']->email;
                    $subject = "Class Cancellation";

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

                    $this->email->initialize($config);
                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");

                    $this->email->to($to);
                    $this->email->from(SUPPORT_EMAIL_EMAIL, EMAIL_FROM);
                    $this->email->subject($subject);
                    $this->email->message($message);
                    $this->email->send();

                    $curriculum_details = $this->curriculum_model->load_curriculum_details($class_details['curriculum_id']);
                    $admin_details_array = array('teacher_name' => @$class_details['teacher']->first_name . " " . $class_details['teacher']->last_name,
                                                    'teacher_email' => $class_details['teacher']->email, 
                                                    'teacher_id' => $class_details['teacher_id'],
                                                    'student_email' => $class_details['student']->email, 
                                                    'student_name' => @$class_details['student']->first_name . " " . $class_details['student']->last_name, 
                                                    'start_date'=> $class_details['class_start_date'],
                                                    'start_time'=> $class_details['class_start_time'],   
                                                    'is_chargeable'=> $is_chargeable,                                                                         
                                                    'topic' => @$curriculum_details['topic'],
                                                    'theme' => @$curriculum_details['theme'],
                                                    'level' => @$curriculum_details['level'],
                                                    'unit' => @$curriculum_details['unit'],
                                                    'class_id'=> $class_details['id'],
                                                    'zoom_url'=> @$class_details['zoom_url']);

                    $admin_message = $this->load->view('_emails/class_cancel_admin_notification',$admin_details_array, TRUE);    

                    $admin_to = ADMIN_CLASS_NOTIFICATION;
                    $admin_subject = "Class Cancellation Admin notification";
                    $this->email->clear();
                    $this->email->initialize($config);
                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");

                    $this->email->to($admin_to);
                    $this->email->from(SUPPORT_EMAIL_EMAIL, EMAIL_FROM);
                    $this->email->subject($admin_subject);
                    $this->email->message($admin_message);
                    $this->email->send();

                    
                    $student_message = $this->load->view('_emails/class_cancel_student_notification',array(), TRUE); 

                    $this->email->clear();
                    $this->email->initialize($config);
                    $this->email->set_mailtype("html");
                    $this->email->set_newline("\r\n");

                    $this->email->to($class_details['student']->email);
                    $this->email->from(SUPPORT_EMAIL_EMAIL, EMAIL_FROM);
                    $this->email->subject('Class cancellation');
                    $this->email->message($student_message);
                    $this->email->send();


                    $additional_users = $this->user_model->get_company_users($user_id);
                    // send to all users in group
                    if (empty($additional_users) === false) {
                        
                        foreach ($additional_users as $key => $val) {
                            $this->email->clear();
                            $this->email->initialize($config);
                            $this->email->set_mailtype("html");
                            $this->email->set_newline("\r\n");

                            $this->email->to($val['email']);
                            $this->email->from(SUPPORT_EMAIL_EMAIL, EMAIL_FROM);
                            $this->email->subject('Class cancellation');
                            $this->email->message($student_message);
                            $this->email->send();
                        }
                    }


                    Template::set_message(lang('success_cancelling_class'), 'success');
                    Template::redirect('/users/upcoming_classes');
                } else {
                    Template::set_message(lang('error_cancelling_class'), 'error');
                }

                
            }
        }

        Template::set('curriculum_details', $curriculum_details);
        Template::set('is_chargeable', $is_chargeable);
        Template::set('menu_page_type', 'my_classes');
        Template::set('menu_subpage_type', 'upcoming_classes');

        Template::set_view('cancel_class');
        Template::render();
    }


     /**
     * Show completed classes
     *
     * @return void
     */
    public function completed_classes()
    {

        $this->load->model('feedback/feedback_model');
        
        $old_year_val = '';
        $old_month_val = '';

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $user_id = $this->current_user->id;
        
        $filter_array = array();
        $filter_active = '';
        if(isset($_POST['submit'])){
            
            $choosed_month = (!empty($_POST['choose_month']))?$_POST['choose_month']:'';
            $choosed_year = (!empty($_POST['choose_year']))?$_POST['choose_year']:'';
            
            $filter_array['month'] = $choosed_month;
            $filter_array['year'] = $choosed_year;
            
            
            if(!empty($choosed_month) || !empty($choosed_year)){
                $completed_classes = $this->student_subscriptions_model->get_classes($user_id, CLASS_STATUS_COMPLETED,$filter_array);
                
                $filter_active = '1';
                
            }
            else{
                $completed_classes = $this->student_subscriptions_model->get_classes($user_id, CLASS_STATUS_COMPLETED);
            }
            
        }
        elseif(isset($_POST['clr_filter'])){
            
            $completed_classes = $this->student_subscriptions_model->get_classes($user_id, CLASS_STATUS_COMPLETED);  
        }
        else{
          
            $completed_classes = $this->student_subscriptions_model->get_classes($user_id, CLASS_STATUS_COMPLETED);
        }

        $all_classes_start_date = $this->student_subscriptions_model->get_classes($user_id, CLASS_STATUS_COMPLETED);
        
        foreach($completed_classes as $key => $val) {
            $completed_classes[$key]['feedback'] = $this->feedback_model->has_feedback($val['id'], FEEDBACK_TYPE_TEACHER);
        }
        
        foreach($all_classes_start_date as $classes_start_date){
            
            $class_start_date = $classes_start_date['class_start_date'];
            $classes_start_date = explode('-',$class_start_date);
            if($old_year_val != $classes_start_date[0]){
                $start_year[] = $classes_start_date[0];    
            }
            if($old_month_val != $classes_start_date[1]){
                $start_month[] = $classes_start_date[1];    
            }
            $old_year_val = $classes_start_date[0];
            $old_month_val = $classes_start_date[1];
        }

        Template::set('filter_array', @$filter_array);
        Template::set('filter_active', @$filter_active);
        Template::set('start_year', @$start_year);
        Template::set('start_month', @$start_month);
        Template::set('completed_classes', $completed_classes);
        Template::set('menu_page_type', 'my_classes');
        Template::set('menu_subpage_type', 'completed_classes');

        Template::set_view('completed_classes');
        Template::render();
    }



    /**
     * Allow a user to edit their own profile information.
     *
     * @return void
     */
    public function view_teachers()
    {
        $this->load->model('favorite_teachers/favorite_teachers_model');

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $user_id = $this->current_user->id;

        $next_class = $this->student_subscriptions_model->get_next_class($user_id);
        $is_assessment = ($next_class[0]->id == '1') ? true : false;

        $pref_teacher_gender = $this->user_model->find_meta_for($user_id, array('pref_teacher_gender'));
        Template::set('pref_teacher_gender', $pref_teacher_gender);

        $all_teachers = $this->user_model->get_teachers();
        
        $is_daterange = '';
        
        if (empty($all_teachers) === false) {
            for ($i=0; $i < sizeof($all_teachers); $i++) { 
                $all_teachers[$i]['is_favorite'] = $this->favorite_teachers_model->is_favorite($user_id, $all_teachers[$i]['id']);
                if($this->input->post('startDateTime') && $this->input->post('endDateTime')){
                    $all_teachers[$i]['is_teacher_in_selected_daterange'] = $this->user_model->teacher_in_selected_daterange($all_teachers[$i]['id'],$this->input->post('startDateTime'),$this->input->post('endDateTime'));
                    $is_daterange = '1';
                }
                else{
                    $all_teachers[$i]['is_teacher_in_selected_daterange'] = $this->user_model->check_is_teacher_available($all_teachers[$i]['id']);
                }
            }
        }
        
        if($this->input->is_ajax_request()){
            $this->view_selected_teachers($all_teachers,$is_assessment,$pref_teacher_gender);
            
        }
        
        Template::set('is_assessment', $is_assessment);
        Template::set('teachers', $all_teachers);

        Template::set_view('view_teachers');
        Template::render();
    }
    
    public function view_selected_teachers($teachers,$is_assessment,$pref_teacher_gender){
        

        if(!empty($teachers)){
            $count = 0;
            $hover_class_fav = 'hover_4';
            $hover_class_male = 'hover_2';
            $hover_class_female = 'hover_3';
            $hover_class_all = 'hover_1';
            
            $data_cat_fav = '4';
            $data_cat_male = '2';
            $data_cat_female = '3';
            $data_cat_all = '1';
            
            foreach ($teachers as $key => $val){
                if($val['is_teacher_in_selected_daterange'] == true){
                
                    if ((@$val['is_favorite'] == 1 && @$val['details']['meta']->unavailable_teach == '0') || (@$val['is_favorite'] == 1 && $is_assessment === true)) {
                        $count++;
                        ?>
                        <li class="teacher-list mix <?php echo $hover_class_fav; ?>" data-cat="<?php echo $data_cat_fav; ?>">
                            <div class="thumbnail-box-wrapper">
                                <div class="thumbnail-box">
                                <?php
                                if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                    <a class="thumb-link" href="<?php echo site_url("profiles/teacher/" . $val['id']); ?>" title=""></a>
                                    <div class="thumb-content">
                                        <div class="center-vertical">
                                            <div class="center-content">
                                                <i class="icon-helper icon-center animated zoomInUp font-white glyph-icon icon-linecons-camera"></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php                            
                                } else {
                                ?>
                                    <div class="thumb-content">
                                        <div class="center-vertical">
                                            <div class="center-content">
                                                <span class="unavail-center  animated zoomInUp font-white"><?= lang('unavailable_asseements') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php                            
                                }
        
                                ?>
                                    <div class="thumb-overlay bg-black"></div>
                                <?php
                                if (empty($val['details']['avatar'])) {
                                ?>
                                    <img src="<?= base_url(); ?>assets/images/default-avatar.jpg" alt="<?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>">
                                <?php                            
                                }   else {
                                ?>                    
                                <img src="<?= TEACHER_PORTAL_URL ?><?= @$val['details']['avatar'] ?>" alt="<?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>">
                                <?php } ?>    
                                </div>
                                <div class="thumb-pane">
                                    <h3 class="thumb-heading animated rollIn">
                                        <?php   if ($val['is_favorite']) { ?> <i class="glyph-icon icon-star gold"></i><?php } ?>
        
                                        <?php
                                        if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                            <a href="<?php echo site_url("profiles/teacher/" . $val['id']); ?>">
                                    <?php } ?>                                    
                                            <?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>
                                    <?php
                                        if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                            </a>
                                    <?php } ?> 
        
        
                                        <p><?php e(lang('bf_profile_highlight')); ?>: <?= @$val['details']['public_profile']->highlight ?></p>
                                    </h3>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                }//is_teacher_in_selected_daterange
            }
            if ($count === 0) {
            ?>
                <li class="teacher-list mix <?php echo $hover_class_fav; ?>" data-cat="<?php echo $data_cat_fav; ?>" style="box-shadow: none;">
                    <?php e(lang('favs_not_set')); ?>
                </li>
            <?php
            }
            //All Teachers
            
            $is_avaiable_teacher = false;
            
            foreach ($teachers as $key => $val) :
                if($val['is_teacher_in_selected_daterange'] == true){
                    if (@$val['details']['meta']->unavailable_teach == '0' || $is_assessment === true ) : 
                        ?>
                        <li class="teacher-list mix <?php echo $hover_class_all; ?>" data-cat="<?php echo $data_cat_all; ?>" style="display: inline-block;  opacity: 1;">
                            <div class="thumbnail-box-wrapper">
                                <div class="thumbnail-box">
                                    <?php
                                    if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                        <a class="thumb-link" href="<?php echo site_url("profiles/teacher/" . $val['id']); ?>" title=""></a>
                                        <div class="thumb-content">
                                            <div class="center-vertical">
                                                <div class="center-content">
                                                    <i class="icon-helper icon-center animated zoomInUp font-white glyph-icon icon-linecons-camera"></i>
                                                </div>
                                            </div>
                                        </div>
                                    <?php                            
                                    } else {
                                    ?>
                                        <div class="thumb-content">
                                            <div class="center-vertical">
                                                <div class="center-content">
                                                    <span class="unavail-center  animated zoomInUp font-white"><?= lang('unavailable_asseements') ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php                            
                                    }
            
                                    ?>
                                    <div class="thumb-overlay bg-black"></div>
                                    <?php
                                    if (empty($val['details']['avatar'])) {
                                    ?>
                                        <img src="<?= base_url(); ?>assets/images/default-avatar.jpg" alt="<?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>">
                                    <?php                            
                                    }   else {
                                    ?>                    
                                    <img src="<?= TEACHER_PORTAL_URL ?><?= @$val['details']['avatar'] ?>" alt="<?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>">
                                    <?php } ?>                        
                                </div>
                                <div class="thumb-pane">
                                    <h3 class="thumb-heading animated rollIn">
                                        <?php   if ($val['is_favorite']) { ?> <i class="glyph-icon icon-star gold"></i><?php } ?>
                                            <?php
                                            if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                                <a href="<?php echo site_url("profiles/teacher/" . $val['id']); ?>">
                                            <?php } ?>                                    
                                                <?= @$val['details']['meta']->first_name ?> <?= @$val['details']['meta']->last_name ?>
                                            <?php
                                            if ($is_assessment === false || ($is_assessment && @$val['details']['meta']->allow_assessment == '1')) { ?>
                                                </a>
                                            <?php } ?> 
                                        <p><?php e(lang('bf_profile_highlight')); ?>: <?= @$val['details']['public_profile']->highlight ?></p
                                    </h3>
                                </div>
                            </div>
                        </li>
                    <?php
                    $is_avaiable_teacher = true;
                    endif; // end check if avail
                }
            endforeach;
            if($is_avaiable_teacher == false){
                ?>
                <li class="teacher-list mix <?php echo $hover_class_all; ?>" data-cat="<?php echo $data_cat_all; ?>" style="display: inline-block;  opacity: 1;     box-shadow: none;">
                    <?php echo lang('bf_no_teachers'); ?>
                </li> <?php            
            }
                            
        }
        else{
            ?>
            <li class="teacher-list mix <?php echo $hover_class_fav; ?>" data-cat="<?php echo $data_cat_fav; ?>" style="box-shadow: none;">
                    <?php e(lang('favs_not_set')); ?>
                </li>
            <li class="teacher-list mix <?php echo $hover_class_all; ?>" data-cat="<?php echo $data_cat_all; ?>" style="display: inline-block;  opacity: 1;     box-shadow: none;">
                <?php echo lang('bf_no_teachers'); ?>
            </li> <?php
        }
        die;
    }
    
    
    /**
     * Allow a user to edit their own profile information.
     *
     * @return void
     */
    public function teacher($teacher_id)
    {
        $this->load->model('favorite_teachers/favorite_teachers_model');


        // Check for valid teacher
        if (empty($teacher_id) || $this->user_model->is_valid_teacher($teacher_id) === false) {
            Template::redirect('/profiles/teachers');
        }
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        $student_id = $this->current_user->id;

        $new_date_time = date("Y-m-d H:i:s", strtotime('+24 hours'));

        if (isset($_POST['make_favorite']) && $_POST['make_favorite'] == 1) {
            $this->favorite_teachers_model->add_favorite($student_id, $this->input->post('teacher_id'));
        }

        if (isset($_POST['remove_favorite']) && $_POST['remove_favorite'] == 1) {
            $this->favorite_teachers_model->remove_favorite($student_id, $this->input->post('teacher_id'));
        }

        // Get next class for student
        $next_class = $this->student_subscriptions_model->get_next_class($student_id);
        Template::set('next_class', $next_class);



        $teacher_profile = $this->user_model->load_teacher_profile($teacher_id);
        Template::set('teacher_profile', $teacher_profile);

        if ($next_class[0]->id == 1) { // assessment   
            if ($teacher_profile['meta']->allow_assessment == 0) {
                Template::redirect('/');
            }
        } else {
            if ($teacher_profile['meta']->unavailable_teach == 1) {
                Template::redirect('/');
            }
        }
        
        $this->db->select('t.*,cu.topic,cu.lesson_number,c.student_id,c.*, c.student_id, c.id as class_id');
        $this->db->from('teacher_availability as t');
        $this->db->join('class_schedules as c','c.teacher_id = t.teacher_id');
        $this->db->join('curriculum as cu','cu.id = c.curriculum_id');
        //$this->db->where('cu.active = 0');
        $this->db->where('c.class_start_date = t.available_start_date');
        $this->db->where('c.class_start_time = t.available_start_time');
        $this->db->where('c.class_end_date = t.available_end_date');
        //$this->db->where('c.class_end_time = t.available_end_time');
        $this->db->where(array('t.teacher_id'=>$teacher_id));
        // $this->db->where(array('c.student_id'=>$student_id));
        $this->db->where(array('c.status'=>CLASS_STATUS_BOOKED));
        $prevQuery_2 = $this->db->get();
        $booked_slots = $prevQuery_2->result_array();
        Template::set('booked_slots', $booked_slots);

         // get all booked slots to ensure they
        // dont get included in query below
        $booked_slot_ids = array();
        if (empty($booked_slots) === false) {
            foreach ($booked_slots as $booking) {
                $booked_slot_ids[] = $booking['id'];
            }
        }
        
        $booked_slot_arr = array();
        if (empty($booked_slots) === false) {
            $i = 0;
            foreach ($booked_slots as $booking) {
                $booked_slot_arr['class_start_time'][] = $booking['class_start_date'].' '.$booking['class_start_time'];
                $booked_slot_arr['class_start_time'][] = $booking['class_start_date'].' '.date("H:i:s", strtotime("+30 minutes", strtotime($booking['class_start_time'])));    
                $booked_slot_arr['class_end_time'][] = $booking['class_end_date'].' '.$booking['class_end_time'];
                $booked_slot_arr['class_end_time'][] = $booking['class_end_date'].' '.date("H:i:s", strtotime("-30 minutes", strtotime($booking['class_end_time'])));
            }
        }

        $this->db->select('t.*');
        $this->db->from('teacher_availability as t');
        $this->db->where(array('t.teacher_id'=>$teacher_id));
        $this->db->where("CONCAT(t.available_start_date,' ',t.available_start_time) >= ",$new_date_time);
        /*if (empty($booked_slots) === false) {
            $this->db->where_not_in('id', $booked_slot_ids);
        }*/
        if (empty($booked_slot_arr) === false) {
            $this->db->where_not_in("CONCAT(t.available_start_date,' ',t.available_start_time)", array_unique($booked_slot_arr['class_start_time']));
            $this->db->where_not_in("CONCAT(t.available_end_date,' ',t.available_end_time)", array_unique($booked_slot_arr['class_end_time']));
        }
        $prevQuery = $this->db->get();
        $interviews = $prevQuery->result_array();
        Template::set('interviews', $interviews);
        
        // load package
        $pkg = $this->student_subscriptions_model->get_current_package($student_id);
        Template::set('pkg', $pkg);

        // Does student have enough credits?
        $student_remaining = $this->student_subscriptions_model->get_total_remaining_classes($student_id);
        Template::set('student_remaining', $student_remaining);

        $is_favorite = $this->favorite_teachers_model->is_favorite($student_id, $teacher_id);
        Template::set('is_favorite', $is_favorite);

        Template::set('student_id', $student_id);

        // update profile views
        $this->user_model->update_profile_views($teacher_id);

        
        Template::set_view('teacher');
        Template::render();
    }
    
    /**
     * Allow a user to generate referral key
     *
     * @return void
     */
    public function referrals()
    {
        $this->load->helper('string');

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        $user_id = $this->current_user->id;
        

        if (isset($_POST['generate_code']) && $_POST['generate_code'] == 1) {
            $this->user_model->generate_user_referrer_code($user_id);
        }

        $user_and_meta = $this->user_model->find_user_and_meta($user_id); 

        if(isset($user_and_meta->referrer_code) === false || empty($user_and_meta->referrer_code)) {
            $referrer_code = false;
            $register_url = false;
        } else {
            $referrer_code = $user_and_meta->referrer_code;
            $register_url = STUDENT_REFERRAL_URL . $referrer_code;
        }

        Template::set('referrer_code', $referrer_code);
        Template::set('register_url', $register_url);
        Template::set_view('referrals');
        Template::render();
    }
    
    /**
     * 
     * Schedule New Lesson.
     *
     * @return void
     */
    public function schedule_new_lesson(){
        
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        $user_id = $this->current_user->id;
        
        $return_array = array();
        $data = array();

        if(!empty($_POST)){
            
            if($_POST['key'] == "bf_schedule_new_lesson"){
                
                require_once(APPPATH.'controllers/Zoom_auth.php'); 
                $Zoom_auth =  new Zoom_auth();
                
                $lesson_details = (!empty($_POST['lesson_details']))?$_POST['lesson_details']:'';
                
                if(!empty($lesson_details)){
                    $_POST['student_id'] = $user_id;
                    $return = $this->save_new_lesson($_POST);
                    $return_array['status'] = $return['status'];
                }// !empty($lesson_number)
                else{
                    $return_array['status'] = 'no_lesson';
                }
            }//key
            else{
                $return_array['status'] = 'no_post';
            }
                
        }else{
            $return_array['status'] = 'error';
        }
        echo json_encode($return_array);
        die;
    }
    
    
    /**
     *
     * book new lesson 
     *
     */
    public function save_new_lesson($post_data = array()){
        
        $return_array = array();
        
        if(!empty($post_data)){
            
            $user_id = $_POST['student_id'];
            
            $lesson_details = (!empty($post_data['lesson_details']))?$post_data['lesson_details']:'';
            
            if($lesson_details == 'No Lesson Available'){
                $topic = $lesson_details;
                $lesson_no = '';
            }
            else{
                $title = explode('[',$post_data['lesson_details']);
        
                $event_title = explode(']',$title[1]);
                $topic = trim($event_title[0]);
                
                $lesson = explode(' ',$title[0]);
                $lesson_no = trim($lesson[1]);
            }
            
            $start_date = $post_data['start'];
            $end_date = $post_data['end'];
            
            $explode_start_date = explode(' ',$start_date);
            $explode_end_date = explode(' ',$end_date);
            
            $selected_start_date = date("H:i", strtotime($explode_start_date[1]));
            $selected_end_date = date("H:i", strtotime($explode_end_date[1]));
            
            $weekday_start_peakhour = date("H:i", strtotime(WEEKDAY_START_PEAKHOUR));
            $weekday_end_peakhour = date("H:i", strtotime(WEEKDAY_END_PEAKHOUR));
            $weekend_start_peakhour = date("H:i", strtotime(WEEKEND_START_PEAKHOUR));
            $weekend_end_peakhour = date("H:i", strtotime(WEEKEND_END_PEAKHOUR));
            
            //$start_date = strtotime($explode_start_date[0]);
            //$available_start_date = date("Y-m-d", strtotime("+1 month", $start_date));

            $explode_e_start_date = explode('-',$explode_start_date[0]);
            $event_start_month = $explode_e_start_date[1]+1;
            $event_start_date = $explode_e_start_date[0].'-'.$event_start_month.'-'.$explode_e_start_date[2];
            
            $available_start_date = date("Y-m-d", strtotime($event_start_date));
            
            $start_time = $explode_start_date[1];
            
            $explode_e_end_date = explode('-',$explode_end_date[0]);
            $event_end_month = $explode_e_end_date[1]+1;
            $event_end_date = $explode_e_end_date[0].'-'.$event_end_month.'-'.$explode_e_end_date[2];
            
            $available_end_date = date("Y-m-d", strtotime($event_end_date));
            
            $end_time = $explode_end_date[1];
            
            //$current_week_day = date("l", strtotime("+1 month", $start_date));
            $current_week_day = date("l", strtotime($event_start_date));
            
            $is_peak_period = 0;
            
            if($current_week_day == 'Saturday' || $current_week_day == 'Sunday'){
                if($selected_start_date >= $weekend_start_peakhour && $selected_end_date <= $weekend_end_peakhour){
                    $is_peak_period = 1; 
                }
                else{
                    $is_peak_period = 0; 
                }
            }
            else{
                if($selected_start_date >= $weekday_start_peakhour && $selected_end_date <= $weekday_end_peakhour){
                    $is_peak_period = 1; 
                }
                else{
                    $is_peak_period = 0; 
                }
                
            }
            
            $this->db->select('*');
            $this->db->from('curriculum');
            $this->db->where("REPLACE(topic, ' ', '-') = '".trim(str_replace(' ','-',$topic))."'");
            $this->db->where("lesson_number",$lesson_no);
            $prevQuery = $this->db->get();
            $curriculum = $prevQuery->result_array();
            
            if(!empty($curriculum)){
                
                $teacher_id = $post_data['teacher_id'];

                $this->db->select('*');
                $this->db->from('teacher_availability');
                $this->db->where("available_start_date ",$available_start_date);
                $this->db->where("available_start_time ",$start_time);
                $this->db->where("teacher_id ",$teacher_id);
                $prevQuery = $this->db->get();
                $teacher_details = $prevQuery->result_array();
                
                $available_slot = $teacher_details[0]['available_slot'];
                
                //check if teacher has slot for 1 hour
                if($this->user_model->check_teacher_one_hour_slot($available_start_date, $start_time, $teacher_id, true)){
                    
                    if ($this->class_schedules_model->has_class_booking($available_start_date, $start_time, $teacher_id) === false) {
                    
                        $last_class_details = $this->student_subscriptions_model->get_last_class($user_id);
                        if(empty($last_class_details)){
                            $has_future_class = false; 
                        } else {
                
                            $class_start_time = strtotime($last_class_details[0]['class_start_time']);
                            $last_class_start_time = date("H:i:s", strtotime("+30 minutes", $class_start_time));
                            
                            $last_class_start_date = date("Y-m-d", strtotime($last_class_details[0]['class_start_date']));
                            $last_class_start_date_time = date("Y-m-d H:i:s", strtotime($last_class_start_date.' '.$last_class_start_time));
                            
                            $explode_start_date_time = explode(' ',$post_data['start']);
                            
                            $explode_e_start_date = explode('-',$explode_start_date_time[0]);
                            $event_start_month = $explode_e_start_date[1]+1;
                            $event_start_date = $explode_e_start_date[0].'-'.$event_start_month.'-'.$explode_e_start_date[2];
                            
                            $explode_start_date = date("Y-m-d", strtotime($event_start_date));
                            
                            $explode_start_time = date("H:i:s", strtotime($explode_start_date_time[1]));                        
                            $event_start_date_time = date("Y-m-d H:i:s", strtotime($explode_start_date.' '.$explode_start_time));
    
                            $check = false;
                            $has_future_class = false; 
                            if (isset($_POST['double_class'])) {
                                if ($_POST['double_class'] == '1') {
                                    $check = true;
                                }
                            } else {
                                $check = true;
                            }
    
                            if ($check === true) {
                                //try new way to check due to errors in past bookings
                                $get_max_date = $this->student_subscriptions_model->get_max_date($user_id);
                                
                                if ($available_start_date < $get_max_date) {
                                    $has_future_class = true; 
                                } elseif ($available_start_date == $get_max_date) { // last booking date is on same day so..
                                    
                                    // .. check time also
                                    $get_max_time = $this->student_subscriptions_model->get_max_time($user_id, $get_max_date);
                                    
                                    if($start_time < $get_max_time){
                                        $has_future_class = true;
                                    } else {
                                        $has_future_class = false;
                                    }
                                }
                            }
                        }
    
                        if(isset($post_data['has_future_class']) && $post_data['has_future_class'] === 'yes') {
                            $has_future_class = true; 
                        } 
    
                        $allowed = true;
                        if ($allowed === true) {
                             
                            $teacher_meta = $this->user_model->find_user_and_meta($teacher_id); 
                            $teacher_name = @$teacher_meta->first_name . " " . @$teacher_meta->last_name;
                            $teacher_email = $teacher_meta->email;
                             
                            $student_meta = $this->user_model->find_user_and_meta($user_id); 
                            $student_name = @$student_meta->first_name . " " . @$student_meta->last_name;
                            $student_email = $student_meta->email;
                            
                            $user_sess = $this->session->userdata('user');
                            
                            $zoom_owner_email = $teacher_email;
                            $zoom_url = @$teacher_meta->zoom_url;
                            $zoom_id = NULL;
                            $zoom_owner_password = NULL;
    
                            
                            $previous_lesson = $curriculum[0]['previous_lesson'];
                            $curriculum_id = $curriculum[0]['id'];
                            
                            $curr_date_time = date("Y-m-d H:i:s");
                            $student_details = $this->student_subscriptions_model->get_current_package($user_id);
                            
                            $n_start_time_1 = date('H:i:s', strtotime($start_time));
                            $n_start_time_2 = date("H:i:s", strtotime("+30 minutes", strtotime($start_time)));
                            $n_end_time_1 = $teacher_details[0]['available_end_time'];
                            $n_end_time_2 = date("H:i:s", strtotime("+30 minutes", strtotime($n_end_time_1)));
                            
                            $data['class_start_date'] = $available_start_date;
                            $data['class_start_time'] = $start_time;
                            $data['class_end_date'] = $teacher_details[0]['available_end_date'];
                            $data['class_end_time'] = $n_end_time_2;
                            $data['teacher_id'] = $teacher_id;
                            $data['student_id'] = $user_id;
                            $data['curriculum_id'] = $curriculum_id;
                            $data['is_peak_period'] = $is_peak_period;
                            $data['zoom_url'] = $zoom_url;
                            $data['zoom_id'] = $zoom_id;
                            $data['zoom_owner'] = $zoom_owner_email;
                            $data['zoom_meeting_start'] = NULL;
                            $data['zoom_meeting_end'] = NULL;
                            $data['subscription_id'] = $student_details[0]['id'];
                            $data['status'] = CLASS_STATUS_BOOKED;
                            $data['update_google'] = '1';
                            $data['created_on'] = $curr_date_time;
                            
                            if($previous_lesson == '0'){
                                $active_lesson = $curriculum[0]['active'];
                            }
                            else{
                                $this->db->select('*');
                                $this->db->from('curriculum');
                                $this->db->where("previous_lesson",$previous_lesson);
                                $prevQuery_2 = $this->db->get();
                                $curriculum_2 = $prevQuery_2->result_array();
                                $active_lesson = $curriculum_2[0]['active'];
                            }
                                
                            if(!empty($active_lesson) && $active_lesson == '1'){
                                    
                                $insert = $this->db->insert('class_schedules',$data);
                                $insert_id = $this->db->insert_id();
    
                                // has future classes so neeed to reset curriculum ids to get in correct 
                                // order again
    
                                if ($has_future_class === true) {
    
                                    log_activity(
                                        $user_id,
                                        'Class ID ' . $insert_id . ' has future classes set',
                                        'class_schedules'
                                    );
    
    
                                    $all_future_classes = $this->user_model->get_future_classes($insert_id);
                                    $reset_curriculum_id = $all_future_classes[0]['curriculum_id'];
                                    $curriculum_id = $reset_curriculum_id; // reset curriculum id for booked lesson
    
                                    $this->db->where("id",$insert_id);
                                    $update = $this->db->update('class_schedules',array('curriculum_id'=>$reset_curriculum_id, 'update_google' => '1'));
    
    
                                    $count = 0;
                                    foreach ($all_future_classes as $future) {
                                        
                                        $class_schedule_to_be_updated = $future['id'];
                                        if (isset($cid) === false) {
                                            $cid = $reset_curriculum_id;
                                        }
    
                                        $new_cid = $this->student_subscriptions_model->get_next_class_from_curriculum_id($cid);
                                        $next_curriculum_id = $new_cid[0]->id;
    
                                        $this->db->where("id", $class_schedule_to_be_updated);
                                        $update = $this->db->update('class_schedules',array('curriculum_id'=>$next_curriculum_id, 'update_google' => '1'));
    
                                        log_activity(
                                        $user_id,
                                        'Class ID ' . $class_schedule_to_be_updated . ' has been reset due to class booking ' . $insert_id,
                                        'class_schedules'
                                    );
    
                                        $cid = $next_curriculum_id;
                                    }
                                } 
    
                                if($insert_id){
                                        
                                    $this->db->where("teacher_id ",$teacher_id);
                                    $this->db->where("available_start_date ",$available_start_date);
                                    $this->db->where("available_end_date ",$available_end_date);
                                    $this->db->where("available_start_time BETWEEN '$n_start_time_1' AND '$n_start_time_2'");
                                    $this->db->where("available_end_time BETWEEN '$n_end_time_1' AND '$n_end_time_2'");
                                    $update = $this->db->update('teacher_availability',array('available_slot'=>0));
                                    
                                    if($this->db->affected_rows() > 0){
                                        
                                        // update Google calendar for single new class
                                        $target_time_zone = new DateTimeZone(date_default_timezone_get());
                                        $date_time = new DateTime('now', $target_time_zone);
                                        $gmt_timezone = $date_time->format('P');;
                                        
                                        $calendar_start_date = $available_start_date.'T'.date('H:i:s',strtotime($start_time)).'.000'.$gmt_timezone;
                                        $calendar_end_date = $available_end_date.'T'.date('H:i:s',strtotime($end_time)).'.000'.$gmt_timezone;
                                        
                                        $start_time = date('H:i A', strtotime($start_time));
                      
                                        $curriculum_details = $this->curriculum_model->load_curriculum_details($curriculum_id);
                                        
                                        $calendarId = $this->config->item('calendar_id');
    
                                        //$this->load->library('googleapi');
                                        //$this->calendarapi = new Google_Service_Calendar($this->googleapi->client());
                                        
                                        $title_html = 'EG-'.$insert_id.' ['.$student_name.'-'.$teacher_name.' - '.$zoom_url.'] '.$curriculum_details['topic']; 
    
                                        // $event = new Google_Service_Calendar_Event();
                                        // $event->setSummary($title_html);
                                        // $cal_start = new Google_Service_Calendar_EventDateTime();
                                        // $cal_start->setDateTime($calendar_start_date);
                                        // $event->setStart($cal_start);
                                        // $cal_end = new Google_Service_Calendar_EventDateTime();
                                        // $cal_end->setDateTime($calendar_end_date);
                                        // $event->setEnd($cal_end);
                                        
                                        // // $attendee1 = new Google_Service_Calendar_EventAttendee();
                                        // // $attendee1->setEmail($teacher_email);
                                        
                                        // $attendee2 = new Google_Service_Calendar_EventAttendee();
                                        // $attendee2->setEmail($student_email);
                                        
                                        // $attendees = array($attendee2);
                                        // $event->attendees = $attendees;
                                        
                                        // $event->setICalUID('english_gang_'.$insert_id);
                                        
                                        // $importedEvent = $this->calendarapi->events->import($calendarId, $event);
                                        
                                        // $cal_event_id = $importedEvent->getId();
                                        
                                        // $optionalArguments = array("sendUpdates"=>"all");
                                        // $this->calendarapi->events->update($calendarId, $cal_event_id, $event, $optionalArguments);
                                        
                                        // $this->db->where("id ",$insert_id);
                                        // $update_class_schedule = $this->db->update('class_schedules',array('calendar_event_id'=>$cal_event_id));
    
                                        if ($has_future_class === true) {
                                            // Update future classes in Google Calendar
                                            //$this->user_model->reset_googlecal_future_classes($insert_id);                                        
                                        }
    
    
                                        $admin_details_array = array('teacher_name' => $teacher_name,
                                                                        'teacher_email' => $teacher_email, 
                                                                        'student_email' => $student_email, 
                                                                        'teacher_id' => $teacher_id,
                                                                        'student_name' => $student_name, 
                                                                        'start_date'=>$available_start_date,
                                                                        'start_time'=>$start_time,                                                                            
                                                                        'topic' => $curriculum_details['topic'],
                                                                        'lesson_pdf' => $curriculum_details['lesson_pdf'],
                                                                        'theme' => $curriculum_details['theme'],
                                                                        'level' => $curriculum_details['level'],
                                                                        'unit' => $curriculum_details['unit'],
                                                                        'class_id'=>$insert_id,
                                                                        'zoom_url'=>$zoom_url,
                                                                        'zoom_meeting_owner' => $zoom_owner_email);
    
                                        $admin_message = $this->load->view('_emails/class_booked_admin',$admin_details_array, TRUE);  
    
                                        if(isset($post_data['double_class']) && $post_data['double_class'] === '0') {
                                            $double_class = true;
                                        } else {
                                            $double_class = false;
                                        }  
    
                                        $teacher_message = $this->load->view('_emails/class_booked_teacher_pro',array('teacher_name' => $teacher_name,
                                                                                                                    'teacher_email' => $teacher_email,
                                                                                                                    'student_name' => $student_name,
                                                                                                                    'class_level' => $curriculum_details['level'],
                                                                                                                    'class_unit' => $curriculum_details['unit'],
                                                                                                                    'start_date'=>$available_start_date,
                                                                                                                    'start_time'=>$start_time,
                                                                                                                    'topic'=>$topic,
                                                                                                                    'zoom_url'=>$zoom_url,
                                                                                                                    'zoom_meeting_owner'=>$zoom_owner_email,
                                                                                                                    'zoom_meeting_owner_password'=>$zoom_owner_password,
                                                                                                                    'class_id' => $insert_id,
                                                                                                                    'double_class' => $double_class,
                                                                                                                    'lesson_pdf'=>$curriculum_details['lesson_pdf']), TRUE);
    
                                        if ($student_meta->language === 'chinese') {
                                            $student_message = $this->load->view('_emails/chinese_class_booked_student', array('student_name' => $student_name,'teacher_name' => $teacher_name,'start_date'=>$available_start_date,'start_time'=>$start_time,'topic'=>$topic,'lesson_no'=>$lesson_no,'zoom_url'=>$zoom_url), true);

                                        } else {
                                            $student_message = $this->load->view('_emails/class_booked_student', array('student_name' => $student_name,'teacher_name' => $teacher_name,'start_date'=>$available_start_date,'start_time'=>$start_time,'topic'=>$topic,'lesson_no'=>$lesson_no,'zoom_url'=>$zoom_url), true);
                                        }
                                        
                                        if (ENVIRONMENT == 'production') {
                                            $to = $teacher_email;
                                        } else {
                                            $to = ADMIN_CLASS_NOTIFICATION;
                                        }
                                        
                                        $subject = "New class booking";
                                        
                                        $message = $teacher_message;
                                        // Always set content-type when sending HTML email
                                        $headers = "MIME-Version: 1.0" . "\r\n";
                                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                        // More headers
                                        $headers .= 'From: <support@englishgang.com>' . "\r\n";
                                        
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
    
                                        $this->email->initialize($config);
                                        $this->email->set_mailtype("html");
                                        $this->email->set_newline("\r\n");
    
                                        $this->email->to($to);
                                        $this->email->from(SUPPORT_EMAIL_EMAIL, EMAIL_FROM);
    
                                        $this->email->subject($subject);
                                        $this->email->message($message);
    
                                        //Send email
                                        $this->email->send();
    
                                        $this->email->clear();
                                        $this->email->initialize($config);
                                        $this->email->set_mailtype("html");
                                        $this->email->set_newline("\r\n");
    
                                        $this->email->to(ADMIN_CLASS_NOTIFICATION);
                                        $subject = 'New class booking - Admin notification';
                                        $this->email->from(SUPPORT_EMAIL_EMAIL, EMAIL_FROM);
                                        $this->email->subject($subject);
                                        $this->email->message($admin_message);
                                        $this->email->send();
    
                                        $this->email->clear();
                                        $this->email->initialize($config);
                                        $this->email->set_mailtype("html");
                                        $this->email->set_newline("\r\n");
    
                                        $this->email->to($student_email);
                                        $subject = lang('class_booked');
                                        $this->email->from(SUPPORT_EMAIL_EMAIL, EMAIL_FROM);
                                        $this->email->subject($subject);
                                        $this->email->message($student_message);
                                        $this->email->send();
                                        
                                        $additional_users = $this->user_model->get_company_users($user_id);
                                        // send to all users in group
                                        if (empty($additional_users) === false) {
                                            if ($student_meta->language === 'chinese') {
                                                $student_message = $this->load->view('_emails/chinese_class_booked_student', array('student_name' => '','teacher_name' => $teacher_name,'start_date'=>$available_start_date,'start_time'=>$start_time,'topic'=>$topic,'lesson_no'=>$lesson_no,'zoom_url'=>$zoom_url), true);
                                            } else {
                                                $student_message = $this->load->view('_emails/class_booked_student', array('student_name' => '','teacher_name' => $teacher_name,'start_date'=>$available_start_date,'start_time'=>$start_time,'topic'=>$topic,'lesson_no'=>$lesson_no,'zoom_url'=>$zoom_url), true);
                                            }

                                            foreach ($additional_users as $key => $val) {
                                                $this->email->clear();
                                                $this->email->initialize($config);
                                                $this->email->set_mailtype("html");
                                                $this->email->set_newline("\r\n");
            
                                                $this->email->to($val['email']);
                                                $subject = lang('class_booked');
                                                $this->email->from(SUPPORT_EMAIL_EMAIL, EMAIL_FROM);
                                                $this->email->subject($subject);
                                                $this->email->message($student_message);
                                                $this->email->send();
                                            }
                                        }
                                        
                                        if(isset($post_data['double_class']) && $post_data['double_class'] === '1'){
                                            
                                            // Get next class for student
                                            $next_class = $this->student_subscriptions_model->get_next_class($post_data['student_id']);
                                            Template::set('next_class', $next_class);
                                            $post_data['lesson_details'] = lang("bf_lesson")." ".$next_class[0]->lesson_number." [ ".$next_class[0]->topic." ]";
                                            
                                            $explode_start_date = explode(' ',$post_data['start']);
                                            $explode_end_date = explode(' ',$post_data['end']);
                                            
                                            $explode_e_start_date = explode('-',$explode_start_date[0]);
                                            $event_start_month = 0;
                                            $event_start_date = $explode_e_start_date[0].'-'.$explode_e_start_date[1].'-'.$explode_e_start_date[2];
                                            
                                            $start_time = $explode_start_date[1];
                                            $selected_start_time = date("H:i:s", strtotime($start_time)+(60*60));
                                        
                                            $explode_e_end_date = explode('-',$explode_end_date[0]);
                                            $event_end_month = 0;
                                            $event_end_date = $explode_e_end_date[0].'-'.$explode_e_end_date[1].'-'.$explode_e_end_date[2];
                                            
                                            $end_time = $explode_end_date[1];
                                            $selected_end_time = date("H:i:s", strtotime($end_time)+(60*60));
                                            
                                            $post_data['start'] = $event_start_date.' '.$selected_start_time;
                                            $post_data['end'] = $event_end_date.' '.$selected_end_time;
                                            $post_data['double_class'] = '0';
                                            
                                            $post_data['o_zoom_owner_email'] = $zoom_owner_email;
                                            $post_data['o_zoom_owner_password'] = $zoom_owner_password;
                                            $post_data['o_zoom_url'] = $zoom_url;
                                            $post_data['o_zoom_id'] = $zoom_id;
    
                                            if ($has_future_class === true) {
                                                $post_data['has_future_class'] = 'yes';
                                            } else {
                                                $post_data['has_future_class'] = 'no';
                                            }
                                            
                                            
                                            $return_array = $this->save_new_lesson($post_data);
                                        }
                                        else{
                                            $return_array['status'] = 'inserted';
                                        }      
                                        
                                    }//if $update
                                    else{
                                        $return_array['status'] = 'not_inserted';
                                    }
        
                                }//if $insert_id
                                else{
                                    $return_array['status'] = 'not_inserted';
                                }
                                
                            }// $active_lesson == 1
                            else{
                                $return_array['status'] = 'not_active';
                            }
                                        
                        } // if $allowed = false
                        else{
                            $return_array['status'] = 'choose_previous_date_time';
                        }
                        
                    } // available_slot == 1
                    else{
                        $return_array['status'] = 'slot_not_available';
                    } //available_slot else
                
                }//has 1 hour slot
                else{
                    $return_array['status'] = 'no_hour_slot';
                }//not has 1 hour slot
                
            } // !empty(curriculum)
            else{
                $return_array['status'] = 'no_curriculum';
            }
            
        }//!empty($post_data)
        else{
            $return_array['status'] = 'error';
        }
        return $return_array;
    }
        
    /**
     *
     * Check if next slot is not booked 
     *
     */
     public function check_has_next_class(){
        $return_array = array();
        if(!empty($_POST) && $_POST['key'] == 'bf_check_has_next_class'){
            
            $teacher_id = trim($this->input->post('teacher_id'));
            $student_id = trim($this->input->post('student_id'));
            $start_date = trim($this->input->post('start_date'));
            
            // Get next class for student
            $next_class = $this->student_subscriptions_model->get_next_class($student_id);
            if(!empty($next_class)){
                
                if($this->class_schedules_model->has_more_classes_available($student_id) === true){
                    
                    $explode_start_date = explode(' ',$start_date);
                
                    $explode_e_start_date = explode('-',$explode_start_date[0]);
                    $event_start_month = $explode_e_start_date[1]+1;
                    $event_start_date = $explode_e_start_date[0].'-'.$event_start_month.'-'.$explode_e_start_date[2];
                    
                    $seleted_start_date = date("Y-m-d", strtotime($event_start_date));
                    
                    $start_time = $explode_start_date[1].'0';
                    $selected_start_time = date("H:i:s", strtotime($start_time)+(30*60));
                
                    if($this->class_schedules_model->has_class_booking($seleted_start_date, $selected_start_time, $teacher_id) === false){
                        
                        if($this->class_schedules_model->is_day_last_slot($seleted_start_date, $selected_start_time, $teacher_id) === false){
                            $return_array['status'] = 'slot_available';
                            
                        }
                        else{
                            $return_array['status'] = 'slot_not_available';
                        }
                        
                    }
                    else{
                        $return_array['status'] = 'slot_not_available';
                    }
                }
                else{
                    $return_array['status'] = 'slot_not_available';
                }
                
            }
            else{
                $return_array['status'] = 'slot_not_available';
            }
            
        }
        else{
            $return_array['status'] = 'slot_not_available';
        }
        echo json_encode($return_array);
        die;
     }
          
    /**
     * Allow a user to add/edit their public profile information.
     * All changes must be approved by admin
     *
     * @return void
     */
    public function submit_public_profile(){
        
        $return_array = array();
        
        $this->load->model('applications/applications_model');
        $this->load->model('public_profile/public_profile_model');

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        
        // Get the current user information.
        $user_id = $this->current_user->id;
        
        $this->db->select('*');
        $this->db->from('public_profile');
        $this->db->where(array('user_id'=>$user_id));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        $result = $prevQuery->result_array();
        
        if ($_POST) {
            
            if($_POST['key'] == 'bf_user_public_profile'){
                
                
                $data['highlight'] = $_POST['highlight'];
                $data['youtube'] = $_POST['youtube'];
                $data['profile'] = $_POST['profile'];
                $data['user_id'] = $user_id;
                $data['approved'] = $_POST['approved'];
                
                if (!empty($_FILES['avatar']['name']))
                {
                    $temp_file = $_FILES['avatar']['tmp_name'];
                    $file_name = time().'_'.$_FILES['avatar']['name'];
                    
                    $fcpath = FCPATH;
                    
                    $avtar_folder = $fcpath.'/uploads/avatars/';
                    
                    if(!is_dir($avtar_folder)) {
                        mkdir($avtar_folder, 0777, true);
                        
                    }
                    
                    $target_path = $avtar_folder.$user_id.'/';
                    
                    
                    if(!is_dir($target_path)) {
                        mkdir($target_path, 0777, true);
                        
                    }
                    $target_file = $target_path . $file_name;
                    
                    if(move_uploaded_file($temp_file, $target_file)){
                        
                        
                        $data['avatar'] = $file_name;
                        
                    }
                    
                    
                }
                else{
                    $data['avatar'] = '';
                }
                
                if($prevCheck > 0){
                    
                    if(!empty($result)){
                        
                        if(!empty($result[0]['avatar'])){
                            
                            $file = "./uploads/avatars/".$result[0]['user_id'].'/'.$result[0]['avatar'];
                            if ($file) {   
                                
                                unlink($file);
                                
                                $delete = $this->db->delete('public_profile', array('user_id'=>$user_id));
                                
                                if($this->db->affected_rows() > 0){
                                
                                    $insert = $this->db->insert('public_profile', $data);
                
                                    $insert_id = $this->db->insert_id();
                                    
                                    if($insert_id){
                                        
                                        $return_array['status'] = 'success' ;
                                        $return_array['user_id'] = $user_id ;
                                        
                                    }else{
                                        
                                        $return_array['status'] = 'error' ;
                                        
                                    }
                                    
                                }
                                
                            }
                                
                        }
                        else{
                                
                            $delete = $this->db->delete('public_profile', array('user_id'=>$user_id));
                            
                            if($this->db->affected_rows() > 0){
                            
                                $insert = $this->db->insert('public_profile', $data);
            
                                $insert_id = $this->db->insert_id();
                                
                                if($insert_id){
                                    
                                    $return_array['status'] = 'success' ;
                                    $return_array['user_id'] = $user_id ;
                                    
                                }else{
                                    
                                    $return_array['status'] = 'error' ;
                                    
                                }
                                
                            }
                        }
                        
                    }

                }
                else{
                    $insert = $this->db->insert('public_profile', $data);
                
                    $insert_id = $this->db->insert_id();
                    
                    if($insert_id){
                        $return_array['status'] = 'success' ;
                        $return_array['user_id'] = $user_id ;
                    }
                    else{
                        $return_array['status'] = 'error' ;
                    }    
                }
                
            }else{
                
                $return_array['status'] = 'error';
                
            }

            
        }
        
        echo json_encode($return_array);
        
    }
    
    /**
     * Remove Uploaded Avatar
     *
     * @return void
     */
    public function remove_user_avatar(){
        
        $user_id = $_POST['user_avatar_id'];
        
        $user_data =  $this->db->select('*')->from('public_profile')->where('user_id',$user_id)->get()->row();
                
        if(!empty($user_data)){
            
            $file = "./uploads/avatars/".$user_data->user_id.'/'.$user_data->avatar;
            if($file){
                unlink($file);
                $this->db->where('user_id',$user_id);
                $update = $this->db->update('public_profile',array('avatar'=>''));
                
                if($this->db->affected_rows() > 0){
                    $data = array(
                        'status' => 'success',
                        'message' => 'Avatar removed successfully.',
                    );
                }
                else{
                
                    $data = array(
                        'status' => 'fail',
                        'message' => 'There were errors',
                    );
                }
            }
        }
        echo json_encode($data);
        exit();
    }
    
    /**
     * Select User State
     * */     
    public function select_state(){
        
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');

        Template::set('meta_fields', $meta_fields);
        
        $list_of_states = $this->config->item('address.states');
        $list_of_countries = $this->config->item('address.countries');
        
        if(isset($_POST["country"])){
            // Capture selected country
            $country = $_POST["country"];
            if(isset($list_of_states[$country])){
                ?>
                <select class="form-control" name="select_state" id="select_state">
                    <option value="">Select State / Province</option>
                    <?php 
                    
                    foreach($list_of_states[$country] as $key => $states_list){
                        
                            echo '<option value="'.$key.'">'.$states_list.'</option>';    
                        
                    }
                    ?>
                </select>
                <?php echo form_error('select_state', '<div class="alert alert-error">', '</div>'); 
                
            }else{
                
            }
            
        }
        
    }
    
    
    
    /**
     * Select User Timezone
     * */
     public function select_timezone(){
        
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');

        Template::set('meta_fields', $meta_fields);
        
        if(isset($_POST["country"])){
            // Capture selected country
            $country = trim($_POST["country"]);
            
            
            if($country != ""){
                
                $timezone_array = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $country);

                if(!empty($timezone_array)){
                    $count_timezone = count($timezone_array);
                    ?>
                    <select class="form-control" name="select_timezone" id="select_timezone">
                        <option value="">Select Timezone</option>
                        <?php 
                        
                        for($i=0;$i<$count_timezone;$i++){
                            echo '<option value="'.$timezone_array[$i].'">'.$timezone_array[$i].'</option>';    
                        }
                        ?>
                    </select>
                    <?php    
                }
            }
        }
    }

    /**
     * View resume.
     *
     * @return void
     */
    public function resume()
    {
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        // Get the current user information.
        $user = $this->user_model->find_user_and_meta($this->current_user->id);
        
        $user_id = $user->id;
        
        $this->db->select('*');
        $this->db->from('resumes');
        $this->db->where(array('user_id'=>$user_id));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        $result = $prevQuery->result_array();

        // upload resume
        
        // Generate password hint messages.
        $this->user_model->password_hints();

        Template::set('menu_page_type', 'upload_resume');

        Template::set('user', $user);
        
        Template::set('resumes', $result);

        Template::set_view('resume');
        Template::render();
    }
    
    /**
     * 
     *  Check if referral code is valid
     * 
     * @return void
     */
    public function check_ref_code(){
        $return_array = array();
        
        if(isset($_POST['key']) == 'bf_check_ref_code'){
            $ref_code = (!empty($_POST['ref_code']))?$_POST['ref_code']:'';
            
            if(!empty($ref_code)){
                $this->db->select('*');
                $this->db->from('user_meta');
                $this->db->where('meta_key', REFERRAL_CODE_USER_META);
                $this->db->where('meta_value', $ref_code);
                $ref_query = $this->db->get();
                if($ref_query->num_rows()){
                    $ref_result = $ref_query->result_array();
                    $return_array['status'] = 'has_ref';
                    $return_array['ref_result'] = $ref_result;
                    
                    $this->session->userdata('user_ref_result');  

                    $this->session->set_userdata('user_ref_result', $ref_result);
 
                }
                else{
                    $return_array['status'] = "no_ref";
                }
            }    
        }
        else{
            $return_array['status'] = "error";
        }
        
        echo json_encode($return_array);
        exit();
    }

    /**
     * Display the registration form for the user and manage the registration process.
     *
     * The redirect URLs for success (Login) and failure (register) can be overridden
     * by including a hidden field in the form for each, named 'register_url' and
     * 'login_url' respectively.
     *
     * @return void
     */
    public function register()
    {
        //reset lang to chinese
        if (isset($_GET['lang'])) {

            if ($_GET['lang'] == 'zh') {
                $this->lang->is_loaded = array();
                $this->lang->language = array();
                $this->lang->load('application', 'chinese');
            } elseif ($_GET['lang'] == 'en') {
                $this->lang->is_loaded = array();
                $this->lang->language = array();
                $this->lang->load('application', 'english');
            }
        } 

        // Are users allowed to register?
        if (! $this->settings_lib->item('auth.allow_register')) {
            Template::set_message(lang('us_register_disabled'), 'error');
            Template::redirect('/');
        }

        $register_url = $this->input->post('register_url') ?: REGISTER_URL;
        $login_url    = $this->input->post('login_url') ?: LOGIN_URL;

        $this->load->model('roles/role_model');
        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');
        Template::set('meta_fields', $meta_fields);
        
        $meta_data = array();
        $user_created = false;
        if (isset($_POST['register'])) {
            
            if ($userId = $this->saveUser('insert', 0, $meta_fields)) {
                
                $user_created = true;    
                $meta_data['first_name'] = $this->input->post('u_fname');
                $meta_data['last_name'] = $this->input->post('u_lname');
                
                if (is_numeric($userId) && ! empty($meta_data)) {
                    $this->user_model->save_meta_for($userId, $meta_data);
                }
                
                // User Activation
                $activation = $this->user_model->set_activation($userId);
                $message = $activation['message'];
                $error   = $activation['error'];

                Template::set_message($message, $error ? 'error' : 'success');

                log_activity($userId, lang('us_log_register'), 'users');
                Template::redirect($login_url);

            }

            Template::set_message(lang('us_registration_fail'), 'error');
            // Don't redirect because validation errors will be lost.
        }

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        $userData = array();
        $metaData = array();
        // Check if user is logged in
        if($this->facebook->is_authenticated()){ 
            $error = $this->input->get('error');
            $error_code = $this->input->get('error_code');
            $error_description = $this->input->get('error_description');
            if($error){
                
            }else{
                // Get user facebook profile details
                $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
                
                if(isset($userProfile['email'])){
                    
                
                    $check_user = $this->user_model->check_user($userProfile['email']);
                    
                    if(!empty($check_user)){
                        $user = $this->user_model->find($check_user->id);
                        if($user->user_type == 'teacher'){
                            $this->auth->logout();
                            
                            Template::redirect('login?0');
                        }
                    }
                    
                    if(!empty($check_user)){
                        $userData['id'] = $check_user->id;
                        $userData['email'] = $check_user->email;
                        
                    }else{
                        $userData['email'] = $userProfile['email'];
                        $userData['role_id'] = 4;
                        $userData['display_name'] = strtolower($userProfile['first_name']);
                        $userData['active'] = 1;    
                        $userData['user_type'] = 'student'; 
                        $userData['is_fb_pass'] = 1;               
                        
                        /*$password = $this->auth->hash_password('password');
                        if (empty($password) || empty($password['hash'])) {
                            return false;
                        }
                
                        $userData['password_hash'] = $password['hash'];
                        
                        $user_password = "password";*/
                    }
                    
                    // Insert or update user data
                    $userID = $this->user_model->fb_user($userData);
                    
                    $metaData['first_name'] = $userProfile['first_name'];
                    $metaData['last_name'] = $userProfile['last_name'];
                    
                    if(!empty($userID)){
                        
                        $this->db->select('*');
                        $this->db->from('referrals');
                        $this->db->where('user_id',$userID);
                        $ref_result = $this->db->get();
                        if($ref_result->num_rows() == 0){
                            
                            $user_ref_result = $this->session->userdata('user_ref_result');
                    
                            if(!empty($user_ref_result)){
                                
                                $ref_code = $user_ref_result[0]['meta_value'];
                                $referrer_id = $user_ref_result[0]['user_id'];

                                $ref_data = array( 
                                        'referral_code' =>  $ref_code, 
                                        'user_id'=>  $userID, 
                                        'referrer_id'   =>  $referrer_id,
                                        'signup_date' => date("Y:m:d H:i:s"),
                                    );
                                $this->db->insert('referrals', $ref_data);
                                
                            }
                            
                            
                            
                        }
                        
                    }
                    
                    if (is_numeric($userID) && ! empty($metaData) && $user_created === true) {
                        $this->user_model->save_meta_for($userID, $metaData);
                        
                        $data = array();
                        $data['student_id'] = $userID;
                        $data['plan_id'] = PLAN_TRIAL;
                        $data['created_on'] = date('Y-m-d H:i:s');
                        $id = $this->student_subscriptions_model->insert_sub($data);
    
                        $user_url =  ADMIN_PORTAL_URL . 'settings/users/edit/'.$userID;
                            
                        if($user_url){
                            
                            $to = SUPPORT_EMAIL;
                            $subject = "New student registration";
                            
                            $message = "A new user has registered on the English Gang Student Portal. Click here <a href='".$user_url."'>here</a> to view the user.";
                            
                            // Always set content-type when sending HTML email
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            
                            // More headers
                            $headers .= 'From: <no-reply@englishgang.com>' . "\r\n";
                            
                            if(mail($to,$subject,$message,$headers)){
                                
                                $mailchimp_api_key =$this->config->item('mailchimp_api_key');
                                $list_id = $this->config->item('mailchimp_list_id_thai');
                                
                                // MailChimp API URL
                                $data_center = substr($mailchimp_api_key,strpos($mailchimp_api_key,'-')+1);
                                
                                $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';
                                
                                // member information
                                $new_user_data = array();
                                $new_user_data['email_address'] = $userProfile['email'];
                                $new_user_data['status'] = 'subscribed';
                                $new_user_data['merge_fields']['FNAME'] = $userProfile['first_name'];
                                $new_user_data['merge_fields']['LNAME'] = $userProfile['last_name'];
                                
                                $curl_data = get_web_page($url,$new_user_data,"POST", 'user '.$mailchimp_api_key);
                                
                                
                                $data = array(
                                    'status' => 'yes',
                                );    
                            }
                            
                        }
                              
                    }
                    
                    $this->auth->facebook_login($userProfile['email'], 1);
                    //$this->auth->login($userProfile['email'], $userData['password_hash'], 1);
                
                    // Get logout URL
                    $data['logoutUrl'] = $this->facebook->logout_url();
                    redirect(base_url());
                }//isset $userProfile['email']
            }
        }else{
            $fbuser = '';           
            // Get login URL
            $data['authUrl'] =  $this->facebook->login_url();
        }        
        Template::set('authUrl', $this->facebook->login_url());
        
        
        // Generate password hint messages.
        $this->user_model->password_hints();

        //Template::set_view('users/register');
        Template::set('languages', unserialize($this->settings_lib->item('site.languages')));
        Template::set('page_title', 'Register');
        Template::render('register');
    }
    
    /**
     * Update user language
     *
     * @return void
     */
    
    public function update_user_lang()
    {
        $return_array = array();
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        $user_id = $this->current_user->id;
        if(isset($_POST['lang'])){
            $lang = explode('-',$_POST['lang']);
            $this->db->where("id ",$user_id);
            $update = $this->db->update('users',array('language'=>$lang[1]));
            if($this->db->affected_rows() > 0){
                $return_array['status'] = 'success';
            }
            else{
                $return_array['status'] = 'error';
            }
        }
        else{
            $return_array['status'] = 'error';
        }
        echo json_encode($return_array);
        exit();        
    }
    
    
    /**
     * Display the registration form for the user and manage the registration process.
     *
     * The redirect URLs for success (Login) and failure (ajax_register_user) can be overridden
     * by including a hidden field in the form for each, named 'register_url' and
     * 'login_url' respectively.
     *
     * @return void
     */
    public function ajax_register_user()
    {
        // Are users allowed to register?
        if (! $this->settings_lib->item('auth.allow_register')) {
            Template::set_message(lang('us_register_disabled'), 'error');
            Template::redirect('/');
        }

        $register_url = $this->input->post('register_url') ?: REGISTER_URL;
        $login_url    = $this->input->post('login_url') ?: LOGIN_URL;

        $this->load->model('roles/role_model');
        $this->load->helper('date');

        $this->load->config('address');
        $this->load->helper('address');

        $this->load->config('user_meta');
        $meta_fields = config_item('user_meta_fields');
        Template::set('meta_fields', $meta_fields);
        
        $meta_data = array();
        
        $return_array = array();
        
        if(!empty($_POST)){ 
            if($this->input->post('key') == 'bf_new_user_register'){
                
                $extraUniqueRule = '';
                
                $ref_code = ((strlen(trim($this->input->post('ref_code'))) > 0)?$this->input->post('ref_code'):'');
                $data['email'] = trim($this->input->post('email'));
                $data['password'] = $this->input->post('password');
                $data['role_id'] = $this->input->post('role_id');
                $data['user_type'] = $this->input->post('user_type');    
                $data['active'] = 1;
                if(strlen(trim($this->input->post('language'))) > 0){ $data['language'] = trim($this->input->post('language')); }
                if(!empty($ref_code)){
                    
                    $this->db->select('*');
                    $this->db->from('user_meta');
                    $this->db->where('meta_key', REFERRAL_CODE_USER_META);
                    $this->db->where('meta_value', $ref_code);
                    $ref_query = $this->db->get();
                    if($ref_query->num_rows()){
                        
                        $ref_result = $ref_query->result_array();
                        
                        $this->db->select('email,id');
                        $this->db->from('users');
                        $this->db->where(array('email'=>$data['email']));
                        $prevQuery = $this->db->get();
                        $prevCheck = $prevQuery->num_rows();
                        $result = $prevQuery->result_array();
                        
                        //$extraUniqueRule = $result[0]['id'];
                       if ($this->input->post('password')) {
                            $this->form_validation->set_rules(
                                'password',
                                'lang:bf_password',
                                "required|min_length[8]"
                            );
                        }
                        
                        if ($this->input->post('pass_confirm')) {
                            $this->form_validation->set_rules(
                                'pass_confirm',
                                'lang:bf_password_confirm',
                                "required|matches[password]|min_length[8]"
                            );
                        }
                        
                        $this->form_validation->set_rules('email', 'lang:bf_email', "required|trim|valid_email|max_length[254]|unique[users.email{$extraUniqueRule}]");
                        
                        if($prevCheck > 0){
                            $return_array['status'] = 'error';
                        }
                        else{
                            $id = $this->user_model->insert($data);
                            $userID = $this->db->insert_id();
                            
                            if($userID){
                                
                                $ref_data = array( 
                                        'referral_code' =>  $ref_code, 
                                        'user_id'=>  $userID, 
                                        'referrer_id'   =>  $ref_result[0]['user_id'],
                                        'signup_date' => date("Y:m:d H:i:s"),
                                    );
                                $this->db->insert('referrals', $ref_data);
                                
                                $meta_data['first_name'] = $this->input->post('u_fname');
                                $meta_data['last_name'] = $this->input->post('u_lname');
                                if($this->input->post('phone_number')){
                                    $meta_data['phone_number'] = $this->input->post('phone_number');    
                                }
                                
                                if (is_numeric($userID) && ! empty($meta_data)) {
                                    $this->user_model->save_meta_for($userID, $meta_data);
                                    
                                    // Put all new users on the trial plan
                                    $data = array();
                                    $data['student_id'] = $userID;
                                    $data['plan_id'] = PLAN_TRIAL;
                                    $data['created_on'] = date('Y-m-d H:i:s');
                                    $id = $this->student_subscriptions_model->insert_sub($data);
        
        
                                    $user_url = site_url('admin/settings/users/edit/'.$userID);
                                    if($user_url){
                                       
                                        $to = SUPPORT_EMAIL;
                                        $subject = "New student registration";
                                        
                                        $message = "A new user has registered on the English Gang Student Portal. Click here <a href='".$user_url."'>here</a> to view the user.";
                                        $message .= "Name: " . $meta_data['first_name'] . " " . @$meta_data['last_name'] . '<br>';
                                        $message .= "Email: " . $this->input->post('email') . '<br>';
                                        $message .= "Phone: " . @$meta_data['phone_number'] . '<br>';
                                        
                                        // Always set content-type when sending HTML email
                                        $headers = "MIME-Version: 1.0" . "\r\n";
                                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                        
                                        // More headers
                                        $headers .= 'From: <no-reply@englishgang.com>' . "\r\n";
                                        
                                        if(mail($to,$subject,$message,$headers)){
                                            
                                            $mailchimp_api_key =$this->config->item('mailchimp_api_key');
                                            $list_id = $this->config->item('mailchimp_list_id_thai');
                                            
                                            // MailChimp API URL
                                            $data_center = substr($mailchimp_api_key,strpos($mailchimp_api_key,'-')+1);
                                            
                                            $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';
                                            
                                            // member information
                                            $new_user_data = array();
                                            $new_user_data['email_address'] = $this->input->post('email');
                                            $new_user_data['status'] = 'subscribed';
                                            $new_user_data['merge_fields']['FNAME'] = $this->input->post('u_fname');
                                            $new_user_data['merge_fields']['LNAME'] = $this->input->post('u_lname');
                                            
                                            $curl_data = get_web_page($url,$new_user_data,"POST", 'user '.$mailchimp_api_key);
                                            
                                            $data = array(
                                                'status' => 'yes',
                                            );
                                                
                                        }
                                        
                                    }
                                    
                                    // User Activation
                                    $activation = $this->user_model->set_activation($userID);
                                    $message = $activation['message'];
                                    $error   = $activation['error'];
                    
                                    Template::set_message($message, $error ? 'error' : 'success');
                                    
                                }    
                            }
                            
                            $return_array['status'] = 'success';
                            $return_array['user_id'] = !empty($userID)?$userID:'';
                            
                        }//$prevCheck is 0
                        
                    }//$ref_query
                    else{
                        $return_array['status'] = "no_ref";
                    }//no_ref

                }//!empty($ref_code)
                else{
                    
                    $this->db->select('email,id');
                    $this->db->from('users');
                    $this->db->where(array('email'=>$data['email']));
                    $prevQuery = $this->db->get();
                    $prevCheck = $prevQuery->num_rows();
                    $result = $prevQuery->result_array();
                    
                    //$extraUniqueRule = $result[0]['id'];
                   if ($this->input->post('password')) {
                        $this->form_validation->set_rules(
                            'password',
                            'lang:bf_password',
                            "required|min_length[8]"
                        );
                    }
                    
                    if ($this->input->post('pass_confirm')) {
                        $this->form_validation->set_rules(
                            'pass_confirm',
                            'lang:bf_password_confirm',
                            "required|matches[password]|min_length[8]"
                        );
                    }
                    
                    $this->form_validation->set_rules('email', 'lang:bf_email', "required|trim|valid_email|max_length[254]|unique[users.email{$extraUniqueRule}]");
                    
                    if($prevCheck > 0){
                        $return_array['status'] = 'error';
                    }
                    else{
                        $id = $this->user_model->insert($data);
                        $userID = $this->db->insert_id();
                        
                        if($userID){
                            $meta_data['first_name'] = $this->input->post('u_fname');
                            $meta_data['last_name'] = $this->input->post('u_lname');
                            if($this->input->post('phone_number')){
                                $meta_data['phone_number'] = $this->input->post('phone_number');    
                            }
                            
                            if (is_numeric($userID) && ! empty($meta_data)) {
                                $this->user_model->save_meta_for($userID, $meta_data);
                                
                                // Put all new users on the trial plan
                                $data = array();
                                $data['student_id'] = $userID;
                                $data['plan_id'] = PLAN_TRIAL;
                                $data['created_on'] = date('Y-m-d H:i:s');
                                $id = $this->student_subscriptions_model->insert_sub($data);
    
    
                                $user_url = site_url('admin/settings/users/edit/'.$userID);
                                if($user_url){
                                   
                                    $to = SUPPORT_EMAIL;
                                    $subject = "New student registration";
                                    
                                    $message = "A new user has registered on the English Gang Student Portal. Click here <a href='".$user_url."'>here</a> to view the user.<p>";
                                    $message .= "Name: " . $meta_data['first_name'] . " " . @$meta_data['last_name'] . '<br>';
                                    $message .= "Email: " . $this->input->post('email') . '<br>';
                                    $message .= "Phone: " . @$meta_data['phone_number'] . '<br>';
                                    
                                    // Always set content-type when sending HTML email
                                    $headers = "MIME-Version: 1.0" . "\r\n";
                                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                    
                                    // More headers
                                    $headers .= 'From: <no-reply@englishgang.com>' . "\r\n";
                                    
                                    if(mail($to,$subject,$message,$headers)){
                                        
                                        $mailchimp_api_key =$this->config->item('mailchimp_api_key');
                                        $list_id = $this->config->item('mailchimp_list_id_thai');
                                        
                                        // MailChimp API URL
                                        $data_center = substr($mailchimp_api_key,strpos($mailchimp_api_key,'-')+1);
                                        
                                        $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';
                                        
                                        // member information
                                        $new_user_data = array();
                                        $new_user_data['email_address'] = $this->input->post('email');
                                        $new_user_data['status'] = 'subscribed';
                                        $new_user_data['merge_fields']['FNAME'] = $this->input->post('u_fname');
                                        $new_user_data['merge_fields']['LNAME'] = $this->input->post('u_lname');
                                        
                                        $curl_data = get_web_page($url,$new_user_data,"POST", 'user '.$mailchimp_api_key);
                                        
                                        $data = array(
                                            'status' => 'yes',
                                        );
                                            
                                    }
                                    
                                }
                                
                                // User Activation
                                $activation = $this->user_model->set_activation($userID);
                                $message = $activation['message'];
                                $error   = $activation['error'];
                
                                Template::set_message($message, $error ? 'error' : 'success');
                                
                            }    
                        }
                        
                        $return_array['status'] = 'success';
                        $return_array['user_id'] = !empty($userID)?$userID:'';
                        
                    }//$prevCheck is 0
                    
                }//empty($ref_code)

            }//$_POST['key']
            else{
              $return_array['status'] = "error";
            }
        }
        
        // Generate password hint messages.
        $this->user_model->password_hints();

        //Template::set_view('users/register');
        Template::set('languages', unserialize($this->settings_lib->item('site.languages')));
        Template::set('page_title', 'Register');
                        
        echo json_encode($return_array);
        exit();

        
        
    }
    
    
    // -------------------------------------------------------------------------
    // Password Management
    // -------------------------------------------------------------------------

    /**
     * Allow a user to request the reset of a forgotten password. An email is sent
     * with a special temporary link that is only valid for 24 hours. This link
     * takes the user to reset_password().
     *
     * @return void
     */
    public function forgot_password()
    {
        //reset lang to chinese
        if (@$_GET['lang'] == 'zh' || @$_POST['lang'] == 'zh') {
            $this->lang->is_loaded = array();
            $this->lang->language = array();
            $this->lang->load('application', 'chinese');
        } 

        //reset lang to chinese
        if (@$_GET['lang'] == 'en' || @$_POST['lang'] == 'en') {
            $this->lang->is_loaded = array();
            $this->lang->language = array();
            $this->lang->load('application', 'english');
        } 

        // If the user is logged in, go home.
        if ($this->auth->is_logged_in() !== false) {
            Template::redirect('/');
        }

        if (isset($_POST['send'])) {
            // Validate the form to ensure a valid email was entered.
            $this->form_validation->set_rules('email', 'lang:bf_email', 'required|trim|valid_email');
            if ($this->form_validation->run() !== false) {
                // Validation passed. Does the user actually exist?
                $user = $this->user_model->find_by('email', $this->input->post('email'));
                if ($user === false) {
                    // No user found with the entered email address.
                    Template::set_message(lang('us_invalid_email'), 'error');
                } else {
                    // User exists, create a hash to confirm the reset request.
                    $this->load->helper('string');
                    $hash = sha1(random_string('alnum', 40) . $this->input->post('email'));

                    // Save the hash to the db for later retrieval.
                    $this->user_model->update_where(
                        'email',
                        $this->input->post('email'),
                        array('reset_hash' => $hash, 'reset_by' => strtotime("+24 hours"))
                    );

                    // Create the link to reset the password.
                    $pass_link = site_url('reset_password/' . str_replace('@', ':', $this->input->post('email')) . "/{$hash}");

                    // Now send the email
                    $this->load->library('emailer/emailer');
                    if (@$_GET['lang'] == 'zh' || @$_POST['lang'] == 'zh') {
                        $data = array(
                            'to'      => $this->input->post('email'),
                            'subject' => lang('us_reset_pass_subject'),
                            'message' => $this->load->view(
                                '_emails/chinese_forgot_password',
                                array('link' => $pass_link),
                                true
                            ),
                         );
                    } else {
                        $data = array(
                            'to'      => $this->input->post('email'),
                            'subject' => lang('us_reset_pass_subject'),
                            'message' => $this->load->view(
                                '_emails/forgot_password',
                                array('link' => $pass_link),
                                true
                            ),
                         );
                    }

                    if ($this->emailer->send($data)) {
                        Template::set_message(lang('us_reset_pass_message'), 'success');
                    } else {
                        Template::set_message(lang('us_reset_pass_error') . $this->emailer->error, 'error');
                    }
                }
            }
        }

        Template::set('page_type', 'forgot_password');
        Template::set_view('users/forgot_password');
        Template::set('page_title', 'Password Reset');
        Template::render();
    }

    /**
     * Allows the user to create a new password for their account. At the moment,
     * the only way to get here is to go through the forgot_password() process,
     * which creates a unique code that is only valid for 24 hours.
     *
     * Since 0.7 this method is also reached via the force_password_reset security
     * features.
     *
     * @param string $email The email address to check against.
     * @param string $code  A randomly generated alphanumeric code. (Generated by
     * forgot_password()).
     *
     * @return void
     */
    public function reset_password($email = '', $code = '')
    {
        // If the user is logged in, go home.
        if ($this->auth->is_logged_in() !== false) {
            Template::redirect('/');
        }

        // Bonfire may have stored the email and code in the session.
        if (empty($code) && $this->session->userdata('pass_check')) {
            $code = $this->session->userdata('pass_check');
        }

        if (empty($email) && $this->session->userdata('email')) {
            $email = $this->session->userdata('email');
        }

        // If there is no code/email, then it's not a valid request.
        if (empty($code) || empty($email)) {
            Template::set_message(lang('us_reset_invalid_email'), 'error');
            Template::redirect(LOGIN_URL);
        }

            // Handle the form
        if (isset($_POST['set_password'])) {
                $this->form_validation->set_rules('password', 'lang:bf_password', 'required|max_length[120]|valid_password');
                $this->form_validation->set_rules('pass_confirm', 'lang:bf_password_confirm', 'required|matches[password]');

            if ($this->form_validation->run() !== false) {
                // The user model will create the password hash.
                $data = array(
                    'password'   => $this->input->post('password'),
                                  'reset_by'    => 0,
                                  'reset_hash'  => '',
                    'force_password_reset' => 0,
                );

                if ($this->user_model->update($this->input->post('user_id'), $data)) {
                    log_activity($this->input->post('user_id'), lang('us_log_reset'), 'users');

                    Template::set_message(lang('us_reset_password_success'), 'success');
                    Template::redirect(LOGIN_URL);
                }

                if (! empty($this->user_model->error)) {
                    Template::set_message(sprintf(lang('us_reset_password_error'), $this->user_model->error), 'error');
                }
            }
        }

        // Check the code against the database
        $email = str_replace(':', '@', $email);
        $user = $this->user_model->find_by(
            array(
                'email'       => $email,
                'reset_hash'  => $code,
                'reset_by >=' => time(),
            )
        );

        // $user will be an Object if a single result was returned.
        if (! is_object($user)) {
            Template::set_message(lang('us_reset_invalid_email'), 'error');
            Template::redirect(LOGIN_URL);
        }

        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }

        // At this point, it is a valid request....
        Template::set('user', $user);
        Template::set('page_type', 'reset_password');
        Template::set_view('users/reset_password');
        Template::render();
    }

    public function password()
    {

        // If the user is logged in, go home.
        if ($this->auth->is_logged_in() === false) {
            Template::redirect('/login/');
        }
        else{
            $user_id = $this->session->userdata('user_id');
            
            $user_details = $this->user_model->find_user_and_meta($user_id);
        }

        // Validate existing password before

        // Handle the form
        if (isset($_POST['set_password'])) {
            
            if(!empty($user_details) && $user_details->is_fb_pass == 0){
                $this->form_validation->set_rules('old_password', 'lang:bf_old_password', 'required|max_length[120]|check_old_password');
            }
            $this->form_validation->set_rules('password', 'lang:bf_password', 'required|max_length[120]|valid_password');
            $this->form_validation->set_rules('pass_confirm', 'lang:bf_password_confirm', 'required|matches[password]');

            if ($this->form_validation->run() !== false) {
                
                $user_id = $this->session->userdata('user_id');
                
                if(!empty($user_details) && $user_details->is_fb_pass == 1){
                    
                    $data = array(
                        'password'   => $this->input->post('password'),
                        'is_fb_pass' => 0,   
                        'reset_by'    => 0,
                        'reset_hash'  => '',
                        'force_password_reset' => 0,
                    );

                    if ($this->user_model->update($user_id, $data)) {
                        log_activity($user_id, lang('us_log_reset'), 'users');

                        Template::set_message(lang('us_change_password_success'), 'success');
                    }

                    if (! empty($this->user_model->error)) {
                        Template::set_message(sprintf(lang('us_change_password_error'), $this->user_model->error), 'error');
                    }
                }
                else{
                    
                    $old_password = $this->input->post('old_password');
                
                    $selects = 'password_hash';
                    $user = $this->user_model->select($selects)->find_by('id', $user_id);                
                    if($this->auth->check_password($old_password, $user->password_hash))
                    {
                        $data = array(
                            'password'   => $this->input->post('password'),
                            'reset_by'    => 0,
                            'reset_hash'  => '',
                            'force_password_reset' => 0,
                        );
    
                        if ($this->user_model->update($user_id, $data)) {
                            log_activity($user_id, lang('us_log_reset'), 'users');
    
                            Template::set_message(lang('us_change_password_success'), 'success');
                        }
    
                        if (! empty($this->user_model->error)) {
                            Template::set_message(sprintf(lang('us_change_password_error'), $this->user_model->error), 'error');
                        }
    
                    } else {
                            
                        Template::set_message(lang('us_old_password_error'), 'error');                        
                    }
                }

            }
        }


        if ($this->siteSettings['auth.password_show_labels'] == 1) {
            Assets::add_js(
                $this->load->view('users_js', array('settings' => $this->siteSettings), true),
                'inline'
            );
        }
                
        Template::set('user_details', $user_details);
        Template::set('page_title', 'Change Password');
        Template::set('menu_page_type', 'my_account');
        Template::set('menu_subpage_type', 'change_password');

        Template::set_view('users/password');
        Template::render();
    }
    

    //--------------------------------------------------------------------------
    // ACTIVATION METHODS
    //--------------------------------------------------------------------------

    /**
     * Activate user.
     *
     * Checks a passed activation code and, if verified, enables the user account.
     * If the code fails, an error is generated.
     *
     * @param  integer $user_id The user's ID.
     *
     * @return void
     */
    public function activate($user_id = null)
    {
        if (isset($_POST['activate'])) {
            $this->form_validation->set_rules('code', 'Verification Code', 'required|trim');
            if ($this->form_validation->run()) {
                $code = $this->input->post('code');
                $activated = $this->user_model->activate($user_id, $code);
                if ($activated) {
                    $user_id = $activated;

                    // Now send the email.
                    $this->load->library('emailer/emailer');
                    $email_message_data = array(
                        'title' => $this->settings_lib->item('site.title'),
                        'link'  => site_url(LOGIN_URL),
                    );
                    $data = array(
                        'to'      => $this->user_model->find($user_id)->email,
                        'subject' => lang('us_account_active'),
                        'message' => $this->load->view('_emails/activated', $email_message_data, true),
                    );

                    if ($this->emailer->send($data)) {
                        Template::set_message(lang('us_account_active'), 'success');
                    } else {
                        Template::set_message(lang('us_err_no_email'). $this->emailer->error, 'error');
                    }

                    Template::redirect('/');
                }

                if (! empty($this->user_model->error)) {
                    Template::set_message($this->user_model->error . '. ' . lang('us_err_activate_code'), 'error');
                }
            }
        }

        Template::set_view('users/activate');
        Template::set('page_type', 'activate');
        Template::set('page_title', 'Account Activation');
        Template::render();
    }

    /**
     * Allow a user to request another activation code. If the email address matches
     * an existing account, the code is resent.
     *
     * @return void
     */
    public function resend_activation()
    {
        if (isset($_POST['send'])) {
            $this->form_validation->set_rules('email', 'lang:bf_email', 'required|trim|valid_email');

            if ($this->form_validation->run()) {
                // Form validated. Does the user actually exist?
                $user = $this->user_model->find_by('email', $_POST['email']);
                if ($user === false) {
                    Template::set_message('Cannot find that email in our records.', 'error');
                } else {
                    $activation = $this->user_model->set_activation($user->id);
                    $message = $activation['message'];
                    $error = $activation['error'];

                    Template::set_message($message, $error ? 'error' : 'success');
                }
            }
        }

        Template::set_view('users/resend_activation');
        Template::set('page_title', 'Activate Account');
        Template::render();
    }

    // -------------------------------------------------------------------------
    // Private Methods
    // -------------------------------------------------------------------------

    /**
     * Save the user.
     *
     * @param  string  $type            The type of operation ('insert' or 'update').
     * @param  integer $id              The id of the user (ignored on insert).
     * @param  array   $metaFields      Array of meta fields for the user.
     *
     * @return boolean/integer The id of the inserted user or true on successful
     * update. False if the insert/update failed.
     */
    private function saveUser($type = 'insert', $id = 0, $metaFields = array())
    {
        $extraUniqueRule = '';

        if ($type != 'insert') {
            if ($id == 0) {
                $id = $this->current_user->id;
            }
            $_POST['id'] = $id;

            // Security check to ensure the posted id is the current user's id.
            if ($_POST['id'] != $this->current_user->id) {
                $this->form_validation->set_message('email', 'lang:us_invalid_userid');
                return false;
            }

            $extraUniqueRule = ',users.id';
        }

        $this->form_validation->set_rules($this->user_model->get_validation_rules($type));

        $usernameRequired = '';
        if ($this->settings_lib->item('auth.login_type') == 'username'
            || $this->settings_lib->item('auth.use_usernames')
        ) {
            $usernameRequired = 'required|';
        }

        //$this->form_validation->set_rules('username', 'lang:bf_username', "{$usernameRequired}trim|max_length[30]|unique[users.username{$extraUniqueRule}]");
        $this->form_validation->set_rules('email', 'lang:bf_email', "required|trim|valid_email|max_length[254]|unique[users.email{$extraUniqueRule}]");

        // If a value has been entered for the password, pass_confirm is required.
        // Otherwise, the pass_confirm field could be left blank and the form validation
        // would still pass.
        if ($type != 'insert' && $this->input->post('password')) {
            $this->form_validation->set_rules('pass_confirm', 'lang:bf_password_confirm', "required|matches[password]");
        }

        $userIsAdmin = isset($this->current_user) && $this->current_user->role_id == 1;
        $metaData = array();
        foreach ($metaFields as $field) {
            $adminOnlyField = isset($field['admin_only']) && $field['admin_only'] === true;
            $frontEndField = ! isset($field['frontend']) || $field['frontend'];
            if ($frontEndField
                && ($userIsAdmin || ! $adminOnlyField)
            ) {
                $this->form_validation->set_rules($field['name'], $field['label'], $field['rules']);
                $metaData[$field['name']] = $this->input->post($field['name']);
            }
        }

        // Setting the payload for Events system.
        $payload = array('user_id' => $id, 'data' => $this->input->post());

        // Event "before_user_validation" to run before the form validation.
        Events::trigger('before_user_validation', $payload);

        if ($this->form_validation->run() === false) {
            return false;
        }

        // Compile our core user elements to save.
        $data = $this->user_model->prep_data($this->input->post());
        
        $result = false;

        if ($type == 'insert') {
            $activationMethod = $this->settings_lib->item('auth.user_activation_method');
            if ($activationMethod == 0) {
                // No activation method, so automatically activate the user.
                $data['active'] = 1;
            }

            $id = $this->user_model->insert($data);
            if (is_numeric($id)) {
                $result = $id;
            }
        } else {
            $result = $this->user_model->update($id, $data);
        }

        if (is_numeric($id) && ! empty($metaData)) {
            $this->user_model->save_meta_for($id, $metaData);
        }

        // Trigger event after saving the user.
        Events::trigger('save_user', $payload);

        return $result;
    }

    // -------------------------------------------------------------------------
    // Deprecated Methods (do not use)
    // -------------------------------------------------------------------------

    /**
     * Save the user.
     *
     * @deprecated since 0.7.1 Use saveUser(). Normally this would not be deprecated
     * because it is private, but just in case someone has a custom public controller
     * for their users module...
     *
     * @param integer $id          The id of the user in the case of an edit operation.
     * @param array   $meta_fields Array of meta fields fur the user.
     *
     * @return boolean True on successful update, else false.
           */
    private function save_user($id = 0, $meta_fields = array())
    {
        return $this->saveUser('update', $id, $meta_fields);
    }
    
    public function register_student(){
        
        // header('Access-Control-Allow-Origin: *'); 
        
        $return_array = array();
        $meta_data = array();
        
        if($this->input->post('key') == 'register_student'){
          
            $t_pass = $this->input->post('t_pass');
            $data['email'] = $this->input->post('t_email');
            $data['role_id'] = USER_ROLE_ID;
            if((strlen(trim($this->input->post('t_fname'))) <= 0) || (strlen(trim($this->input->post('t_lname'))) <= 0)){
                $data['display_name'] = $this->input->post('t_email');
            }
            else{
                $data['display_name'] = $this->input->post('t_fname').' '.$this->input->post('t_lname');
            }
            
            $data['active'] = 1;
            $data['created_on'] = date("Y-m-d H:i:s");
            $data['user_type'] = 'student';
            
            if(strlen(trim($this->input->post('language'))) > 0) { 
                $data['language'] = trim($this->input->post('language')); 
            } else {
                $data['language'] = 'thai';
            }                       
            
            $password = $this->auth->hash_password($t_pass);
            
            if (empty($password) || empty($password['hash'])) {
                return false;
            }
    
            $data['password_hash'] = $password['hash']; 
            
            $this->db->select('email,id');
            $this->db->from('users');
            $this->db->where(array('email'=>$data['email']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            $result = $prevQuery->result_array();
            
            if($prevCheck > 0){
                $return_array['status'] = 'error';
                
            }
            else{
                $id = $this->db->insert('users', $data);
                
                $userID = $this->db->insert_id();
                
                if($userID){
                    $meta_data['first_name'] = $this->input->post('t_fname');
                    $meta_data['last_name'] = $this->input->post('t_lname');
                    if($this->input->post('t_phn_no')){
                        $meta_data['phone_number'] = $this->input->post('t_phn_no');    
                    }
                    
                    if (is_numeric($userID) && ! empty($meta_data)) {
                        $this->user_model->save_meta_for($userID, $meta_data);
                        
                        $user_url = site_url('admin/settings/users/edit/'.$userID);

                        $data = array();
                        $data['student_id'] = $userID;
                        $data['plan_id'] = PLAN_TRIAL;
                        $data['created_on'] = date('Y-m-d H:i:s');
                        $id = $this->student_subscriptions_model->insert_sub($data);
                        
                        if($user_url){
                            
                            $to = SUPPORT_EMAIL;
                            $subject = "New student registration";
                            
                            $message = "A new user has registered on the English Gang Student Portal. Click here <a href='".$user_url."'>here</a> to view the user.<p>";
                            $message .= "Name: " . $meta_data['first_name'] . " " . @$meta_data['last_name'] . '<br>';
                            $message .= "Email: " . $this->input->post('t_email') . '<br>';
                            $message .= "Phone: " . @$meta_data['phone_number'] . '<br>';
                            
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

                            $this->email->initialize($config);
                            $this->email->set_mailtype("html");
                            $this->email->set_newline("\r\n");

                            $this->email->to($to);
                            $this->email->from('support@englishgang.com', EMAIL_FROM);
                            $this->email->subject($subject);
                            $this->email->message($message);

                            //Send email
                            $this->email->send();

                            $this->email->clear();
                            
                            $mailchimp_api_key =$this->config->item('mailchimp_api_key');
                            $list_id = $this->config->item('mailchimp_list_id_thai');
                            
                            // MailChimp API URL
                            $data_center = substr($mailchimp_api_key,strpos($mailchimp_api_key,'-')+1);
                            
                            $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members';
                            
                            // member information
                            $new_user_data = array();
                            $new_user_data['email_address'] = $this->input->post('t_email');
                            $new_user_data['status'] = 'subscribed';
                            $new_user_data['merge_fields']['FNAME'] = $this->input->post('t_fname');
                            $new_user_data['merge_fields']['LNAME'] = $this->input->post('t_lname');
                            
                            $curl_data = get_web_page($url,$new_user_data,"POST", 'user '.$mailchimp_api_key);
                            
                            $data = array(
                                'status' => 'yes',
                            );    
                            
                        }
                        
                    }    
                }
                
                $return_array['status'] = 'success';
            }
                
        }
        
        echo json_encode($return_array);
        exit();
    }
    
    public function book_new_class(){
        
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        
        if(strlen($this->input->post('key')) || strlen($this->session->flashdata('subscription_id'))){
            $user_id = $this->auth->user_id();
            $user = $this->user_model->find_user_and_meta($user_id);

            switch ($user->language) {
                case 'chinese':
                    $user_locale = 'zh';
                    break;
                case 'thai':
                    $user_locale = 'th';
                    break;
                default:
                    $user_locale = 'en';
                    break;
            }

            $default_timezone = date_default_timezone_get();
            
            $c_data['email'] = trim($user->email);
            $c_data['first_name'] = (isset($user->first_name)?(!empty($user->first_name)?trim($user->first_name):trim($user->display_name)):trim($user->display_name));
            $c_data['last_name'] = (isset($user->last_name)?(!empty($user->last_name)?trim($user->last_name):trim($user->display_name)):trim($user->display_name));
            // $c_data['profile']['timezone'] = (isset($user->timezone)?(!empty($user->timezone)?trim($user->timezone):$default_timezone):$default_timezone);
            $c_data['profile']['timezone'] = 'Asia/Bangkok';

            $c_data['is_active'] = true;
            $c_data['profile']['user_reference'] = generate_sso_user_reference($user_id);

            $c_data['profile']['locale'] = $user_locale;


            $c_data['profile']['company_slug'] = "english-gang-107727";
            
            if(!sso_user_exists($user_id)){//check if user does not exists
                $c_data['profile']['private_classes_allowed'] = $this->student_subscriptions_model->get_total_remaining_classes($user_id);
            }
            else{
                if(strlen($this->session->flashdata('subscription_id'))){
                    $subscription = $this->student_subscriptions_model->load_subscription($this->session->flashdata('subscription_id'));
                    $plan_data = $this->plans_model->load_plan($subscription['plan_id']);
                    $c_data['profile']['private_classes_allowed'] = intval($plan_data['number_classes']);
                    $c_data['add_classes'] = true;
                    //$c_data['profile']['private_classes_allowed'] = $this->student_subscriptions_model->get_total_remaining_classes($user_id);
                }                
            }

            $c_data['sso_type'] = "token";
            $c_data['token'] = generate_sso_validation_token($user_id);

            $r_response = create_learncube_user($c_data);
            if(empty($r_response)){
                $t_message['class'] = 'danger';
                $t_message['msg'] = 'No response from server, Please try again!';
            }
            else{
                if(isset($r_response->error)){
                    $t_message['class'] = 'danger';
                    $t_message['msg'] = 'Verification failed!';    
                }
                else{
                    redirect($r_response->redirect);
                }
            }
            
            Template::set('t_message',$t_message);
            Template::set_view('users/book_new_class');
            Template::set('page_title', 'Book new class');
            Template::render();
        }
        else{
            redirect('/');
        }
        
    }

    public function learncube_sso_endpoint(){
        
        $this->load->helper('learncube');
        
        $return = array();
        
        $json = file_get_contents('php://input');
        $c_data = json_decode($json);
        
        if((isset($c_data->profile->user_reference)) && (isset($c_data->token))){
            $explode_user_reference = explode('-',$c_data->profile->user_reference);
            $user_token = generate_sso_validation_token($explode_user_reference[0]);
            // if(($explode_user_reference[1] == 'EG' || $explode_user_reference[1] == 'ESL') && ($c_data->token == $user_token)){ --  cant check user token as we are using 2 different domains
            if($explode_user_reference[1] == 'EG' || $explode_user_reference[1] == 'ESL'){
                $response['status'] = true;
            }
            else{
                $response['status'] = false;
                $response['message'] = 'User not valid';
            }
        }
        else{
            $response['status'] = false;
            $response['message'] = 'User not valid';
        }
        
        header('Content-Type: application/json');
        echo json_encode($response);die;
    }    
}
/* End of file /bonfire/modules/users/controllers/users.php */
