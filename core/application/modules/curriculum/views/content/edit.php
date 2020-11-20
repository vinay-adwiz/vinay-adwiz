
<div class="row">
   <div class="col-md-12">
      <div class="panel">
         <div class="panel-body">
            <h3 class="title-hero">
            Add New Lesson
            </h3>
            <p class="message"> <?php echo Template::message(); ?></p>
            <div class="example-box-wrapper">
               <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off', 'id'=>'application_info')); ?>
               <div class="form-group">
                  <label class="col-sm-3 control-label">Curriculum Level : </label>
                  <div class="col-sm-6">
                     <select class="form-control" name="curriculum_level" id="curriculum_level" required="required">
                        <option value="">Please select</option>
                        <?php
                           foreach($levels as $level){ 
                                $level_selected = ($curriculum->curriculum_level) == $level->id ? 'selected="selected"' : ''; 
                                $level_selected = (isset($_POST['curriculum_level']) && $_POST['curriculum_level'] == $level->id) ? 'selected="selected"' : $level_selected; 
?>
                              <option value="<?php echo $level->id; ?>" <?= $level_selected  ?>><?= $level->level ?></option>
<?php      
                             }
                        ?>
                     </select>
                    <?php echo form_error('curriculum_level', '<div class="alert alert-error">', '</div>'); ?>
                  </div>
               </div>

               <div class="form-group <?php echo form_error('curriculum_unit') ? 'has-error' : ''; ?>">
                  <label class="col-sm-3 control-label">Curriculum Unit : </label>
                  <div class="col-sm-6 curriculum_unit_div">
<?php
                    $this->db->select('*');
                    $this->db->from('curriculum_units');
                    $this->db->where('level', $curriculum->curriculum_level);
                    $prevQuery = $this->db->get();
                    $result = $prevQuery->result();               
?>
                    <select class="form-control" name="curriculum_unit" id="curriculum_unit">
                      <option value=""></option>
<?php                      
                          foreach ($result as $res) {

                            $unit_selected = ($curriculum->curriculum_unit) == $res->id ? 'selected="selected"' : ''; 
                            $unit_selected = (isset($_POST['curriculum_unit']) && $_POST['curriculum_unit'] == $res->id) ? 'selected="selected"' : $unit_selected; 
?>
                            <option value="<?= $res->id ?>" <?= $unit_selected ?>><?= $res->unit ?></option> 
<?php                   }     
?>
                    </select>

                    <?php echo form_error('curriculum_unit', '<div class="alert alert-error">', '</div>'); ?>                 
                  </div>
               </div>

               <div class="form-group">
                  <label class="col-sm-3 control-label">Lesson Number : </label>
                  <div class="col-sm-6">
                     <select class="form-control" name="lesson_number" id="lesson_number">
                        <?php
                           $lesson_number = array("", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
                           foreach($lesson_number as $number){ 
                                
                                $number_selected = ($curriculum->lesson_number) == $number ? 'selected="selected"' : ''; 
                                $number_selected = (isset($_POST['lesson_number']) && $_POST['lesson_number'] == $number) ? 'selected="selected"' : $number_selected; 

?>
                              <option value="<?= $number ?>" <?= $number_selected ?>><?= $number ?></option>
<?php      
                             }
                        ?>
                     </select>
                     <?php echo form_error('lesson_number', '<div class="alert alert-error">', '</div>'); ?>
                  </div>
               </div>

               <div class="form-group <?php echo form_error('topic') ? 'has-error' : ''; ?>">
                  <label class="col-sm-3 control-label">Topic</label>
                  <div class="col-sm-6">
          <?php
                  $topic = isset($_POST['topic']) ? $_POST['topic'] : $curriculum->topic;
          ?>            
                      <input type="text" class="form-control" name="topic" id="topic" value="<?=$topic ?>">
                      <?php echo form_error('topic', '<div class="alert alert-error">', '</div>'); ?>
                  </div>
              </div>

                <div class="form-group <?php echo form_error('theme') ? 'has-error' : ''; ?>">
                  <label class="col-sm-3 control-label">Theme</label>
                  <div class="col-sm-6">
          <?php
                  $theme = isset($_POST['theme']) ? $_POST['theme'] : $curriculum->theme;
          ?>            
                      <input type="text" class="form-control" name="theme" id="theme" value="<?=$theme ?>">
                      <?php echo form_error('theme', '<div class="alert alert-error">', '</div>'); ?>
                  </div>
              </div>

              <div class="form-group <?php echo form_error('phrases') ? 'has-error' : ''; ?>">
                <label class="col-sm-3 control-label">Phrases<br /><small>Separate each phrase using the | character</small></label>
                <div class="col-sm-6">
        <?php
                $phrases = isset($_POST['phrases']) ? $_POST['phrases'] : $curriculum->phrases;
        ?>            
                    <textarea name="phrases" rows="3" class="form-control textarea-counter"><?= $phrases ?></textarea>
                    <?php echo form_error('phrases', '<div class="alert alert-error">', '</div>'); ?>
                </div>
              </div>

              <div class="form-group <?php echo form_error('vocabulary') ? 'has-error' : ''; ?>">
                <label class="col-sm-3 control-label">Vocabulary<br /><small>Separate each term using the | character</small></label>
                <div class="col-sm-6">
        <?php
                $vocabulary = isset($_POST['vocabulary']) ? $_POST['vocabulary'] : $curriculum->vocabulary;
        ?>            
                    <textarea name="vocabulary" rows="3" class="form-control textarea-counter"><?= $vocabulary ?></textarea>
                    <?php echo form_error('vocabulary', '<div class="alert alert-error">', '</div>'); ?>
                </div>
              </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Previous Lesson : </label>
                  <div class="col-sm-6 previous_lesson_div">
                     
                     <select class="form-control" name="previous_lesson" id="previous_lesson">
<?php                 if (empty($previous_lessons)) {
?>
                        <option value="0">None available</option>
<?php
                      } else {
?>
                        <option value="0"></option>
<?php                        
                        foreach($previous_lessons as $lesson){

                          $saved_previous_lesson = ($curriculum->previous_lesson) == $lesson['id'] ? 'selected="selected"' : ''; 
                          $saved_previous_lesson = (isset($_POST['previous_lesson']) && $_POST['previous_lesson'] == $lesson['id']) ? 'selected="selected"' : $saved_previous_lesson; 
?>
                          <option value="<?= $lesson['id'] ?>" <?= $saved_previous_lesson ?>><?= $lesson['topic'] ?></option>
<?php                          
                        }
                      }
?>
                     </select>
                     <small>This is the last lesson a student must complete before beginning this one</small>
                  </div>
               </div>


               <div class="form-group">
                  <label class="col-sm-3 control-label">Is Active : </label>
                  <div class="col-sm-6">
                     <select class="form-control" name="active" id="active">
                        <option value="0" <?php echo ($curriculum->active == '0') ? 'selected="selected"' : ''; ?>>No</option>
                        <option value="1" <?php echo ($curriculum->active == '1') ? 'selected="selected"' : ''; ?>>Yes</option>
                     </select>
                     <?php echo form_error('active', '<div class="alert alert-error">', '</div>'); ?>
                  </div>
               </div>


               <div class="form-group">
                 <div class="col-sm-12 control-label"><input class="btn btn-primary"  name="save" type="submit" value="Submit"> <?php echo anchor(SITE_AREA . '/content/curriculum', 'Cancel', 'class="btn btn-danger"'); ?></div>
              </div>
<?php          echo form_close(); ?>
            </div>
         </div>      
      </div>
   </div>
</div>


<script type="text/javascript">

$(document).ready(function(){

    $("#curriculum_level").on('change',function(){

        var selectedLevel = $("#curriculum_level option:selected").val();
        $.ajax({
            cache: false,
            type: "POST",
            url: "<?php echo site_url(SITE_AREA . '/content/curriculum/select_curriculum_unit'); ?>",
            data: { curriculum_level : selectedLevel },
            success: function(data) {
               if(data.length != ''){
                  $(".curriculum_unit_div").html(data);    
              } 
            } 
        });
    });

    $("#curriculum_unit").on('change',function(){
        var selectedUnit = $("#curriculum_unit option:selected").val();
        var selectedLevel = $("#curriculum_level option:selected").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(SITE_AREA . '/content/curriculum/get_lessons_for_unit'); ?>",
            data: {curriculum_unit:selectedUnit,curriculum_level:selectedLevel},
            success: function(data) {
               if(data.length != ''){
                  $(".previous_lesson_div").html(data);    
              } 
            } 
        });
    });
});
</script>
