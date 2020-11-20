<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Class_schedules controller
 */
class Class_schedules extends Front_Controller
{
    protected $permissionCreate = 'Class_schedules.Class_schedules.Create';
    protected $permissionDelete = 'Class_schedules.Class_schedules.Delete';
    protected $permissionEdit   = 'Class_schedules.Class_schedules.Edit';
    protected $permissionView   = 'Class_schedules.Class_schedules.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('feedback/feedback_model');
        $this->load->model('curriculum/curriculum_model');
        $this->load->model('class_schedules/class_schedules_model');
        $this->lang->load('class_schedules');
        $this->load->library('users/auth');
        $this->load->library('form_validation');

        $this->load->helper('form');
        $this->load->helper('date');
        
        Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
        Assets::add_js('jquery-ui-1.8.13.min.js');
        

        Assets::add_module_js('class_schedules', 'class_schedules.js');
    }

    /**
     * Allow student to provide feedback for teachers
     *
     * @return void
     */
    public function feedback($class_id)
    {

        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        $user_id = $this->current_user->id;
     
        $class_details = $this->class_schedules_model->load_class_details($class_id);

        if (!$class_details) {
            Template::set_message( lang('invalid_class_id'), 'danger');
            Template::redirect(site_url("users/completed_classes/"));
        } else {

            if (intval($class_details['student_id']) !== $user_id) {

                Template::set_message( lang('feedback_error_not_allowed'), 'danger');
                Template::redirect(site_url("users/completed_classes/"));
            } else {

                if ($class_details['status'] !== CLASS_STATUS_COMPLETED) {

                    Template::set_message( lang('feedback_error_not_allowed'), 'danger');
                    Template::redirect(site_url("users/completed_classes/"));

                } else {

                    if ($this->feedback_model->has_feedback($class_details['id'], FEEDBACK_TYPE_TEACHER)) {
                        Template::set_message( lang('feedback_error_not_allowed') . " " . lang('feedback_error_already_provided'), 'danger');
                        Template::redirect(site_url("users/completed_classes/"));
                    }

                    $curriculum = $this->curriculum_model->load_curriculum_details($class_details['curriculum_id']);
                    Template::set('curriculum', $curriculum);
                    Template::set('class_details', $class_details);

                    if (isset($_POST['send_feedback'])) {

                        // Do validation
                        $this->form_validation->set_rules('feedback', lang('feedback'), 'required');

                        // Validation ok. lets insert
                        if ($this->form_validation->run() !== false) {
                            
                            $data = array();
                            $data['user_id'] = $class_details['teacher_id'];
                            $data['provided_by'] = $user_id;
                            $data['feedback_type'] = FEEDBACK_TYPE_TEACHER;
                            $data['class_id'] = $class_details['id'];
                            $data['rating'] = NULL;
                            $data['feedback'] = $this->input->post('feedback');
                            $data['created_on'] = date("Y-m-d H:i:s");

                            $insert = $this->db->insert('feedback',$data);
                            
                            Template::set_message( lang('feedback_thanks'), 'success');
                            Template::redirect(site_url("users/completed_classes/"));

                        } 
                    }
                }
            }
        }
        Template::set_view('feedback');
        Template::render();
    }   
}