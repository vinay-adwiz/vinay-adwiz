<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Reports controller
 */
class Reports extends Admin_Controller
{
    protected $permissionCreate = 'Referrals.Reports.Create';
    protected $permissionDelete = 'Referrals.Reports.Delete';
    protected $permissionEdit   = 'Referrals.Reports.Edit';
    protected $permissionView   = 'Referrals.Reports.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('referrals/referrals_model');
        $this->lang->load('referrals');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'reports/_sub_nav');

        Assets::add_module_js('referrals', 'referrals.js');
    }

    /**
     * Display a list of Referrals data.
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
                    $deleted = $this->referrals_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('referrals_delete_success'), 'success');
                } else {
                    Template::set_message(lang('referrals_delete_failure') . $this->referrals_model->error, 'error');
                }
            }
        }
        
        
        
        $records = $this->referrals_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('referrals_manage'));

        Template::render();
    }
    
    /**
     * Create a Referrals object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_referrals()) {
                log_activity($this->auth->user_id(), lang('referrals_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'referrals');
                Template::set_message(lang('referrals_create_success'), 'success');

                redirect(SITE_AREA . '/reports/referrals');
            }

            // Not validation error
            if ( ! empty($this->referrals_model->error)) {
                Template::set_message(lang('referrals_create_failure') . $this->referrals_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('referrals_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Referrals data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('referrals_invalid_id'), 'error');

            redirect(SITE_AREA . '/reports/referrals');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_referrals('update', $id)) {
                log_activity($this->auth->user_id(), lang('referrals_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'referrals');
                Template::set_message(lang('referrals_edit_success'), 'success');
                redirect(SITE_AREA . '/reports/referrals');
            }

            // Not validation error
            if ( ! empty($this->referrals_model->error)) {
                Template::set_message(lang('referrals_edit_failure') . $this->referrals_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->referrals_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('referrals_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'referrals');
                Template::set_message(lang('referrals_delete_success'), 'success');

                redirect(SITE_AREA . '/reports/referrals');
            }

            Template::set_message(lang('referrals_delete_failure') . $this->referrals_model->error, 'error');
        }
        
        Template::set('referrals', $this->referrals_model->find($id));

        Template::set('toolbar_title', lang('referrals_edit_heading'));
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
    private function save_referrals($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->referrals_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->referrals_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->referrals_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->referrals_model->update($id, $data);
        }

        return $return;
    }
}