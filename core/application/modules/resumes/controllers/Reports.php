<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Reports controller
 */
class Reports extends Admin_Controller
{
    protected $permissionCreate = 'Resumes.Reports.Create';
    protected $permissionDelete = 'Resumes.Reports.Delete';
    protected $permissionEdit   = 'Resumes.Reports.Edit';
    protected $permissionView   = 'Resumes.Reports.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('resumes/resumes_model');
        $this->lang->load('resumes');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'reports/_sub_nav');

        Assets::add_module_js('resumes', 'resumes.js');
    }

    /**
     * Display a list of resumes data.
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
                    $deleted = $this->resumes_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('resumes_delete_success'), 'success');
                } else {
                    Template::set_message(lang('resumes_delete_failure') . $this->resumes_model->error, 'error');
                }
            }
        }
        
        
        
        $records = $this->resumes_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('resumes_manage'));

        Template::render();
    }
    
    /**
     * Create a resumes object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_resumes()) {
                log_activity($this->auth->user_id(), lang('resumes_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'resumes');
                Template::set_message(lang('resumes_create_success'), 'success');

                redirect(SITE_AREA . '/reports/resumes');
            }

            // Not validation error
            if ( ! empty($this->resumes_model->error)) {
                Template::set_message(lang('resumes_create_failure') . $this->resumes_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('resumes_action_create'));

        Template::render();
    }
    /**
     * Allows editing of resumes data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('resumes_invalid_id'), 'error');

            redirect(SITE_AREA . '/reports/resumes');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_resumes('update', $id)) {
                log_activity($this->auth->user_id(), lang('resumes_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'resumes');
                Template::set_message(lang('resumes_edit_success'), 'success');
                redirect(SITE_AREA . '/reports/resumes');
            }

            // Not validation error
            if ( ! empty($this->resumes_model->error)) {
                Template::set_message(lang('resumes_edit_failure') . $this->resumes_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->resumes_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('resumes_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'resumes');
                Template::set_message(lang('resumes_delete_success'), 'success');

                redirect(SITE_AREA . '/reports/resumes');
            }

            Template::set_message(lang('resumes_delete_failure') . $this->resumes_model->error, 'error');
        }
        
        Template::set('resumes', $this->resumes_model->find($id));

        Template::set('toolbar_title', lang('resumes_edit_heading'));
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
    private function save_resumes($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->resumes_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->resumes_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->resumes_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->resumes_model->update($id, $data);
        }

        return $return;
    }
}