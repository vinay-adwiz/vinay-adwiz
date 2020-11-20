<?php defined('BASEPATH') || exit('No direct script access allowed');

class Curriculum_model extends BF_Model
{
    protected $table_name	= 'curriculum';
    protected $schedules_table_name	= 'class_schedules';
    protected $c_unit_table_name	= 'curriculum_units';
    protected $c_level_table_name	= 'curriculum_levels';

	protected $key			= 'id';
	protected $date_format	= 'datetime';

	protected $log_user 	= false;
	protected $set_created	= true;
	protected $set_modified = true;
	protected $soft_deletes	= false;

	protected $created_field     = 'created_on';
	protected $modified_field    = 'modified_on';

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
			'field' => 'curriculum_unit',
			'label' => 'lang:curriculum_field_curriculum_unit',
			'rules' => 'required',
		),
		array(
			'field' => 'lesson_number',
			'label' => 'lang:curriculum_field_lesson_number',
			'rules' => 'trim',
		),
		array(
			'field' => 'topic',
			'label' => 'lang:curriculum_field_topic',
			'rules' => 'required|trim|max_length[255]',
		),
		array(
			'field' => 'theme',
			'label' => 'Theme',
			'rules' => 'trim|max_length[255]',
		),
		array(
			'field' => 'phrases',
			'label' => 'lang:curriculum_field_phrases',
			'rules' => 'trim|max_length[1000]',
		),
		array(
			'field' => 'vocabulary',
			'label' => 'lang:curriculum_field_vocabulary',
			'rules' => 'max_length[1000]',
		),
		array(
			'field' => 'previous_lesson',
			'label' => 'lang:curriculum_field_previous_lesson',
			'rules' => 'is_numeric',
		),
		array(
			'field' => 'active',
			'label' => 'lang:curriculum_field_active',
			'rules' => 'is_numeric',
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

    public function get_level_from_curriculum_unit($unit_id) {

		$this->db->select('level'); 
		$this->db->from($this->c_unit_table_name); 
		$this->db->where('id', $unit_id); 
		$query = $this->db->get();
		$results = $query->result();

		if(empty($results)) {
			return false;
		} else {
			return $results[0]->level;
		}
    }

    public function get_all_curriculum_units($curriculum_level = NULL, $curriculum_unit = NULL) {
    	

		$this->db->select('*'); 
		$this->db->from($this->table_name); 

		if (empty($curriculum_unit) === false) {
			$this->db->where('curriculum_unit', $curriculum_unit); 
		} else {
			$this->db->where('curriculum_level', $curriculum_level); 
		}
		
		$query = $this->db->get();
		
    	$result = $query->result_array();
    	return $result;
    }

    public function load_curriculum_details($curriculum_id) {
    	
		$this->db->select("{$this->table_name}.*, {$this->c_level_table_name}.level, {$this->c_unit_table_name}.unit" ); 
		$this->db->from($this->table_name); 
		$this->db->join($this->c_level_table_name, "{$this->c_level_table_name}.id = {$this->table_name}.curriculum_level", "left outer");
		$this->db->join($this->c_unit_table_name, "{$this->c_unit_table_name}.id = {$this->table_name}.curriculum_unit", "left outer");
		$this->db->where("{$this->table_name}.id", $curriculum_id); 
		
		$query = $this->db->get();

    	$result = $query->result_array();

		if (empty($result)) {
        	return false;
        } else {
        	return $result[0];
        }
    }


		public function get_curriculum_id_from_class($class_id) {

		$this->db->select('curriculum_id');
		$this->db->where('id', $class_id);
    	$this->db->from($this->schedules_table_name);
		
		$query = $this->db->get();

    	$result = $query->result_array();

		if (empty($result)) {
        	return false;
        } else {
        	return $result[0]['curriculum_id'];
        }
    }


    public function get_number_lessons_curriculum_level($curriculum_level) {

    	$this->db->where('curriculum_level', $curriculum_level);
		$this->db->from($this->table_name);
		return $this->db->count_all_results();
    }

    public function get_number_lessons_completed_curriculum_level($user_id, $curriculum_level) {

    	$this->db->where("{$this->table_name}.curriculum_level", $curriculum_level);
    	$this->db->where("{$this->schedules_table_name}.student_id", $user_id);
    	$this->db->where("{$this->schedules_table_name}.status", CLASS_STATUS_COMPLETED);
		$this->db->from($this->table_name); 
		$this->db->join($this->schedules_table_name, "bf_class_schedules.curriculum_id = {$this->table_name}.id");

		return $this->db->count_all_results();
    }

    public function load_curriculum_by_id($curriculum_id) {

      $this->db->select("*");
      $this->db->from($this->table_name);
      $this->db->where('id', $curriculum_id);
      $query = $this->db->get();  
      $result = $query->result();

      return $result;

   }
}