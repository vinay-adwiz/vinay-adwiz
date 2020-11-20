<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Reports controller
 */
class Reports extends Admin_Controller
{
    protected $permissionCreate = 'Class_cancellations.Reports.Create';
    protected $permissionDelete = 'Class_cancellations.Reports.Delete';
    protected $permissionEdit   = 'Class_cancellations.Reports.Edit';
    protected $permissionView   = 'Class_cancellations.Reports.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('class_cancellations/class_cancellations_model');
        $this->lang->load('class_cancellations');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'reports/_sub_nav');

        Assets::add_module_js('class_cancellations', 'class_cancellations.js');
    }

    /**
     * Display a list of Class Cancellations data.
     *
     * @return void
     */
    public function index()
    {
        // Deleting anything?
        if (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);
            $checked = $this->input->post('checked');
            if (is_array($checked) && count($checked)) {

                // If any of the deletions fail, set the result to false, so
                // failure message is set if any of the attempts fail, not just
                // the last attempt

                $result = true;
                foreach ($checked as $pid) {
                    $deleted = $this->class_cancellations_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('class_cancellations_delete_success'), 'success');
                } else {
                    Template::set_message(lang('class_cancellations_delete_failure') . $this->class_cancellations_model->error, 'error');
                }
            }
        }
        
        
        
        $records = $this->class_cancellations_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('class_cancellations_manage'));

        Template::render();
    }
    
    /**
     * Create a Class Cancellations object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_class_cancellations()) {
                log_activity($this->auth->user_id(), lang('class_cancellations_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'class_cancellations');
                Template::set_message(lang('class_cancellations_create_success'), 'success');

                redirect(SITE_AREA . '/reports/class_cancellations');
            }

            // Not validation error
            if ( ! empty($this->class_cancellations_model->error)) {
                Template::set_message(lang('class_cancellations_create_failure') . $this->class_cancellations_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('class_cancellations_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Class Cancellations data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('class_cancellations_invalid_id'), 'error');

            redirect(SITE_AREA . '/reports/class_cancellations');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_class_cancellations('update', $id)) {
                log_activity($this->auth->user_id(), lang('class_cancellations_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'class_cancellations');
                Template::set_message(lang('class_cancellations_edit_success'), 'success');
                redirect(SITE_AREA . '/reports/class_cancellations');
            }

            // Not validation error
            if ( ! empty($this->class_cancellations_model->error)) {
                Template::set_message(lang('class_cancellations_edit_failure') . $this->class_cancellations_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->class_cancellations_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('class_cancellations_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'class_cancellations');
                Template::set_message(lang('class_cancellations_delete_success'), 'success');

                redirect(SITE_AREA . '/reports/class_cancellations');
            }

            Template::set_message(lang('class_cancellations_delete_failure') . $this->class_cancellations_model->error, 'error');
        }
        
        Template::set('class_cancellations', $this->class_cancellations_model->find($id));

        Template::set('toolbar_title', lang('class_cancellations_edit_heading'));
        Template::render();
    }

    //--------------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------------

    /**
     * Save the data.
     *
     * @param string $type Either 'insert' or 'update'.
     * @param int    $id   The ID of the record to update, ignored on inserts.
     *
     * @return boolean|integer An ID for successful inserts, true for successful
     * updates, else false.
     */
    private function save_class_cancellations($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->class_cancellations_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->class_cancellations_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->class_cancellations_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->class_cancellations_model->update($id, $data);
        }

        return $return;
    }
}