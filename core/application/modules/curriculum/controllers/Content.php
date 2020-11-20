<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Curriculum.Content.Create';
    protected $permissionDelete = 'Curriculum.Content.Delete';
    protected $permissionEdit   = 'Curriculum.Content.Edit';
    protected $permissionView   = 'Curriculum.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('curriculum/curriculum_model');
        $this->load->model('curriculum_units/curriculum_units_model');
        $this->load->model('curriculum_levels/curriculum_levels_model');
        $this->lang->load('curriculum');
        
        $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('curriculum', 'curriculum.js');
    }

    /**
     * Display a list of Curriculum data.
     *
     * @return void
     */
    public function index()
    {
        // Deleting anything?
        
        $levels = $this->curriculum_levels_model->find_all();
        Template::set('levels', $levels);

        
        
        $records = $this->curriculum_model->find_all();

        Template::set('records', $records);
        
        Template::set('toolbar_title', lang('curriculum_manage'));

        Template::render();
    }
    
    /**
     * Create a Curriculum object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);

        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_curriculum()) {
                log_activity($this->auth->user_id(), lang('curriculum_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'curriculum');
                Template::set_message(lang('curriculum_create_success'), 'success');

                redirect(SITE_AREA . '/content/curriculum/create');
            }

            // Not validation error
            if ( ! empty($this->curriculum_model->error)) {
                Template::set_message(lang('curriculum_create_failure') . $this->curriculum_model->error, 'error');
            }
        }

        $levels = $this->curriculum_levels_model->find_all();
        Template::set('levels', $levels);

        Template::set('toolbar_title', lang('curriculum_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Curriculum data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('curriculum_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/curriculum');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_curriculum('update', $id)) {
                log_activity($this->auth->user_id(), lang('curriculum_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'curriculum');
                Template::set_message(lang('curriculum_edit_success'), 'success');
                redirect(SITE_AREA . '/content/curriculum');
            }

            // Not validation error
            if ( ! empty($this->curriculum_model->error)) {
                Template::set_message(lang('curriculum_edit_failure') . $this->curriculum_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->curriculum_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('curriculum_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'curriculum');
                Template::set_message(lang('curriculum_delete_success'), 'success');

                redirect(SITE_AREA . '/content/curriculum');
            }

            Template::set_message(lang('curriculum_delete_failure') . $this->curriculum_model->error, 'error');
        }
        
        $curriculum = $this->curriculum_model->find($id);
        Template::set('curriculum', $curriculum);

        $levels = $this->curriculum_levels_model->find_all();
        Template::set('levels', $levels);

        $previous_lessons = $this->curriculum_model->get_all_curriculum_units($curriculum->curriculum_level, NULL);
        
        Template::set('previous_lessons', $previous_lessons);

        Template::set('toolbar_title', lang('curriculum_edit_heading'));
        Template::render();
    }


    /**
     * Get all curriculum units for a given curriculum level
     * 
     */     
    public function select_curriculum_unit(){
        
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();
        
        if(!empty($_POST["curriculum_level"])){

            $curriculum_level = $_POST["curriculum_level"];
            $linked_units = $this->curriculum_units_model->where('level',$curriculum_level )->order_by('id', 'ASC')->find_all();
?>
            <select class="form-control" name="curriculum_unit" id="curriculum_unit">
                <option value=""></option>
<?php                 
                foreach($linked_units as $unit){
                    echo '<option value="'.$unit->id.'">'.$unit->unit.'</option>';                        
                }
?>
            </select>
            <?php echo form_error('curriculum_unit', '<div class="alert alert-error">', '</div>'); 
        }
         
    }

    /**
     * Get all lessons for a given curriculum unit
     * 
     */     
    public function get_lessons_for_unit(){
        
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $curriculum_unit = $_POST["curriculum_unit"];
        $lessons = $this->curriculum_model->get_all_curriculum_units($_POST["curriculum_level"], NULL);
?>
        <select class="form-control" name="previous_lesson" id="previous_lesson">

<?php           
        if (empty($lessons) === false) { ?>
            <option value="0"></option>
<?php        
            foreach($lessons as $lesson){

                echo '<option value="'.$lesson['id'] .'">'.$lesson['topic'].'</option>';                        
            }
        } else {
?>
            <option value="0">None available</option>
<?php            
        }
?>              
        </select>
        <small>This is the last lesson a student must complete before beginning this one</small>
        <?php echo form_error('previous_lesson', '<div class="alert alert-error">', '</div>'); 
    }

    /**
     * Get all lessons for a given curriculum unit
     * 
     */     
    public function display_lessons_for_unit(){
        
        // Make sure the user is logged in.
        $this->auth->restrict();
        $this->set_current_user();

        $curriculum_unit = $_POST["curriculum_unit"];
        $lessons = $this->curriculum_model->where('curriculum_unit', $curriculum_unit)->find_all();

        foreach ($lessons as $lesson) :
?>

        <div class="content-box">
            <h3 class="content-box-header bg-primary">
                <i class="glyph-icon icon-clipboard"></i>
                <?= $lesson->topic ?>
                <div class="header-buttons">
                    <a href="<?php echo site_url(SITE_AREA . "/content/curriculum/edit/" . $lesson->id); ?>" class="btn btn-sm btn-link font-white" title="">Edit</a>
                </div>
            </h3>
            <div class="content-box-wrapper">
                <div class="lesson-theme" style="padding-bottom: 13px;">
                    <p>Theme: <?= $lesson->theme ?></p>
                    <p>Lesson Number: <?= $lesson->lesson_number ?></p>
<?php               if (empty($lesson->previous_lesson) === false) : 
                        $prev_lesson = $this->curriculum_model->where('id', $lesson->previous_lesson)->find_all();
                        if (empty($prev_lesson) === false) { 
?>
                            <p>Previous Lesson: <a href="<?php echo site_url(SITE_AREA . "/content/curriculum/edit/" . $prev_lesson[0]->id); ?>" ><?= $prev_lesson[0]->topic ?></a></p>
<?php                            
                        }
                    endif;    
?>


                </div>    
                <div class="alert alert-info">

                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="alert-title">Phrases</h4>
<?php               if (empty($lesson->phrases) === false) : ?>                            
                            <code>
                <?php   $phrases = explode("|", $lesson->phrases); 
                        foreach ($phrases as $phrase) {
                            if ($phrase == '-') {
                                echo "<p>&nbsp;</p>";
                            } else {
                                echo $phrase . "<br>";
                            }
                        }
                ?>      </code>   
<?php                   endif; // end empty check ?>    
                        </div>    
                        <div class="col-sm-6">
                            <h3 class="alert-title">Vocabulary</h3>
<?php               if (empty($lesson->vocabulary) === false) : ?>                              
                            <code>
<?php                   $vocabulary = explode("|", $lesson->vocabulary); 
                        foreach ($vocabulary as $vocab) {
                            if ($vocab == '-') {
                                echo "<p>&nbsp;</p>";
                            } else {
                                echo $vocab . "<br>";
                            }
                        }
                ?>  
                            </code>
<?php                   endif; // end empty check ?>                            
                        </div>
                    </div>        
                </div>
            </div>
        </div>
<?php 
        endforeach;
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
    private function save_curriculum($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->curriculum_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->curriculum_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->curriculum_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->curriculum_model->update($id, $data);
        }

        return $return;
    }
}