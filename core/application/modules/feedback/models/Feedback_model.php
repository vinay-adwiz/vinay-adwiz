<?php defined('BASEPATH') || exit('No direct script access allowed');

class Feedback_model extends BF_Model
{
    protected $table_name	= 'feedback';
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
			'field' => 'user_id',
			'label' => 'lang:feedback_field_user_id',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'provided_by',
			'label' => 'lang:feedback_field_provided_by',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'feedback_type',
			'label' => 'lang:feedback_field_feedback_type',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'class_id',
			'label' => 'lang:feedback_field_class_id',
			'rules' => 'is_numeric',
		),
		array(
			'field' => 'rating',
			'label' => 'lang:feedback_field_rating',
			'rules' => 'max_length[10]',
		),
		array(
			'field' => 'feedback',
			'label' => 'lang:feedback_field_feedback',
			'rules' => 'trim',
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

    // Checks if teacher feedback has been provided. False if it hasnt
    // and feedback details if it has
    public function has_feedback($class_id, $feedback_type) {

    	$this->db->where('class_id', $class_id);
    	$this->db->where('feedback_type', $feedback_type);
    	$this->db->from($this->table_name);
    	$query = $this->db->get();

        if ($query->num_rows()) {
            $result = $query->result_array();
            return $result[0];
        } else {
        	return false;
        }
    }

    // Checks if teacher feedback has been provided. False if it hasnt
    // and feedback details if it has
    public function load_student_feedback($student_id) {

      $this->db->where('user_id', $student_id);
      $this->db->where('feedback_type', FEEDBACK_TYPE_STUDENT);
      $this->db->from($this->table_name);
      $query = $this->db->get();

        if ($query->num_rows()) {
            $result = $query->result_array();
            return $result;
        } else {
         return false;
        }
    }
    
    public function load_feedback_details($feedbacks){
        
        foreach($feedbacks as $key => $feedback){
            $feedbacks[$key]['teacher'] = $this->user_model->find_user_and_meta($feedback['provided_by']);
            
            $this->db->where('id', $feedback['class_id']);
            $this->db->from('class_schedules');
            $query = $this->db->get();
            $feedbacks[$key]['class'] = $query->row();
            
            $this->db->where('id', $feedback['class_id']);
    		$this->db->from('curriculum'); 
            $query_2 = $this->db->get();
            $feedbacks[$key]['curriculum'] = $query_2->row();
        }
        
        return $feedbacks;
    }
}