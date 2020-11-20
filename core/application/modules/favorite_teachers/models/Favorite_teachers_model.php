<?php defined('BASEPATH') || exit('No direct script access allowed');

class Favorite_teachers_model extends BF_Model
{
    protected $table_name	= 'favorite_teachers';
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
			'field' => 'student_id',
			'label' => 'lang:favorite_teachers_field_student_id',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'teacher_id',
			'label' => 'lang:favorite_teachers_field_teacher_id',
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

    public function add_favorite($student_id, $teacher_id) {

    	$data = array(
		   'student_id' => $student_id,
		   'teacher_id' => $teacher_id
		);

		return $this->db->insert($this->table_name, $data); 

    }

    public function is_favorite($student_id, $teacher_id) {

    	$this->db->where('student_id', $student_id);
    	$this->db->where('teacher_id', $teacher_id);
    	$this->db->from($this->table_name);
    	$query = $this->db->get();

        if ($query->num_rows()) {
            return true;
        } else {
        	return false;
        }

    }

    public function remove_favorite($student_id, $teacher_id) {

    	$this->db->where('student_id', $student_id);
    	$this->db->where('teacher_id', $teacher_id);
		return $this->db->delete($this->table_name); 

    }
}