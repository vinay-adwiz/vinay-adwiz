
<div class="row">
   <div class="col-md-12">
      <div class="panel">
         <div class="panel-body">
            <h3 class="title-hero">
            View Curriculum
            </h3>
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
                  </div>
               </div>

               <div class="form-group">
                  <label class="col-sm-3 control-label">Curriculum Unit : </label>
                  <div class="col-sm-6 curriculum_unit_div">
                     <select class="form-control" name="curriculum_unit" id="curriculum_unit" disabled="disabled">
                        <option value="">Please select curriculum level first</option>
                     </select>   
                  </div>
               </div>

<?php          echo form_close(); ?>
            </div>
         </div>      
      </div>
   </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                <h3 class="title-hero">
                    Lessons
                </h3>
                <div class="curriculum_div">
                	Please select a curriculum level and unit first.
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
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url(SITE_AREA . '/content/curriculum/display_lessons_for_unit'); ?>",
                            data: { curriculum_unit : selectedUnit },
                            success: function(data) {
                               if(data.length != ''){
                                  $(".curriculum_div").html(data);    
                              }else{
                                  $('.curriculum_div').html('Error loading lesson information');  
                              } 
                            } 
                        });
                    });    
                } else {
                    $('.curriculum_unit_div').html('<select class="form-control" name="curriculum_unit" id="curriculum_unit" disabled="disabled"><option value="">Please select curriculum level first</option></select>');
                    $('.curriculum_div').html('Please select a curriculum level and unit first.');  
              	} 
            } 
        });
    });

    
});
</script>
