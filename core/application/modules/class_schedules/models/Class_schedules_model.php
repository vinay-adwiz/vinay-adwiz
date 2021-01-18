<?php defined('BASEPATH') || exit('No direct script access allowed');

class Class_schedules_model extends BF_Model
{
    protected $table_name	= 'class_schedules';
    protected $teacher_availability_table	= 'bf_teacher_availability';
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
			'field' => 'class_start_date',
			'label' => 'lang:class_schedules_field_available_start_date',
			'rules' => 'required',
		),
		array(
			'field' => 'class_start_time',
			'label' => 'lang:class_schedules_field_available_start_time',
			'rules' => 'required',
		),
		array(
			'field' => 'class_end_date',
			'label' => 'lang:class_schedules_field_available_end_date',
			'rules' => 'required',
		),
		array(
			'field' => 'class_end_time',
			'label' => 'lang:class_schedules_field_available_end_time',
			'rules' => 'required',
		),
		array(
			'field' => 'teacher_id',
			'label' => 'lang:class_schedules_field_teacher_id',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'student_id',
			'label' => 'lang:class_schedules_field_student_id',
			'rules' => 'integer',
		),
		array(
			'field' => 'curriculum_id',
			'label' => 'lang:class_schedules_field_curriculum_id',
			'rules' => 'trim|is_numeric',
		),
		array(
			'field' => 'is_peak_period',
			'label' => 'lang:class_schedules_field_is_peak_period',
			'rules' => 'required|alpha_numeric',
		),
		array(
			'field' => 'zoom_url',
			'label' => 'lang:class_schedules_field_zoom_url',
			'rules' => 'max_length[255]',
		),
		array(
			'field' => 'status',
			'label' => 'lang:class_schedules_field_status',
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

    public function load_class_details($class_id) {

    	$this->load->model('users/user_model');

    	$this->db->where('id', $class_id);
        $this->db->from($this->table_name);

        $query = $this->db->get();
        $result = $query->result_array();

        if (empty($result)) {
        	return false;
        } else {
        	$class_details = $result[0];
        	
        	$teacher_id = $class_details['teacher_id'];
        	$student_id = $class_details['student_id'];

        	$class_details['teacher'] = $this->user_model->find_user_and_meta($teacher_id);
        	$class_details['student'] = $this->user_model->find_user_and_meta($student_id);

        	return $class_details;
        }
    }

    // used to re-open slot for teacher after student cancels
    public function open_teacher_availability($slot_date, $slot_time, $teacher_id) {

    	$data = array('available_slot' => '1');
    	$this->db->update($this->teacher_availability_table, $data, array('teacher_id' => $teacher_id, 'available_start_date' => $slot_date, 'available_start_time' => $slot_time));

      // 2 slots booked so re-open next also
      $first_slot = strtotime($slot_time);
      $second_slot = date("H:i", strtotime('+30 minutes', $first_slot));

      $this->db->update($this->teacher_availability_table, $data, array('teacher_id' => $teacher_id, 'available_start_date' => $slot_date, 'available_start_time' => $second_slot));

      return true;
    }

	public function has_class_booking($available_start_date, $start_time, $teacher_id) {

    	$this->db->select('*');
        $this->db->from('bf_class_schedules');
        $this->db->where("class_start_date ",$available_start_date);
        $this->db->where("class_start_time ",$start_time);
        $this->db->where("teacher_id ",$teacher_id);
        $this->db->where("status ",CLASS_STATUS_BOOKED);
                
        $has_class = $this->db->count_all_results();

        if ($has_class > 0) {
        	return true;
        } else {
        	return false;
        }
    }
    
    public function is_day_last_slot($available_start_date, $start_time, $teacher_id) {

    	$this->db->select('*');
        $this->db->from('bf_teacher_availability');
        $this->db->where("available_start_date ",$available_start_date);
        $this->db->where("available_start_time ",$start_time);
        $this->db->where("teacher_id ",$teacher_id);
                
        $has_slot = $this->db->count_all_results();

        if ($has_slot == 0) {
        	return true;
        } else {
        	return false;
        }
    }
    
    public function has_more_classes_available($student_id){
        $count_lessons = $this->db->count_all_results('bf_curriculum');
        
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->where("student_id ",$student_id);
        $scheduled_rows = $this->db->count_all_results();
        
        $remaining_user_lessons = $count_lessons-$scheduled_rows;
        if($remaining_user_lessons > 1){
            return true;
        }
        else{
            return false;
        }
        
    }
    
}