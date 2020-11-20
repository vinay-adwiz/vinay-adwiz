<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Settings controller
 */
class Settings extends Admin_Controller
{
    protected $permissionCreate = 'Favorite_teachers.Settings.Create';
    protected $permissionDelete = 'Favorite_teachers.Settings.Delete';
    protected $permissionEdit   = 'Favorite_teachers.Settings.Edit';
    protected $permissionView   = 'Favorite_teachers.Settings.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('favorite_teachers/favorite_teachers_model');
        $this->lang->load('favorite_teachers');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'settings/_sub_nav');

        Assets::add_module_js('favorite_teachers', 'favorite_teachers.js');
    }

    /**
     * Display a list of Favorite Teachers data.
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
                    $deleted = $this->favorite_teachers_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('favorite_teachers_delete_success'), 'success');
                } else {
                    Template::set_message(lang('favorite_teachers_delete_failure') . $this->favorite_teachers_model->error, 'error');
                }
            }
        }
        
        
        
        $records = $this->favorite_teachers_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('favorite_teachers_manage'));

        Template::render();
    }
    
    /**
     * Create a Favorite Teachers object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_favorite_teachers()) {
                log_activity($this->auth->user_id(), lang('favorite_teachers_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'favorite_teachers');
                Template::set_message(lang('favorite_teachers_create_success'), 'success');

                redirect(SITE_AREA . '/settings/favorite_teachers');
            }

            // Not validation error
            if ( ! empty($this->favorite_teachers_model->error)) {
                Template::set_message(lang('favorite_teachers_create_failure') . $this->favorite_teachers_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('favorite_teachers_action_create'));

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
    private function save_favorite_teachers($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->favorite_teachers_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->favorite_teachers_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->favorite_teachers_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->favorite_teachers_model->update($id, $data);
        }

        return $return;
    }
}