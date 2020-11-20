<?php defined('BASEPATH') || exit('No direct script access allowed');

class Student_subscriptions_model extends BF_Model
{
    protected $table_name	= 'student_subscriptions';
    protected $plans_table	= 'plans';
    protected $classes_table	= 'class_schedules';
    protected $class_cancellations_table    = 'class_cancellations';
    protected $class_override_table    = 'class_override';
    protected $curriculum_table    = 'curriculum';
	protected $key			= 'id';
	protected $date_format	= 'datetime';

	protected $log_user 	= false;
	protected $set_created	= true;
	protected $set_modified = false;
	protected $soft_deletes	= false;

	protected $created_field     = 'created_on';

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
			'field' => 'student_id',
			'label' => 'lang:student_subscriptions_field_student_id',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'plan_id',
			'label' => 'lang:student_subscriptions_field_plan_id',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'payment_id',
			'label' => 'lang:student_subscriptions_field_payment_id',
			'rules' => 'is_numeric',
		),
		array(
			'field' => 'completion_date',
			'label' => 'lang:student_subscriptions_field_completion_date',
			'rules' => '',
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


    public function insert_sub($data_array) {

		$this->db->insert($this->table_name, $data_array);
		$subscription_id = $this->db->insert_id();

		return $subscription_id;

    }


    public function load_subscription($subscription_id) {

        $this->db->where('id', $subscription_id);
        $this->db->select("*");
        $this->db->from($this->table_name);
                
        $query = $this->db->get();
        $result = $query->result_array();

        if (empty($result)) {
            return false;
        } else {
            return $result[0];
        }

    }


    public function get_current_package($user_id) {

    	$where = "student_id = " . $user_id . " AND status = " . SUBSCRIPTION_STATUS_ACTIVE;

		$this->db->select("{$this->table_name}.*, {$this->plans_table}.name");
        $this->db->from($this->table_name);
        $this->db->join($this->plans_table, "plans.id = {$this->table_name}.plan_id");
        $this->db->where($where);
        $this->db->order_by("id", "asc"); 
        
        $query = $this->db->get();
        $result = $query->result_array();

        $count = 0;
        if (empty($result)) {
        	
        	return false;

        } else {

            // Need to check for remaining classes as some classes may 
            // be booked on current package which hasnt expired yet
            foreach ($result as $key => $val) {

                $subscription_id = $val['id'];
                $remaining_classes = $this->calculate_remaining_classes($subscription_id);

                if ($remaining_classes > 0) {
                    // set this as 0 for legacy calls to function
                    $return[0] = $val;
                    $return[0]['remaining_classes'] = $remaining_classes;
                    return $return;
                } else {
                    // expire package
                    $this->complete_subscription_for_user($subscription_id);
                    $this->get_current_package($user_id);
                }
            }
        }
    }

    function get_last_class($student_id, $only_completed_classes = false) {

        if ($only_completed_classes) {
            $where = "student_id = " . $student_id . " AND status = " . CLASS_STATUS_COMPLETED;
        } else {
            $where = "student_id = " . $student_id . " AND status IN (" . CLASS_STATUS_BOOKED . ", " . CLASS_STATUS_COMPLETED . ")";
        }

        $this->db->select("*");
        $this->db->from($this->classes_table);
        $this->db->where($where);
        $this->db->order_by("class_start_date", "desc");
        $this->db->order_by("class_start_time", "desc"); 
        $this->db->limit(1);

        $query = $this->db->get();

        $result = $query->result_array();

        return $result;
    }

    public function get_next_class($student_id) {

        $remaining_credit = $this->get_total_remaining_classes($student_id);

        if (isset($remaining_credit) === FALSE || $remaining_credit < 1) {
        
            // Cant book anymore because no credits left    
            return false;
        
        } else {

            $last_class = $this->get_last_class($student_id);

            if (empty($last_class)) {
                // Student hasnt completed any classes yet so give them assessment class
                $last_curriculum = 0;
            } else {
                $last_curriculum = $last_class[0]['curriculum_id'];
            }

            $this->db->select("*");
            $this->db->from($this->curriculum_table);
            $this->db->where('previous_lesson', $last_curriculum);
            $this->db->where('active', '1');
            $this->db->order_by("id", "asc");
            $this->db->limit(1);
            
            $query = $this->db->get();
            $result = $query->result();

            if ($result) {
               $upcoming_id = $result[0]->id;

                $all_upcoming_classes = $this->student_subscriptions_model->get_student_upcoming_classes($student_id, 'student', CLASS_STATUS_BOOKED);

                if (empty($all_upcoming_classes) || $all_upcoming_classes === false) { // if has classes booked already ignore because DB already updated
                    $has_class_override = $this->has_class_override($student_id, $upcoming_id);
                    if ($has_class_override) {
                        $result = $this->curriculum_model->load_curriculum_by_id($has_class_override['id']);
                    }
                }
            }
            
            return $result;
        }

    }   

    // gets next class in DB without checking for any class overrides
    public function get_next_class_from_db($student_id) {

        $remaining_credit = $this->get_total_remaining_classes($student_id);

        if (isset($remaining_credit) === FALSE || $remaining_credit < 1) {
        
            // Cant book anymore because no credits left    
            return false;
        
        } else {

            $last_class = $this->get_last_class($student_id);

            if (empty($last_class)) {
                // Student hasnt completed any classes yet so give them assessment class
                $last_curriculum = 0;
            } else {
                $last_curriculum = $last_class[0]['curriculum_id'];
            }

            $this->db->select("*");
            $this->db->from($this->curriculum_table);
            $this->db->where('previous_lesson', $last_curriculum);
            $this->db->where('active', '1');
            
            $query = $this->db->get();
            $result = $query->result();

            return $result;
        }
    }   

    // checks to see if there are any overrides for their next class
    public function has_class_override($student_id, $next_lesson_id) {

        $this->load->model('curriculum/curriculum_model');

        $this->db->select("*");
        $this->db->from($this->class_override_table);
        $this->db->where('student_id', $student_id);
        $this->db->where('current_class_id', $next_lesson_id);
        $this->db->order_by('id', 'ASC');


        $query = $this->db->get();
        $result = $query->result();

        if ($result) {

            // load override details. if multiple, use latest one
            $max_in_array = max(array_keys($result));
            $override = $this->curriculum_model->load_curriculum_details($result[$max_in_array]->next_class_id);
            return $override;
        }

        return $result;
    }   

	public function calculate_booked_classes($subscription_id) {

        $this->load->model('class_cancellations/class_cancellations_model');

		$where = "subscription_id = " . $subscription_id;
		$this->db->where($where);
		$this->db->from($this->classes_table);

		$query = $this->db->get();
        $result = $query->result_array();

        $booked_classes = array();
        foreach ($result as $key => $value) {

        	if ($value['status'] == CLASS_STATUS_COMPLETED || $value['status'] == CLASS_STATUS_BOOKED) {
        		$booked_classes[] = $value;
        	} elseif ($value['status'] == CLASS_STATUS_CANCELLED_BY_STUDENT) {
        		
        		// If cancellation is chargeable, count it
                if ($this->is_chargeable_cancel($value['id'])) {
                    $booked_classes[] = $value;  
                }

        	} // if cancelled by teacher, dont count it
        		
        }
        
        return sizeof($booked_classes);
    }



    function is_chargeable_cancel($class_id) {
        $this->db->select("*");
        $this->db->from($this->class_cancellations_table);
        $this->db->where('class_id', $class_id); 

        $query = $this->db->get();
        $result = $query->result_array();

        if (empty($result)) {
            return false;
        } else {
            if ($result[0]['chargeable'] === '0') {
                return false;
            } else {
                return true;
            }
        }
    }

    // work out how many classes the student has left on this 
    // single subscription. Use get_total_remaining_classes function
    // below to check for multiple packages
    public function calculate_remaining_classes($subscription_id) {

    	$where = "{$this->table_name}.id = " . $subscription_id;

    	$this->db->select("{$this->table_name}.id, {$this->plans_table}.number_classes");
        $this->db->from($this->table_name);
        $this->db->join($this->plans_table, "plans.id = {$this->table_name}.plan_id");
        $this->db->where($where);
        
        $query = $this->db->get();
        $result = $query->result_array();

        $classes_available = $result[0]['number_classes'];
        $classes_booked = $this->calculate_booked_classes($subscription_id);

        $remaining_classes = $classes_available - $classes_booked;

        return intval($remaining_classes);
    }

    // Ignore chargeable classes because at the moment this is only
    // used to determine number of classes before eligibe for a refund.
    public function calculate_completed_classes($subscription_id) {

        $this->db->where('subscription_id', $subscription_id);
        $this->db->where('status', CLASS_STATUS_COMPLETED);
        $this->db->from($this->classes_table);
        $query = $this->db->get();

        return $query->num_rows();        
    }

    public function get_classes($student_id, $status = NULL, $for_date = NULL) {

    	$this->load->model('users/user_model');
    	$this->load->model('curriculum/curriculum_model');

    	$this->db->select("*");
        $this->db->from($this->classes_table);

        $this->db->where('student_id', $student_id);
        $this->db->order_by('curriculum_id', 'ASC');

        if (is_null($status) === false) {
        	$this->db->where('status', $status);
        }

        if (is_null($for_date) === false) {
            // Add where clause for classes only for that month/year
            if(!empty($for_date['year']) && !empty($for_date['month'])){
                $this->db->where('year(class_start_date) = '.$for_date['year']);
                $this->db->where('month(class_start_date) = '.$for_date['month']);    
            }
            elseif(!empty($for_date['year']) && empty($for_date['month'])){
                $this->db->where('year(class_start_date) = '.$for_date['year']);
            }
            elseif(empty($for_date['year']) && !empty($for_date['month'])){
                $this->db->where('month(class_start_date) = '.$for_date['month']);
            }
            else{
                
            }
            
        }
                
        $query = $this->db->get();
        $result = $query->result_array();

        $count = 0;
        if (empty($result) === false) {
			foreach ($result as $class) {
				$result[$count]['teacher_details'] = $this->user_model->load_teacher_profile($class['teacher_id']);
				$result[$count]['curriculum_details'] = $this->curriculum_model->load_curriculum_details($class['curriculum_id']);
				$count++;
			}
		}
		
        return $result;
    }

    // check to see if a student is eligible for a refund.
    // They must request refund within 24 hours of their first
    // paid class
    public function if_eligible_refund($student_id) {

        $current_package = $this->get_current_package($student_id);

        if ($current_package) {

            $subscription_id = $current_package[0]['id'];
            if ($current_package[0]['plan_id'] == PLAN_TRIAL) {
                return false; // cant refund free trial plan
            } else {
                
                if ($this->get_number_paid_subscriptions($student_id) !== 1) {
                    return false; // Only refund on the first subscription
                } else {

                    $completed_classes = $this->calculate_completed_classes($subscription_id);
                    if ($completed_classes == 0) {
                        return true; // Eligible as not used any classes
                    } elseif ($completed_classes == 1) {
                        
                        // Check date
                        $last_class = $this->get_last_class($student_id, true);
                        $last_class_ts = strtotime($last_class[0]['class_start_date'] . " " . $last_class[0]['class_start_time']);
                        
                        $allowed_refund_period = $last_class_ts + FREE_REFUND_PERIOD;
                        if (time() < $allowed_refund_period) {
                            return true; // within 1 week
                        } else {
                            return false; // cannot as over 1 week grace period
                        }

                        return true;
                    } elseif ($completed_classes > 1) {
                        return false; // Not eligible as already completed more than 1 class
                    }
                }
            }

        } else {

            return false; // they dont have a valid package so nothing to refund
        }

        
    }   

    public function get_number_paid_subscriptions($student_id) {

        $this->db->distinct("plan_id");
        $this->where('payment_id IS NOT', NULL);
        $this->where('student_id', $student_id);
        $query = $this->db->get($this->table_name);

        return $query->num_rows();
    }

    public function update_subscription($sub_id, $data) {
        
        if (empty($data) === false) {
            $this->db->where('id', $sub_id);
            $this->db->update($this->table_name, $data); 
        }
        
        return true;
    }

    public function cancel_subscription($sub_id, $cancel_type) {
        
        $cancel_data = array('status' => $cancel_type);
        $this->update_subscription($sub_id, $cancel_data);
        
        return true;
    }

    public function complete_subscription_for_user($sub_id) {

        $data = array(
               'status' => SUBSCRIPTION_STATUS_COMPLETED,
               'completion_date' => date('Y-m-d H:i:s'),
            );
        
        $this->db->where('id', $sub_id);
        $this->db->update($this->table_name, $data); 

        return true;
    }   

    public function expire_subscriptions_for_user($student_id, $ignore_sub_id = NULL) {

        $data = array(
               'status' => SUBSCRIPTION_STATUS_COMPLETED,
               'completion_date' => date('Y-m-d H:i:s'),
            );

        if (empty($ignore_sub_id) === false) {
            $this->db->where('id !=', $ignore_sub_id);
        }

        $this->db->where('student_id', $student_id);
        $this->db->update($this->table_name, $data); 

        return true;
    }      

    function get_total_remaining_classes($user_id) {
        
        $where = "student_id = " . $user_id . " AND status = " . SUBSCRIPTION_STATUS_ACTIVE;

        $this->db->select("{$this->table_name}.*, {$this->plans_table}.name");
        $this->db->from($this->table_name);
        $this->db->join($this->plans_table, "plans.id = {$this->table_name}.plan_id");
        $this->db->where($where);

        $query = $this->db->get();
        $result = $query->result_array();

        if (empty($result)) {
            
            return 0;

        } else {

            $class_count = 0;
            foreach ($result as $key => $val) {

                $remaining_classes = $this->calculate_remaining_classes($val['id']);    
                $class_count = $class_count + $remaining_classes;
            }
            return $class_count;
        }
    }

    public function get_student_upcoming_classes($user_id) {

        $this->load->model('users/user_model');
        $this->load->model('curriculum/curriculum_model');

        $date_now = date('Y-m-d'); 
        $time_now = date('H:i:s'); 

        $custom_query = "SELECT * FROM `bf_class_schedules` WHERE `student_id` = ".$user_id." AND `status` = ".CLASS_STATUS_BOOKED." AND (`class_start_date` > '".$date_now."' OR (`class_start_date` = '".$date_now."' AND `class_start_time` > '".$time_now."'))";
        $query = $this->db->query($custom_query);

        $result = $query->result_array();

        $count = 0;
        if (empty($result) === false) {
            foreach ($result as $class) {
                $result[$count]['student_details'] = $this->user_model->find_user_and_meta($class['student_id']);
                $result[$count]['teacher_details'] = $this->user_model->find_user_and_meta($class['teacher_id']);
                $result[$count]['curriculum_details'] = $this->curriculum_model->load_curriculum_details($class['curriculum_id']);
                $count++;
            }
        }

        return $result;
    }

    function get_next_class_from_curriculum_id($curriculum_id) {
        
        $this->db->select("*");
        $this->db->from($this->curriculum_table);
        $this->db->where('previous_lesson', $curriculum_id);
        $this->db->where('active', '1');
        $this->db->order_by("id", "asc");
        $this->db->limit(1);

        $query = $this->db->get();
        $result = $query->result();            
        return $result;
    }

    function get_max_date($user_id) {
        
        $where = "student_id = " . $user_id . " AND status IN (" . CLASS_STATUS_BOOKED . ", " . CLASS_STATUS_COMPLETED . ")";

        $this->db->select_max("class_start_date");
        $this->db->from($this->classes_table);
        $this->db->where($where);

        $query = $this->db->get();
        $result = $query->result_array();

        if (empty($result) === false) {
            return $result[0]['class_start_date'];
        } else {
            return false;
        }
    }

    function get_max_time($user_id, $class_date) {
        
        $where = "student_id = " . $user_id . " AND class_start_date = '" . $class_date . "' AND status IN (" . CLASS_STATUS_BOOKED . ", " . CLASS_STATUS_COMPLETED . ")";

        $this->db->select_max("class_start_time");
        $this->db->from($this->classes_table);
        $this->db->where($where);

        $query = $this->db->get();
        $result = $query->result_array();

        if (empty($result) === false) {
            return $result[0]['class_start_time'];
        } else {
            return false;
        }
    }


}