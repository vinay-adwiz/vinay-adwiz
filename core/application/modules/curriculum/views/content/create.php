
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
                           foreach($levels as $level){ ?>
                              <option value="<?php echo $level->id; ?>" <?php echo ((isset($_POST['curriculum_level'])) ? ((trim($_POST['curriculum_level']) == $level->id) ? 'selected="selected"':''): ""); ?>><?= $level->level ?></option>
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
<?php       if (isset($_POST['curriculum_level'])) : 

                    $this->db->select('*');
                    $this->db->from('curriculum_units');
                    $this->db->where('level',$_POST['curriculum_level']);
                    $prevQuery = $this->db->get();
                    $result = $prevQuery->result();               
?>
                    <select class="form-control" name="curriculum_unit" id="curriculum_unit">
                      <option value=""></option>
<?php                      
                          if(is_array($result)) { 
                              foreach ($result as $res) {

                                $selected = (isset($_POST['curriculum_unit']) && $_POST['curriculum_unit'] == $res->id) ? 'selected="selected"' : '';
?>
                                <option value="<?= $res->id ?>" <?= $selected ?>><?= $res->unit ?></option> 
<?php                       }     
                          }
?>
                    </select>
<?php       else : ?>  
                     <select class="form-control" name="curriculum_unit" id="curriculum_unit" disabled="disabled">
                        <option value="">Please select curriculum level first</option>
                     </select>
<?php       endif; ?>    
                    <?php echo form_error('curriculum_unit', '<div class="alert alert-error">', '</div>'); ?>                 
                  </div>
               </div>

               <div class="form-group">
                  <label class="col-sm-3 control-label">Lesson Number : </label>
                  <div class="col-sm-6">
                     <select class="form-control" name="lesson_number" id="lesson_number">
                        <?php
                           $lesson_number = array("", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
                           foreach($lesson_number as $number){ ?>
                              <option value="<?= $number ?>" <?php echo ((isset($_POST['lesson_number'])) ? ((trim($_POST['lesson_number']) == $number) ? 'selected="selected"':''): ""); ?>><?= $number ?></option>
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
                  $topic = isset($_POST['topic']) ? $_POST['topic'] : '';
          ?>            
                      <input type="text" class="form-control" name="topic" id="topic" value="<?=$topic ?>">
                      <?php echo form_error('topic', '<div class="alert alert-error">', '</div>'); ?>
                  </div>
              </div>

                <div class="form-group <?php echo form_error('theme') ? 'has-error' : ''; ?>">
                  <label class="col-sm-3 control-label">Theme</label>
                  <div class="col-sm-6">
          <?php
                  $theme = isset($_POST['theme']) ? $_POST['theme'] : '';
          ?>            
                      <input type="text" class="form-control" name="theme" id="theme" value="<?=$theme ?>">
                      <?php echo form_error('theme', '<div class="alert alert-error">', '</div>'); ?>
                  </div>
              </div>

              <div class="form-group <?php echo form_error('phrases') ? 'has-error' : ''; ?>">
                <label class="col-sm-3 control-label">Phrases<br /><small>Separate each phrase using the | character</small></label>
                <div class="col-sm-6">
        <?php
                $phrases = isset($_POST['phrases']) ? $_POST['phrases'] : '';
        ?>            
                    <textarea name="phrases" rows="3" class="form-control textarea-counter"><?= $phrases ?></textarea>
                    <?php echo form_error('phrases', '<div class="alert alert-error">', '</div>'); ?>
                </div>
              </div>

              <div class="form-group <?php echo form_error('vocabulary') ? 'has-error' : ''; ?>">
                <label class="col-sm-3 control-label">Vocabulary<br /><small>Separate each term using the | character</small></label>
                <div class="col-sm-6">
        <?php
                $vocabulary = isset($_POST['vocabulary']) ? $_POST['vocabulary'] : '';
        ?>            
                    <textarea name="vocabulary" rows="3" class="form-control textarea-counter"><?= $vocabulary ?></textarea>
                    <?php echo form_error('vocabulary', '<div class="alert alert-error">', '</div>'); ?>
                </div>
              </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Previous Lesson : </label>
                  <div class="col-sm-6 previous_lesson_div">
                     


<?php       if (isset($_POST['curriculum_unit'])) : 

                    $this->db->select('*');
                    $this->db->from('curriculum');
                    $this->db->where('curriculum_unit',$_POST['curriculum_unit']);
                    $prevQuery = $this->db->get();
                    $result = $prevQuery->result();               
?>
                    <select class="form-control" name="previous_lesson" id="previous_lesson">
                      <option value="0"></option>
<?php                      
                          if(is_array($result)) { 
                              foreach ($result as $res) {

                                $selected = (isset($_POST['previous_lesson']) && $_POST['previous_lesson'] == $res->id) ? 'selected="selected"' : '';
?>
                                <option value="<?= $res->id ?>" <?= $selected ?>><?= $res->topic ?></option> 
<?php                       }     
                          }
?>
                    </select>
<?php       else : ?>  
                     <select class="form-control" name="previous_lesson" id="previous_lesson" disabled="disabled">
                        <option value="">Please select curriculum unit first</option>
                     </select>
<?php       endif; ?>    

                     <small>This is the last lesson a student must complete before beginning this one</small>
                  </div>
               </div>


               <div class="form-group">
                  <label class="col-sm-3 control-label">Is Active : </label>
                  <div class="col-sm-6">
                     <select class="form-control" name="active" id="active">
                        <option value="0" <?php echo ((isset($_POST['active'])) ? ((trim($_POST['active']) == '0') ? 'selected="selected"':''): ""); ?>>No</option>
                        <option value="1" <?php echo ((isset($_POST['active'])) ? ((trim($_POST['active']) == '1') ? 'selected="selected"':''): ""); ?>>Yes</option>
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
                  
                      $("#curriculum_unit").on('change',function(){
                        var selectedUnit = $("#curriculum_unit option:selected").val();
                        var selectedLevel = $("#curriculum_level option:selected").val();
                        
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url(SITE_AREA . '/content/curriculum/get_lessons_for_unit'); ?>",
                            data: {curriculum_unit:selectedUnit,curriculum_level:selectedLevel },
                            success: function(data) {
                               if(data.length != ''){
                                  $(".previous_lesson_div").html(data);    
                              }else{
                                  $('.previous_lesson_div').html('<select class="form-control" name="previous_lesson" id="previous_lesson" disabled="disabled"><option value="">Please select curriculum unit first</option></select><small>This is the last lesson a student must complete before beginning this one</small>');  
                              } 
                            } 
                        });
                    });    
              }else{
                    $('.curriculum_unit_div').html('<select class="form-control" name="curriculum_unit" id="curriculum_unit" disabled="disabled"><option value="">Please select curriculum level first</option></select>');
                    $('.previous_lesson_div').html('<select class="form-control" name="previous_lesson" id="previous_lesson" disabled="disabled"><option value="">Please select curriculum unit first</option></select><small>This is the last lesson a student must complete before beginning this one</small>');  
              } 
            } 
        });
    });

    $("#curriculum_unit").on('change',function(){

        var selectedLevel = $("#curriculum_level option:selected").val();
        var selectedUnit = $("#curriculum_unit option:selected").val();
        
        $.ajax({
            type: "POST",
            url: "<?php echo site_url(SITE_AREA . '/content/curriculum/get_lessons_for_unit'); ?>",
            data: { curriculum_unit:selectedUnit,curriculum_level:selectedLevel},
            success: function(data) {
               if(data.length != ''){
                  $(".previous_lesson_div").html(data);    
              }else{
                  $('.previous_lesson_div').html('<select class="form-control" name="previous_lesson" id="previous_lesson" disabled="disabled"><option value="">Please select curriculum unit first</option></select><small>This is the last lesson a student must complete before beginning this one</small>');  
              } 
            } 
        });
    });
});
</script>
