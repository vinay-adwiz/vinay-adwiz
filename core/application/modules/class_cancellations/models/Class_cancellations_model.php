<?php defined('BASEPATH') || exit('No direct script access allowed');

class Class_cancellations_model extends BF_Model
{
   protected $table_name	= 'class_cancellations';
   protected $student_subscriptions_table   = 'student_subscriptions';
   protected $classes_table	= 'class_schedules';
   protected $teacher_availability_table	= 'teacher_availability';
	protected $key			= 'id';
	protected $date_format	= 'datetime';

	protected $log_user 	= false;
	protected $set_created	= true;
	protected $set_modified = false;
	protected $soft_deletes	= false;

	protected $created_field     = 'cencellation_date';

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
			'field' => 'class_id',
			'label' => 'lang:class_cancellations_field_class_id',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'cancelled_by',
			'label' => 'lang:class_cancellations_field_cancelled_by',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'cancellation_reason',
			'label' => 'lang:class_cancellations_field_cancellation_reason',
			'rules' => 'required|trim|alpha_extra',
		),
		array(
			'field' => 'chargeable',
			'label' => 'lang:class_cancellations_field_chargeable',
			'rules' => 'required|is_numeric',
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


	// Cancel a class. Data passed in by array
	// Array should contain class_id, cancelled_by,
	// is_chargeable and cancellation_reason
    public function cancel_class($cancel_data) {

    	$chargeable = $cancel_data['is_chargeable'] ? '1' : '0';

    	// insert into cancellations table
    	$data = array(
		   'class_id' => $cancel_data['class_id'],
		   'cancelled_by' => $cancel_data['cancelled_by'],
		   'cancellation_reason' => $cancel_data['cancellation_reason'],
		   'chargeable' => $chargeable,
		   'cencellation_date' => date("Y-m-d H:i:s")

		);

		$this->db->insert($this->table_name, $data); 	

		// clear old query
		$this->db->flush_cache();

    	// Update status of class
    	$update_data = array(
               'status' => CLASS_STATUS_CANCELLED_BY_STUDENT,
               'update_google' => '1'
            );

		$this->db->where('id', $cancel_data['class_id']);
		if ($this->db->update($this->classes_table, $update_data)) {
			$this->cancelled_class_cleanup($cancel_data['class_id']);
			return true;
		} else {
			return false;
		}
	}

	function update_teacher_availability($class_id) {

		return true; // i dont think we need to use for this now?
  // 	   $this->db->where('id', $class_id);
  //       $this->db->from($this->classes_table);

  //       $query = $this->db->get();
  //       $result = $query->result_array();

  //       if (empty($result)) {
  //       	return false;
  //       } else {

  //       	$class_start_date = $result[0]['class_start_date'];
  //       	$class_start_time = $result[0]['class_start_time'];
  //       	$teacher_id = $result[0]['teacher_id'];

  //       	$this->db->where('available_start_date', $class_start_date);
  //       	$this->db->where('available_start_time', $class_start_time);
  //       	$this->db->where('teacher_id', $teacher_id);

  //       	$this->db->delete($this->teacher_availability);
  //       	return true;
  //       }

	}

    // If a class is cancelled, make sure we check any future classes
    // and update their class id so that we always stay in correct 
    // order or classes. Also update teacher availability
    public function cancelled_class_cleanup($cancelled_class_id) {

        $this->db->where('id', $cancelled_class_id);
        $this->db->from($this->classes_table);

        $query = $this->db->get();
        $result = $query->result_array();

        if (empty($result)) {
        	return true;
        } else {

        	// check to make sure it hasnt run before

        	$cancelled_curriculum_id = $result[0]['curriculum_id'];
        	$student_id = $result[0]['student_id'];
          $subscription_id = $result[0]['subscription_id'];

        	// get all future bookings
        	$this->db->where('student_id', $student_id);
        	$this->db->where('curriculum_id >', $cancelled_curriculum_id);
        	$this->db->where('status', CLASS_STATUS_BOOKED);
	        $this->db->from($this->classes_table);

	        $query = $this->db->get();
	        $result = $query->result_array();

	        foreach($result as $key => $value) {

	        	$new_cid = $value['curriculum_id'] - 1;
	        	$data = array(
	               'curriculum_id' => $new_cid,
	            );

				$this->db->where('id', $value['id']);
				$this->db->update($this->classes_table, $data); 
	        }

         // Make sure to check and update subscriptions expired
         $subscription = $this->student_subscriptions_model->load_subscription($subscription_id);
         if ($subscription['status'] == SUBSCRIPTION_STATUS_COMPLETED) {
            $data = array();
            $data['status'] = SUBSCRIPTION_STATUS_ACTIVE;
            $data['completion_date'] = '0000-00-00 00:00:00';
            $this->db->where('id', $subscription_id);
            $this->db->update($this->student_subscriptions_table, $data); 
         }

	     return true;
	    }
	}

    // Check is class id exists
    public function class_exists($class_id) {

    	$this->db->where('id', $class_id);
        $this->db->from($this->classes_table);
        if ($this->db->count_all_results() < 1) {
        	return false;
        } else {
        	return true;
        }
    }

    // If a class is cancelled, check to see if its not within
    // allowed period and charge for cancellation
    public function is_chargeable_cancellation($cancelled_class_id) {

    	$this->db->where('id', $cancelled_class_id);
        $this->db->from($this->classes_table);

        $query = $this->db->get();
        $result = $query->result_array();

        if (empty($result)) {
        	return false;
        }

        $class_ts = strtotime($result[0]['class_start_date'] . " " . $result[0]['class_start_time']);

        if (($class_ts - time()) > FREE_CANCELLATION_PERIOD) {
        	return false; // more than 24 hours notice so free cancellation
        } else {
        	return true; // less than 24 hours notice so we need to charge
        }

    }

}