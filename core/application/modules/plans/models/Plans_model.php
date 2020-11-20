<?php defined('BASEPATH') || exit('No direct script access allowed');

class Plans_model extends BF_Model
{
    protected $table_name	= 'plans';
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
			'field' => 'name',
			'label' => 'lang:plans_field_name',
			'rules' => 'required|unique[bf_plans.name,bf_plans.id]|trim|alpha_extra|max_length[64]',
		),
		array(
			'field' => 'price',
			'label' => 'lang:plans_field_price',
			'rules' => 'required',
		),
		array(
			'field' => 'number_classes',
			'label' => 'lang:plans_field_number_classes',
			'rules' => 'required|trim|is_numeric',
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

    public function get_all_packages($show_hidden = false) {

    	if ($show_hidden === false) {
    		$this->db->where('hidden', '0');
 		}

		$this->db->select("{$this->table_name}.*");
        $this->db->from($this->table_name);
        
        
        $query = $this->db->get();
        $result = $query->result_array();

        return $result;
    }

    public function load_plan($plan_id) {

    	$this->db->where('id', $plan_id);
		$this->db->select("*");
        $this->db->from($this->table_name);
                
        $query = $this->db->get();
        $result = $query->result_array();

        return $result[0];
    }
}