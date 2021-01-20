<!-- Modal -->
<div class="modal fadeInDown" id="loadingModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <img src="<?php echo base_url('/assets/images/spinner/loader.gif') ?>"/>
        </div>
      </div>
    </div>
</div>


<div class="hero-box hero-box-smaller full-bg-13 font-inverse" data-top-bottom="background-position: 50% 0px;" data-bottom-top="background-position: 50% -600px;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s"><?php e(lang('bf_teacher_profile')); ?></h1>
    </div>
    <div class="hero-overlay bg-black"></div>
</div>

<div id="page-content" class="col-md-8 center-margin frontend-components mrg25T">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            <?php echo theme_view('sidemenu'); ?>
        </div>
        <div class="col-md-9 col-lg-10">
            <div id="page-title">
                <h2>

            <?php   
            if ($is_favorite) { ?> <i class="glyph-icon icon-star gold"></i><?php } ?>
                    <?= @$teacher_profile['meta']->first_name ?> <?= @$teacher_profile['meta']->last_name ?>
                </h2>
                <p>&nbsp;</p>
                <?php   echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off', 'id' => 'favorite_form')); ?>
                <input type="hidden" name="teacher_id" value="<?= $teacher_profile['meta']->id ?>" />
<?php           if ($is_favorite) {
?>
                    <input type="hidden" name="remove_favorite" value="1" />
                    <button class="btn btn-info" type="submit"><i class="glyph-icon icon-star"></i> <?php e(lang('remove_favorite')); ?></button>
<?php
                } else { ?>                
                    <input type="hidden" name="make_favorite" value="1" />
                    <button class="btn btn-info" type="submit"><i class="glyph-icon icon-star"></i> <?php e(lang('make_favorite')); ?></button>
<?php           } ?>                
                <?php echo form_close(); ?> 
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">
                            <div class="example-box-wrapper">
                                <div class="row mailbox-wrapper">
                                    <div class="col-md-7">
                                        <h3 class="title-hero">
                                            <?php e(lang('bf_profile')); ?>
                                        </h3>
                                        <br />
                                       <ul class="feature-list">
                                        <li>
                                            <i class="glyph-icon font-primary icon-bolt"></i>
                                            <span>
                                                <b>Profile Highlight</b>
                                                <p><?= @$teacher_profile['public_profile']->highlight ?></p>
                                            </span>
                                        </li>
                                        <li>
                                            <i class="glyph-icon font-primary icon-globe"></i>
                                            <span>
                                                <b>Location</b>
                                                <p><?= @$teacher_profile['meta']->country ?></p>
                                            </span>
                                        </li>
<?php
                                        if (empty($teacher_profile['public_profile']->youtube) === false) {
?>                                        
                                        <li>
                                            <i class="glyph-icon font-primary icon-youtube"></i>
                                            <span>
                                                <b>YouTube</b>
                                                <?php $youtube_url = $teacher_profile['public_profile']->youtube;
                                                if (strpos($youtube_url, 'youtu.be') !== false) {
                                                    $y_url = str_replace("youtu.be","youtube.com/embed/",$youtube_url);;
                                                }
                                                else{
                                                    $y_url = str_replace("watch?v=","embed/",$youtube_url);
                                                }
                                                //$y_url = str_replace("watch?v=","embed/",$youtube_url);
                                                ?>
                                                <p><a data-toggle="modal" data-target="#myModal" class="youtube_url" href="<?php echo $y_url; ?>"><?= $teacher_profile['public_profile']->youtube ?></a></p>
                                            </span>
                                            <!-- Modal -->
                                            <div id="myModal" class="modal fade" role="dialog">
                                              <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-body">
                                                    <button type="button" class="btn btn-default close_video" data-dismiss="modal">&times;</button>
                                                    <div class="youtube_video"></div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                        </li>
<?php                                   } ?>                                        
                                        <li>
                                            <i class="glyph-icon font-primary icon-user"></i>
                                            <span>
                                                <b>About Me</b>
                                                <p><?= @$teacher_profile['public_profile']->profile ?></p>
                                            </span>
                                        </li>
<?php                               if (isset($teacher_profile['meta']->profile_views) && $teacher_profile['meta']->profile_views > 250) : ?>                                        
                                        <li>
                                            <i class="glyph-icon font-primary icon-eye"></i>
                                            <span>
                                                <b>Number of Profile Views</b>
                                                <p><?= @$teacher_profile['meta']->profile_views ?></p>
                                            </span>
                                        </li>
<?php                               endif; ?>                                        
                                    </ul>
                                    </div>
                                    <div class="col-md-5">
<?php
                                        if (empty($teacher_profile['avatar'])) {
    ?>
                                            <img style="max-width: 100%;" src="<?= base_url(); ?>assets/images/default-avatar.jpg" alt="<?= @$teacher_profile['meta']->first_name ?> <?= @$teacher_profile['meta']->last_name ?>">
    <?php                            
                                        }   else {

    ?>                    
                                            <img style="max-width: 100%;" src="<?= TEACHER_PORTAL_URL ?><?= @$teacher_profile['avatar'] ?>" alt="<?= @$teacher_profile['meta']->first_name ?> <?= @$teacher_profile['meta']->last_name ?>">
    <?php                              } ?>       

                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/interactions-ui/resizable.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/interactions-ui/draggable.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/interactions-ui/sortable.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/interactions-ui/selectable.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/daterangepicker/moment.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/calendar/calendar.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/calendar/calendar-demo.js"></script>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="title-hero">
                                <?php e(lang('bf_book_lesson')); ?>
                            </h3>
                            <div class="example-box-wrapper">
                                <div class="row mailbox-wrapper">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-body">
                            <?php           if (isset($student_remaining) === FALSE || $student_remaining < 1) : ?>         
                                                    <p><?php e(sprintf(lang('no_more_credit'), '/users/packages/')); ?></p>
                                                    <br /><p><a href="<?php echo site_url("users/packages/"); ?>" class="bs-label bg-green" title="book now" style="padding: 7px; font-size: 14px;"><?php e(lang('buy_more_credits')); ?></a></p>
                            <?php               else : ?>                                       
                                                <div class="example-box-wrapper row">
                                                    <div class="col-md-11 center-margin">
                                                        <br />
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="content-box" id="external-events"> 
                                                                    <h3 class="content-box-header bg-default" style="font-weight: 700;">
                                                                        <?php e(lang('booking_name_of_upcoming_class')); ?>
                                                                    </h3>
                                                                    <div class="content-box-wrapper">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                    <?php   foreach($next_class as $class) :  ?>
                                                                            
                                                                                <div class="display-block mrg5B">
                                                                                    <div class="button-content"><?= $class->topic ?></div>
                                                                                </div>

                                                                    <?php   endforeach; ?>
                        
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="content-box" id="external-events"> 
                                                                    <h3 class="content-box-header bg-default" style="font-weight: 700;">
                                                                        <?php e(lang('booking_definition_color_bars')); ?>
                                                                    </h3>
                                                                    <div class="content-box-wrapper">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="btn display-block mrg5B btn-blue-alt">
                                                                                    <div class="button-content"><?php e(lang('booking_blue_bar_course')); ?> </div>
                                                                                </div>
                                                                                <div class="btn display-block mrg5B btn-primary">
                                                                                    <div class="button-content"><?php e(lang('booking_class_already_booked')); ?> </div>
                                                                                </div>
                                                                                <!-- <div class="btn display-block mrg5B btn-yellow">
                                                                                    <div class="button-content"><?php e(lang('peak_hour_slot')); ?></div>
                                                                                </div> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p style="padding-bottom: 7px;"><?php e(lang('booking_timezones')); ?> To check your time vs. Bangkok time, please <a href="https://www.timeanddate.com/worldclock/converter.html?iso=20180217T140000&p1=28" target="_blank">click here</a>.</p>
                                                                <p style="padding-bottom: 13px;"><?php echo sprintf(lang('num_remaining_classes'), $student_remaining); ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <?php if(!empty($interviews)){
                                                                    
                                                                            foreach ($interviews as $interview){
                                                                                
                                                                                $event_details[]=array( 'available_start_date'=>$interview['available_start_date'], 'available_start_time'=>$interview['available_start_time'], 'available_end_date'=>$interview['available_end_date'], 'available_end_time'=>$interview['available_end_time'],'available_slot'=>$interview['available_slot']);
                                                                                
                                                                            }
                                                                            
                                                                        } ?>                 
                                                                    <div class="message">
                                                                        <?php
                                                                        if($this->input->post('tmsg') == 'success'){ 
                                                                            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>'.lang('booking_successful').'</div></div>'; ?>
                                                                            <script>
                                                                                $(".message").addClass('done');
                                                                            </script>
                                                                          <?php  
                                                                            }
                                                                        ?>
                                                                    </div>                
                                                                <div id="myScheduler"></div>
                                                            </div>
                                                        </div>    
                                                    </div>
                                                </div>
                                        <?php   endif;  ?>       
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

var ttdda = new Date();
<?php if(!empty($interviews)){
    
    $dddate = null;
    foreach($interviews as $si_interview){
        $tdd = strtotime($si_interview['available_start_date'].' '.$si_interview['available_start_time']);
        if($dddate == null){
            $dddate = $tdd;
        }else if($dddate > $tdd)
        {
            $dddate = $tdd;
        }
    }
    
    $final_date = strtotime(date('Y-m-d H:i:s'));
    if(($dddate != null) && (strlen(trim($dddate)) > 0)){
        $final_date = trim($dddate);
    }
    
    echo 'ttdda = new Date(\''.date('F d, Y H:i:s',trim($final_date)).'\');';
} ?>
$("a.youtube_url").on("click",function(e){
    e.preventDefault();
  var wrapper = $("#myModal .modal-body .youtube_video");
  var href= $(this).attr("href"); 
  var  customFrame =  '<iframe src='+href+'?autoplay=1 class="iframe_video" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>';
  $(wrapper).html(customFrame).show(); 
  $("#myModal").addClass('in');
});

$('#myModal .modal-body .btn.btn-default.close_video').on('click',function(){
    var modal_wrapper = $("#myModal .modal-body .youtube_video");
    $(modal_wrapper).html('').hide();
});

</script>

<?php           
if (isset($student_remaining) && $student_remaining > 0) : 
?> 

<script>
$(document).ready(function() {
    YUI().use(
      'aui-scheduler',
      function(Y) {
        
        var events = [
        
                <?php
                if(!empty($booked_slots)){
                    foreach($booked_slots as $booked_slot){
                        
                        //$end_date = strtotime($booked_slot['available_end_date']);
                        //$available_end_date = date("Y-m-d", strtotime("-1 month", $end_date));
                        
                        //$explode_end_date = explode('-',$booked_slot['available_end_date']);
                        $explode_end_date = explode('-',$booked_slot['class_end_date']);
                        $event_end_month = $explode_end_date[1]-1;
                        $event_end_date = $explode_end_date[0].','.$event_end_month.','.$explode_end_date[2];
                        
                        $available_end_n_date = $event_end_date;
                        
                        //$available_end_n_date = str_replace('-',',',$available_end_date);
                        //$available_end_time = str_replace(':',',',$booked_slot['available_end_time']);
                        $available_end_time = str_replace(':',',',$booked_slot['class_end_time']);
                        
                        //$start_date = strtotime($booked_slot['available_start_date']);
                        //$available_start_date = date("Y-m-d", strtotime("-1 month", $start_date));
                        
                        //$explode_start_date = explode('-',$booked_slot['available_start_date']);
                        $explode_start_date = explode('-',$booked_slot['class_start_date']);
                        $event_start_month = $explode_start_date[1]-1;
                        $event_start_date = $explode_start_date[0].','.$event_start_month.','.$explode_start_date[2];
                        
                        $available_start_n_date = $event_start_date;
                        
                        //$available_start_n_date = str_replace('-',',',$available_start_date);
                        //$available_start_time = str_replace(':',',',$booked_slot['available_start_time']);
                        $available_start_time = str_replace(':',',',$booked_slot['class_start_time']);
                        
                        $title = lang('bf_lesson').' '.$booked_slot['lesson_number'].' [ '.$booked_slot['topic'].' ]';

                        if (intval($booked_slot['student_id']) === $student_id) {
                        ?>
                        {
                            endDate: new Date(<?php echo $available_end_n_date.','.$available_end_time ?>),
                            startDate: new Date(<?php echo $available_start_n_date.','.$available_start_time ?>),
                            content: '<?php echo $title; ?>',
                            meeting: true,
                            disabled:true,
                            color:'#00bca4',
                            allDay : false, // will make the time show
                            
                        },<?php

                        } 
                    }
                }//$booked_slots
                
                ?>
                <?php if(!empty($event_details)){
                    
                    for($i=0;$i<sizeof($event_details);$i++){
                        $j=$i+1;
                        
                        //$end_date = strtotime($event_details[$i]['available_end_date']);
                        //$available_end_date = date("Y-m-d", strtotime("-1 month", $end_date));
                        
                        $explode_end_date = explode('-',$event_details[$i]['available_end_date']);
                        $event_end_month = $explode_end_date[1]-1;
                        $event_end_date = $explode_end_date[0].','.$event_end_month.','.$explode_end_date[2];
                        
                        $available_end_n_date = $event_end_date;
                        
                        //$available_end_n_date = str_replace('-',',',$available_end_date);
                        $available_end_time = str_replace(':',',',$event_details[$i]['available_end_time']);
                        
                        //$start_date = strtotime($event_details[$i]['available_start_date']);
                        //$available_start_date = date("Y-m-d", strtotime("-1 month", $start_date));
                        
                        $explode_start_date = explode('-',$event_details[$i]['available_start_date']);
                        $event_start_month = $explode_start_date[1]-1;
                        $event_start_date = $explode_start_date[0].','.$event_start_month.','.$explode_start_date[2];
                        
                        $available_start_n_date = $event_start_date;
                        
                        //$available_start_n_date = str_replace('-',',',$available_start_date);
                        $available_start_time = str_replace(':',',',$event_details[$i]['available_start_time']);
                        
                        $available_slot = $event_details[$i]['available_slot'];

                        #if($available_slot == '1'){
                            $title = 'Available';
                            
                            //$current_week_day = date("l", strtotime("+1 month", $start_date));
                            $current_week_day = date("l", strtotime($event_start_date));    
                        
                            $weekday_start_peakhour = date("H:i", strtotime(WEEKDAY_START_PEAKHOUR));
                            $weekday_end_peakhour = date("H:i", strtotime(WEEKDAY_END_PEAKHOUR));
                            $weekend_start_peakhour = date("H:i", strtotime(WEEKEND_START_PEAKHOUR));
                            $weekend_end_peakhour = date("H:i", strtotime(WEEKEND_END_PEAKHOUR));
                            
                            $selected_start_date = date("H:i", strtotime($event_details[$i]['available_start_time']));
                            $selected_end_date = date("H:i", strtotime($event_details[$i]['available_end_time']));
                            
                            $is_peak_period = 0;
                            if($current_week_day == 'Saturday' || $current_week_day == 'Sunday'){
                                if($selected_start_date >= $weekend_start_peakhour && $selected_end_date <= $weekend_end_peakhour){
                                    $is_peak_period = 1; 
                                }
                                else{
                                    $is_peak_period = 0; 
                                } 
                            }
                            else{
                                if($selected_start_date >= $weekday_start_peakhour && $selected_end_date <= $weekday_end_peakhour){
                                    $is_peak_period = 1; 
                                }
                                else{
                                    $is_peak_period = 0; 
                                }    
                            }    
                            
            ?>
                            {
                                endDate: new Date(<?php echo $available_end_n_date.','.$available_end_time ?>),
                                startDate: new Date(<?php echo $available_start_n_date.','.$available_start_time ?>),
                                content: '<?php echo $title; ?>',
                                meeting: true,
                                disabled:true,
                                <?php #if($is_peak_period == 1): ?>
                                //#color:'#eabe0c',
                                <?php #else: ?>
                                color:'rgb(45,131,242)',
                                <?php #endif; ?>    
                                allDay : false, // will make the time show
                                
                            }<?php if($j!=sizeof($event_details)){echo ",";}
                        
                        #}// $available_slot
                    }
                } ?>
            ];
        
        var agendaView = new Y.SchedulerAgendaView();
        var dayView = new Y.SchedulerDayView();
        var monthView = new Y.SchedulerMonthView();
        var weekView = new Y.SchedulerWeekView();
        var current_date = new Date();
        var curr_date = current_date.getDate();
        var curr_month = current_date.getMonth();
        var curr_year = current_date.getFullYear();
       
       
        var eventRecorder = new Y.SchedulerEventRecorder({
            strings: {
                    'description-hint': 'Time Slot Not Available',
                    'cancel':'Close',
                    'delete':'Cancel',
                },
            duration:30,
            on: {
                save: function(event) {
                    
                    event.preventDefault();
                        
                        toastr.error('User cannot save event');
                    
                },
                edit: function(event) {
                    
                    var data = this.serializeForm();
                    var event_start_date = new Date(data.startDate);
                    var event_end_date = new Date(data.endDate);
                    //var title = this.getContentNode().val();
                    var _key = "bf_schedule_new_lesson";
                    var lesson_details = $("#lesson_details").val();
                    var teacher_id = "<?= $teacher_profile['meta']->id ?>";
                    var double_class = data.double_class;
                    
                    var start_date_time =  event_start_date.getFullYear()+'-'+event_start_date.getMonth()+'-'+event_start_date.getDate()+' '+event_start_date.getHours()+':'+event_start_date.getMinutes()+':'+event_start_date.getSeconds();
                    
                    var end_date_time =  event_end_date.getFullYear()+'-'+event_end_date.getMonth()+'-'+event_end_date.getDate()+' '+event_end_date.getHours()+':'+event_end_date.getMinutes()+':'+event_end_date.getSeconds();
                    
                    var booking_progress = '<?php e(lang('booking_in_progress')) ?>';
                    var booking_successful = '<?php e(lang('booking_successful')) ?>';
                    
                    if(event_start_date > current_date){
                        $.ajax({
                            type: "POST",
                            url: "<?php echo site_url('users/schedule_new_lesson');?>",
                            data: {key:_key,start : start_date_time, end:end_date_time, teacher_id:teacher_id, lesson_details:lesson_details, double_class: double_class},
                            dataType: 'json',
                            beforeSend:function(){
                                    $('#loadingModal').modal('show');
                                    $('#loadingModal').addClass('in');
                                    $('.modal-backdrop').removeClass('show');
                                    $('.modal-backdrop').addClass('hide');
                                    $('.scheduler-event').css('cursor','not-allowed')
                                    toastr.info(booking_progress); 
                            },
                            success: function(response) {
                                   $('#loadingModal').modal('hide');
                                   $('#loadingModal').removeClass('in');
                                   toastr.clear()
                                   if(response.status=="slot_not_available"){
                                        $('.scheduler-event').css('cursor','default');
                                        //$('.message').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><div>ช่วงเวลาที่คุณเลือกถูกจองเรียบร้อยแล้ว</div></div>');
                                        toastr.error('<?php e(lang('booking_err_time_booked')); ?>');
                                   }
                                   else if(response.status=="no_lesson"){
                                        $('.scheduler-event').css('cursor','default');
                                        toastr.error('<?php e(lang('booking_err_select_lesson')); ?>');
                                   }
                                   else if(response.status=="error"){
                                        $('.scheduler-event').css('cursor','default');
                                        toastr.error('<?php e(lang('booking_err_class_cant_be_booked')); ?>');
                                   }
                                   else if(response.status=="not_active"){
                                        $('.scheduler-event').css('cursor','default');
                                        toastr.error('<?php e(lang('booking_err_class_not_avail')); ?>');
                                   }
                                   else if(response.status=="inserted"){
                                        //setTimeout(location.reload.bind(location), 2000);
                                        //toastr.success(booking_successful);
                                       setTimeout(function(){ var ccurl = '<?php echo current_url(); ?>'; var rrform = $('<form id="smsg" action="' + ccurl + '" method="post">' +'<input type="hidden" name="tmsg" value="success" />' +'</form>'); $('body').append(rrform); rrform.submit(); $("#smsg").trigger('reset'); /*$(rrform)[0].reset();*/ }, 1000);
                                   }
                                   else if(response.status == "not_inserted"){
                                        $('.scheduler-event').css('cursor','default');
                                        toastr.error('<?php e(lang('booking_err_class_not_booked')); ?> ');
                                   }
                                   else if(response.status == "no_curriculum" || response.status == 'no_post'){
                                        $('.scheduler-event').css('cursor','default');
                                        toastr.error('<?php e(lang('booking_err_not_open')); ?>');
                                   }
                                   else if(response.status == "choose_previous_date_time"){
                                        $('.scheduler-event').css('cursor','default'); 
                                        toastr.error('<?php e(lang('booking_err_cant_select_date')); ?>');
                                   }
                                   else if(response.status == "no_hour_slot"){
                                        $('.scheduler-event').css('cursor','default'); 
                                        toastr.error('<?php e(lang('booking_err_teacher_has_not_hour_slot')); ?>');
                                   } 
                                   else{
                                        $('.scheduler-event').css('cursor','default');
                                   }
                            } 
                        });
                    }
                    else{
                        event.preventDefault();
                        toastr.error('You cannot choose old date/time.');
                    }
                    
                },
                delete: function(event) {
                    
                    event.preventDefault();
                        
                        toastr.error('User cannot delete event.');
                        
                },
                
            }
        });
    
        new Y.Scheduler(
          {
            activeView: weekView,
            boundingBox: '#myScheduler',
            date: ttdda,
            eventRecorder: eventRecorder,
            items: events,
            render: true,
            views: [dayView, weekView, agendaView]
          }
        ).render();
        
        var editButton;
        
        Y.Do.after(function() {
            var btn_last = $('#schedulerEventRecorderForm .btn-group button').last().text();
            if(btn_last == 'Cancel'){
                $('#schedulerEventRecorderForm .btn-group button').last().addClass('disabled');
            }
            
            var input_val = $('#myScheduler .popover-title input').val();
            
            if(input_val == 'Available'){
                
                var data = this.serializeForm();
                var event_start_date = new Date(data.startDate);
                var _key = "bf_check_has_next_class";
                var teacher_id = "<?= $teacher_profile['meta']->id ?>";
                var student_id = '<?php echo $student_id ?>';
                
                var start_date_time =  event_start_date.getFullYear()+'-'+event_start_date.getMonth()+'-'+event_start_date.getDate()+' '+event_start_date.getHours()+':'+event_start_date.getMinutes()+':'+event_start_date.getSeconds();
                
                var n_event_start_date = new Date(data.startDate);
                n_event_start_date.setMinutes(n_event_start_date.getMinutes() + 60);
                var n_months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var n_days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
                var n_start = event_start_date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });//12 hr format
                var n_end = n_event_start_date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });//12 hr format
                var new_date_time = n_days[n_event_start_date.getDay()] + ', ' + n_months[n_event_start_date.getMonth()] + ' ' + n_event_start_date.getDate() + ', ' + n_start + ' - ' + n_end;
                
                if(event_start_date > current_date){
                    $('#myScheduler .popover-content .scheduler-event-recorder-date').hide();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo site_url('users/check_has_next_class');?>",
                        data: {key:_key,start_date : start_date_time, teacher_id:teacher_id, student_id:student_id},
                        dataType: 'json',
                        success: function(response) {
                            $('#myScheduler .popover-content .scheduler-event-recorder-date').show();
                            if(response.status == "slot_available"){
                                
                                $('#myScheduler .popover-content .scheduler-event-recorder-date').html(new_date_time);
<?php
                                if ($next_class[0]->id == ASSESSMENT_CLASS_ID) :                           
?>
                                    $('#myScheduler .popover-content .scheduler_event_double_class').attr('disabled','disabled');
                                    $('#myScheduler .popover-content .scheduler_event_double_class').hide();
<?php
                                else:
?>
                                    $('#myScheduler .popover-content').append('<label><input type="checkbox" class="scheduler_event_double_class" id="double_class" name="double_class" value="1">Book a double class</label>');
<?php
                                endif;
?>
                            }
                            else{
                                $('#myScheduler .popover-content .scheduler_event_double_class').attr('disabled','disabled');
                                $('#myScheduler .popover-content .scheduler_event_double_class').hide();
                            }
                        } 
                    });
                }
                
                var select_lesson = '<?php if(!empty($next_class)){
                                                foreach($next_class as $class){
                                                    echo '<input class="scheduler-event-recorder-content form-control" disabled id="lesson_details" name="lesson_details" value="'.lang("bf_lesson")." ".$class->lesson_number." [ ".$class->topic." ] ".'">';
                                                }
                                           }
                                           else{
                                                echo '<input class="scheduler-event-recorder-content form-control" disabled id="lesson_details" name="lesson_details" value="No Lesson Available">';
                                           } ?>';
                
                var toolbarBtnGroup = Y.one('#myScheduler .popover-title');
                toolbarBtnGroup.html(select_lesson);
            }
            else{
                $('#myScheduler .popover-title input').attr('disabled','disabled');
                var btn_first = $('#schedulerEventRecorderForm .btn-group button:nth-child(1)').text();
                if(btn_first == 'Save'){
                    $('#schedulerEventRecorderForm .btn-group button:nth-child(1)').addClass('disabled');
                }
                
            }
            
        }, eventRecorder, 'showPopover');
        
      }
    );

});

</script>
<?php
endif; ?>