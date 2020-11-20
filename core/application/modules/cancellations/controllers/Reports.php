<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Reports controller
 */
class Reports extends Admin_Controller
{
    protected $permissionCreate = 'Cancellations.Reports.Create';
    protected $permissionDelete = 'Cancellations.Reports.Delete';
    protected $permissionEdit   = 'Cancellations.Reports.Edit';
    protected $permissionView   = 'Cancellations.Reports.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('cancellations/cancellations_model');
        $this->lang->load('cancellations');
        
            Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
            Assets::add_js('jquery-ui-1.8.13.min.js');
            Assets::add_css('jquery-ui-timepicker.css');
            Assets::add_js('jquery-ui-timepicker-addon.js');
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'reports/_sub_nav');

        Assets::add_module_js('cancellations', 'cancellations.js');
    }

    /**
     * Display a list of Cancellations data.
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
                    $deleted = $this->cancellations_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('cancellations_delete_success'), 'success');
                } else {
                    Template::set_message(lang('cancellations_delete_failure') . $this->cancellations_model->error, 'error');
                }
            }
        }
        
        
        
        $records = $this->cancellations_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('cancellations_manage'));

        Template::render();
    }
    
    /**
     * Create a Cancellations object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_cancellations()) {
                log_activity($this->auth->user_id(), lang('cancellations_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'cancellations');
                Template::set_message(lang('cancellations_create_success'), 'success');

                redirect(SITE_AREA . '/reports/cancellations');
            }

            // Not validation error
            if ( ! empty($this->cancellations_model->error)) {
                Template::set_message(lang('cancellations_create_failure') . $this->cancellations_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('cancellations_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Cancellations data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('cancellations_invalid_id'), 'error');

            redirect(SITE_AREA . '/reports/cancellations');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_cancellations('update', $id)) {
                log_activity($this->auth->user_id(), lang('cancellations_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'cancellations');
                Template::set_message(lang('cancellations_edit_success'), 'success');
                redirect(SITE_AREA . '/reports/cancellations');
            }

            // Not validation error
            if ( ! empty($this->cancellations_model->error)) {
                Template::set_message(lang('cancellations_edit_failure') . $this->cancellations_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->cancellations_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('cancellations_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'cancellations');
                Template::set_message(lang('cancellations_delete_success'), 'success');

                redirect(SITE_AREA . '/reports/cancellations');
            }

            Template::set_message(lang('cancellations_delete_failure') . $this->cancellations_model->error, 'error');
        }
        
        Template::set('cancellations', $this->cancellations_model->find($id));

        Template::set('toolbar_title', lang('cancellations_edit_heading'));
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
    private function save_cancellations($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->cancellations_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->cancellations_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        
		$data['refund_date']	= $this->input->post('refund_date') ? $this->input->post('refund_date') : '0000-00-00 00:00:00';

        $return = false;
        if ($type == 'insert') {
            $id = $this->cancellations_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->cancellations_model->update($id, $data);
        }

        return $return;
    }
}