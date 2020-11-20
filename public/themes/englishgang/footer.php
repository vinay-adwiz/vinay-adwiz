<?php
$login_email = $this->session->userdata('login_email');
$login_pass = $this->session->userdata('login_pass');

if(!empty($login_email) && !empty($login_pass) && 0){
    
    $encrypt_login = base64_encode('rad01'.$login_email);
    $encrypt_pass = base64_encode('Rad@01'.$login_pass);
    echo $iframe = '<iframe src="https://englishgang.com/iframe?email='.$encrypt_login.'&pass='.$encrypt_pass.'" height="00" width="00"></iframe>';
    if($iframe){
        
        $array_items = array('login_email' => $login_email, 'login_pass' => $login_pass);

        $this->session->unset_userdata($array_items);
    }
}
?>
<br><br>

<div class="main-footer bg-gradient-4 clearfix">
    <div class="container clearfix">
        <div class="col-md-4 pad25R">
            <div class="header">เกี่ยวกับเรา</div>
            <p class="about-us">
                ปัญหาส่วนใหญ่ภายในประเทศที่เกิดขึ้นนั้น เราสามารถแก้ได้ด้วยระบบการศึกษา อิงลิชแก็ง จะทำให้เด็กๆเข้าถึงการเรียนภาษาอังกฤษได้อย่างมีประสิทธิภาพโดยเรียนจากอาจารย์เจ้าของภาษาโดยตรง ด้วยหลักสูตรที่มีคุณภาพสูงสุดจาก ESL
            </p>
        </div>
        <div class="col-md-4">
            <h3 class="header">บล็อก</h3>
            <?php 
            // $table_prefix= 'bf_wp_';
            $table_prefix= 'bf_wp_thai_659yn8';
            
            $select = "SELECT * FROM `".$table_prefix."_posts` WHERE `post_type` = 'post' AND `post_status` = 'publish' ORDER BY `post_date` DESC LIMIT 3";
            
            $query = $this->db->query($select);

            $results = $query->result_array();
            $prev_check = $query->num_rows();
            
            if($prev_check>0){
              
                echo '<div class="posts-list">';
                    echo '<ul>';
                    foreach($results as $result){
                        
                        $post_id = $result['ID'];
                        $post_title = $result['post_title'];
                        $post_guid = $result['guid'];
                        $post_date = $result['post_date'];
                        
                        $sql = "SELECT concat((select `option_value` from ".$table_prefix."_options where `option_name` ='siteurl'  limit 1),'/wp-content/uploads/',childmeta.meta_value) AS img_url FROM ".$table_prefix."_postmeta childmeta INNER JOIN ".$table_prefix."_postmeta parentmeta ON (childmeta.post_id=parentmeta.meta_value) WHERE parentmeta.meta_key='_thumbnail_id' and childmeta.meta_key = '_wp_attached_file' AND parentmeta.post_id = ".$post_id;
                        
                        $img_query = $this->db->query($sql);
            
                        $resultt = $img_query->result_array();
                        $prevCheck = $img_query->num_rows();
                        
                        echo '<li>';
                            echo '<div class="post-image">';
                                    if($prevCheck>0){
                                    echo '<a href="'.$resultt[0]['img_url'].'" class="prettyphoto" rel="prettyPhoto[pp_gal]" title="'.$post_title.'">
                                            <img class="img-responsive" src="'.$resultt[0]['img_url'].'" alt="">
                                        </a>';
                                    }
                                echo '</div> <!-- post-image -->';
                                
                                echo '<div class="post-body">
                                        <a class="post-title" href="'.$post_guid.'" title="'.$post_title.'">
                                            <h3>'.$post_title.'</h3>
                                        </a>
                                        Posted on '.$nice_date = date('d M, Y', strtotime( $post_date )).'
                                    </div> <!-- post-body -->';
                        echo '</li>';
                        
                        
                    }
                    echo '</ul>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="col-md-4">
            <h3 class="header">ติดต่อเรา</h3>
            <ul class="footer-contact">
                <li>
                    <i class="glyph-icon icon-envelope-o"></i>
                    <a href="mailto:<?= SUPPORT_EMAIL ?>" title=""><?= SUPPORT_EMAIL ?></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-pane">
        <div class="container clearfix">
            <div class="logo">&copy; <?= date('Y') ?> ลิขสิทธิ์ English Gang</div>
            <div class="footer-nav-bottom">
                <form action="#" method="post" id="lang-form">
                    <label for="lang-english">EN</label>
                    <span>|</span>
                    <input type="radio" class="user_lang" id="lang-english" value="lang-english">
                    <label for="lang-thai">ไทย</label>
                    <span>|</span>
                    <input type="radio" class="user_lang" id="lang-thai" value="lang-thai">
                    <label for="lang-chinese">中文</label>
                    <input type="radio" class="user_lang" id="lang-chinese" value="lang-chinese">
                </form>
            </div>
        </div>
    </div>
</div></div>

<!--<link rel="stylesheet" type="text/css" href="../../assets/widgets/datepicker/datepicker.css">-->
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/datepicker/datepicker.js"></script>
<script type="text/javascript">
    /* Datepicker bootstrap */

    $(function() { "use strict";
        $('.bootstrap-datepicker').bsdatepicker({
            format: 'mm-dd-yyyy'
        });
    });

</script>

<!-- Bootstrap Daterangepicker -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/daterangepicker/moment.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/daterangepicker/daterangepicker.js"></script>
<?php
if(!strpos(current_url(), 'profiles/teachers')){
    echo '<script type="text/javascript" src="'.base_url().'assets/widgets/daterangepicker/daterangepicker-demo.js"></script>';    
}
?>

<script type="text/javascript">

    /* Timepicker */

    /*$(function() { "use strict";
        $('.timepicker-example').timepicker();
    });*/
</script>


<div id="debug"><!-- Stores the Profiler Results --></div>
<!-- FRONTEND ELEMENTS -->

<!-- WIDGETS -->
<script type="text/javascript" src="<?= base_url(); ?>assets/tether/js/tether.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.js"></script>

<!-- Skrollr -->
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/skrollr/skrollr.js"></script>

<!-- Owl carousel -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/owlcarousel/owlcarousel.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/owlcarousel/owlcarousel-demo.js"></script>

<!-- HG sticky -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/sticky/sticky.js"></script>

<!-- WOW -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/wow/wow.js"></script>

<!-- VideoBG -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/videobg/videobg.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/videobg/videobg-demo.js"></script>

<!-- Mixitup -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/mixitup/mixitup.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/mixitup/isotope.js"></script>

<!-- WIDGETS -->

<!-- Dropzone -->
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/dropzone/dropzone.js"></script>

<!-- Bootstrap Dropdown -->

<?php /* <script type="text/javascript" src="<?= base_url(); ?>assets/widgets/dropdown/dropdown.js"></script>

<!-- Bootstrap Tooltip -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/tooltip/tooltip.js"></script>

<!-- Bootstrap Popover -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/popover/popover.js"></script>*/?>

<!-- Bootstrap Progress Bar -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/progressbar/progressbar.js"></script>

<!-- Bootstrap DatePicker -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/datepicker-ui/datepicker.js"></script>

<!-- Bootstrap Buttons -->
<?php /*
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/button/button.js"></script>

<!-- Bootstrap Collapse -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/collapse/collapse.js"></script> */ ?>

<!-- Superclick -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/superclick/superclick.js"></script>

<!-- Input switch alternate -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/input-switch/inputswitch-alt.js"></script>

<!-- Slim scroll -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/slimscroll/slimscroll.js"></script>

<!-- Content box -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/content-box/contentbox.js"></script>

<!-- Overlay -->

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/overlay/overlay.js"></script>

<!-- Widgets init for demo -->

<script type="text/javascript" src="<?= base_url(); ?>assets/js-init/widgets-init.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js-init/frontend-init.js"></script>

<!-- Theme layout -->

<script type="text/javascript" src="<?= base_url(); ?>assets/themes/frontend/layout.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/textarea/textarea.js"></script>

<!-- Toastr JS -->

<script type="text/javascript" src="<?= base_url(); ?>assets/toastr/toastr.min.js"></script>

<?php echo Assets::js(); ?>
<!-- Bootstrap Timepicker -->
<script>
$(function() {
    "use strict";
        

    $('#daterangepicker-time').daterangepicker({
        timePicker: true,
        timePicker24Hour:true,
        timePickerIncrement: 30,
        minDate:new Date(),
        startDate: moment().startOf('hour'),
        endDate: moment().startOf('hour').add(1,'days'),
        locale: {
            format: 'MM/DD/YYYY H:mm'
        },
    });
});

$('#daterangepicker-time').on('apply.daterangepicker', function(ev, picker) {
  var startDateTime = picker.startDate.format('YYYY-MM-DD H:mm')+':00';
  var endDateTime = picker.endDate.format('YYYY-MM-DD H:mm')+':00';
  $.ajax({
        type: "POST",
        url: "<?php echo site_url('users/view_teachers');?>",
        data: { startDateTime : startDateTime,endDateTime:endDateTime },
        beforeSend: function() {
            $('#loader_modal').show();
        },
        success: function(data) {
            $('#loader_modal').hide();
            if(data.length != ''){
                $(".teachers-list").html(data);    
            }else{
                $(".teachers-list").html('Nothing Found!');
            }
        } 
   });
});

</script>

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/datetimepicker/js/locales/bootstrap-datetimepicker.th.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_date').datetimepicker({
        language:  'th',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
</script>

<script>
toastr.options = {
    timeOut : 0,
    extendedTimeOut : 100,
    tapToDismiss : true,
    debug : false,
    fadeOut: 10,
    positionClass : "toast-top-center"
};
</script>

<script>
$(window).load(function(){
    if ( $( ".message" ).is( ".message.done" ) ) {
 
        var booking_successful = '<?php e(lang('booking_successful')) ?>';
        var _time_diff = Date.now()-timerStart;
        setTimeout(toastr.success(booking_successful),_time_diff );
        
        $('.message').removeClass('done');  
     
    }    
});
</script>

<script type="text/javascript">

$(document).ready(function(){
    $("#select_country").on('change',function(){
        var selectedCountry = $("#select_country option:selected").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('users/select_state');?>",
            data: { country : selectedCountry },
            success: function(data) {
                if(data.length != ''){
                    $(".select_state_div").html(data);    
                }else{
                    $(".select_state_div").html('<input type="text" class="form-control" placeholder="Enter State" name="select_state" id="select_state" />');
                }
                
                   
            } 
        });
    });
});
</script>


<script type="text/javascript">

$(document).ready(function(){
    $("#select_country").on('change',function(){
        var selectedCountry = $("#select_country option:selected").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('users/select_timezone');?>",
            data: { country : selectedCountry },
            success: function(data) {
                if(data.length != ''){
                    $(".select_timezone_div").html(data);    
                }else{
                    $(".select_timezone_div").html('<select class="form-control" name="select_timezone" id="select_timezone"><option value="">Select Timezone</option></select>');
                }
                   
            } 
        });
    });
});
</script>

<script>
$(document).ready(function(){
    
    //datepicker_1
    $(".datepicker_1").datepicker({
        minDate: 0,
        dateFormat: 'dd/mm/yy',
    });
    
    //datepicker_2
    $(".datepicker_2").datepicker({
        minDate: 1,
        dateFormat: 'dd/mm/yy',
    });

    //datepicker_dob
    $(".datepicker_dob").datepicker({
        dateFormat: 'dd/mm/yy',
    });
});
</script>

<script type="text/javascript">

$(document).ready(function(){
    $(".user_lang").on('change',function(e){
        e.preventDefault();
        var selectedUserLang = $(".user_lang:checked").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('users/update_user_lang');?>",
            data: { lang : selectedUserLang },
            dataType:'json',
            success: function(response) {
                if(response.status == 'success'){
                    //setTimeout(function(){ location.reload(); }, 1000);
                    location.reload();
                        
                }/*else{
                    toastr.error('Error: Language not updated!!');
                    selectedUserLang = '';
                }*/
                $('#lang-form')[0].reset();
                   
            } 
        });
    });
});
</script>

</body>
</html>






