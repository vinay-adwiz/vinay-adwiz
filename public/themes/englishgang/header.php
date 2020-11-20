<?php

$display_name = '';
$role_id = '';

if ($this->auth->is_logged_in()) {


    $role_id = $this->auth->role_id();
    $user_id = $this->auth->user_id();
    $qry = $this->db->query('select * from bf_user_meta where (user_id = "'.$user_id.'") ');
    $count_rows = $qry->num_rows();  
     
    if ($count_rows > 0) {
        foreach ($qry->result() as $row) {
            if ($row->meta_key == 'first_name') {
                if(!empty($row->meta_value)){
                    if (preg_match('/\p{Thai}/u', $row->meta_value) === 1) {
                        $first_name = $row->meta_value;
                    }
                    else{
                        $first_name = ucfirst($row->meta_value);
                    }
                }
                /*if(strlen($row->meta_value) != strlen(utf8_decode($row->meta_value))){
                   echo $first_name = $row->meta_value;
                }*/
                
            }

            if ($row->meta_key == 'last_name') {
                if(!empty($row->meta_value)){
                    if (preg_match('/\p{Thai}/u', $row->meta_value) === 1) {
                        $last_name = $row->meta_value;
                    }
                    else{
                        $last_name = ucfirst($row->meta_value);
                    }
                }
            }

        }


        $display_name = @$first_name . " " . @$last_name;
    }

    $qry2 = $this->db->query('select language from bf_users where id = "'.$user_id.'" ');
    $lang = $qry2->result();
    
    // check and reset lang to chinese if required
    if ( $lang[0]->language !== 'thai') {
        $this->lang->is_loaded = array();
        $this->lang->language = array();
        $this->lang->load('application', $lang[0]->language);
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WJH436C');</script>
<!-- End Google Tag Manager -->

    <meta charset="UTF-8">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title><?php
        echo isset($page_title) ? "{$page_title} : " : '';
        e(class_exists('Settings_lib') ? settings_item('site.title') : 'Bonfire');
    ?></title>
    <meta name="description" content="<?php e(isset($meta_description) ? $meta_description : ''); ?>">
    <meta name="author" content="<?php e(isset($meta_author) ? $meta_author : ''); ?>">
    <?php
    /* Modernizr is loaded before CSS so CSS can utilize its features */
    echo Assets::js('modernizr-2.5.3.js');
    ?>
    <?php echo Assets::css(); ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Favicons -->

<!-- Favicons -->
<link rel="apple-touch-icon" sizes="57x57" href="<?= base_url(); ?>assets/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?= base_url(); ?>assets/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url(); ?>assets/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>assets/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url(); ?>assets/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?= base_url(); ?>assets/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url(); ?>assets/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url(); ?>assets/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>assets/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>assets/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>assets/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/favicons/favicon-16x16.png">
<link rel="manifest" href="<?= base_url(); ?>assets/favicons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?= base_url(); ?>assets/favicons/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">


<!-- HELPERS -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/animate.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/backgrounds.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/boilerplate.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/border-radius.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/grid.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/page-transitions.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/spacing.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/typography.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/utils.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/colors.css">

<!-- ELEMENTS -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/badges.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/buttons.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/content-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/dashboard-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/forms.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/images.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/info-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/invoice.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/loading-indicators.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/menus.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/panel-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/response-messages.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/responsive-tables.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/ribbon.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/social-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/tables.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/tile-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/elements/timeline.css">

<!-- FRONTEND ELEMENTS -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend-elements/blog.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend-elements/cta-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend-elements/feature-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend-elements/footer.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend-elements/hero-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend-elements/icon-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend-elements/portfolio-navigation.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend-elements/pricing-table.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend-elements/sliders.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/frontend-elements/testimonial-box.css">

<!-- ICONS -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/_icons/fontawesome/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/_icons/linecons/linecons.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/_icons/spinnericon/spinnericon.css">

<!-- WIDGETS -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/datetimepicker/css/bootstrap-datetimepicker.min.css" >

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/accordion-ui/accordion.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/calendar/calendar.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/carousel/carousel.css">

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/charts/justgage/justgage.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/charts/morris/morris.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/charts/piegage/piegage.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/charts/xcharts/xcharts.css">

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/chosen/chosen.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/colorpicker/colorpicker.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/datatable/datatable.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/datepicker/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/datepicker-ui/datepicker.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/dialog/dialog.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/dropdown/dropdown.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/dropzone/dropzone.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/file-input/fileinput.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/input-switch/inputswitch.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/input-switch/inputswitch-alt.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/ionrangeslider/ionrangeslider.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/jcrop/jcrop.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/jgrowl-notifications/jgrowl.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/loading-bar/loadingbar.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/maps/vector-maps/vectormaps.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/markdown/markdown.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/modal/modal.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/multi-select/multiselect.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/multi-upload/fileupload.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/nestable/nestable.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/noty-notifications/noty.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/popover/popover.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/pretty-photo/prettyphoto.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/progressbar/progressbar.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/range-slider/rangeslider.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/slider-ui/slider.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/summernote-wysiwyg/summernote-wysiwyg.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/tabs-ui/tabs.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/theme-switcher/themeswitcher.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/timepicker/timepicker.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/tocify/tocify.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/tooltip/tooltip.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/touchspin/touchspin.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/uniform/uniform.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/wizard/wizard.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/xeditable/xeditable.css">

<!-- FRONTEND WIDGETS -->

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/layerslider/layerslider.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/owlcarousel/owlcarousel.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/fullpage/fullpage.css">

<!-- SNIPPETS -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/chat.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/files-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/login-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/notification-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/progress-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/todo.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/user-profile.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/mobile-navigation.css">

<!-- Frontend theme -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/themes/frontend/layout.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/themes/frontend/color-schemes/default.css">

<!-- Components theme -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/themes/components/default.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/themes/components/border-radius.css">

<!-- Frontend responsive -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/responsive-elements.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/frontend-responsive.css">

<!-- Calendar CSS -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/aui-calendar.css">

<!-- Youtube  iFrame -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/youtube-iframe.css">

<!-- Toastr CSS -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/toastr/toastr.min.css">

<!-- Rateyo rating CSS -->
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/rateyo-rating/rateyo-rating.min.css">

<!-- JS Core -->
<script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-core.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-ui-core.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-ui-widget.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-ui-mouse.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-ui-position.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js-core/transition.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js-core/modernizr.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-cookie.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/form-validation.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/aui-calendar.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/rateyo-rating/rateyo-rating.min.js"></script>
<script src="<?php echo site_url('assets/line-script.min.js') ?>" async="async" defer="defer"></script>

<script type="text/javascript" src="<?= base_url(); ?>assets/widgets/ckeditor/ckeditor.js"></script>

<script>

    // This code is generally not necessary, but it is here to demonstrate
    // how to customize specific editor instances on the fly. This fits well
    // this demo because we have editable elements (like headers) that
    // require less features.

    // The "instanceCreated" event is fired for every editor instance created.
    CKEDITOR.on( 'instanceCreated', function( event ) {
        var editor = event.editor,
                element = editor.element;

        // Customize editors for headers and tag list.
        // These editors don't need features like smileys, templates, iframes etc.
        if ( element.is( 'h1', 'h2', 'h3' ) || element.getAttribute( 'id' ) == 'taglist' ) {
            // Customize the editor configurations on "configLoaded" event,
            // which is fired after the configuration file loading and
            // execution. This makes it possible to change the
            // configurations before the editor initialization takes place.
            editor.on( 'configLoaded', function() {

                // Remove unnecessary plugins to make the editor simpler.
                editor.config.removePlugins = 'colorbutton,find,flash,font,' +
                'forms,iframe,image,newpage,removeformat,' +
                'smiley,specialchar,stylescombo,templates';

                // Rearrange the layout of the toolbar.
                editor.config.toolbarGroups = [
                    { name: 'editing',      groups: [ 'basicstyles', 'links' ] },
                    { name: 'undo' },
                    { name: 'clipboard',    groups: [ 'selection', 'clipboard' ] },
                    { name: 'about' }
                ];
            });
        }
    });

</script>

<script type="text/javascript">
    $(window).load(function(){
        setTimeout(function() {
            $('#loading').fadeOut( 400, "linear" );
        }, 300);
    });
    var timerStart = Date.now();
</script>

</head>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WJH436C"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="loading">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>

<div id="page-wrapper"><div class="top-bar bg-topbar">
    <div class="container">
        <div class="float-left">
            <a href="https://www.facebook.com/EnglishGangThailand/" target="_blank" class="btn btn-sm bg-facebook tooltip-button" data-placement="bottom" title="Follow us on Facebook">
                <i class="glyph-icon icon-facebook"></i>
            </a>
            <a href="https://www.facebook.com/EnglishGangThailand/" target="_blank" class="btn btn-sm bg-twitter tooltip-button" data-placement="bottom" title="Follow us on Twitter">
                <i class="glyph-icon icon-instagram"></i>
            </a>

            <a href="mailto:<?= SUPPORT_EMAIL ?>" class="btn btn-top btn-sm" title="Email Us">
                <i class="glyph-icon icon-envelope"></i>
                <?= SUPPORT_EMAIL ?>
            </a>
        </div>
        <div class="float-right user-account-btn dropdown">
            
            <span class="header-lang" style="float: left; height: 30px; line-height: 30px; padding-right: 20px; display: block;white-space: nowrap;float: left;">
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
            </span>
           
            <a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown" aria-expanded="false">
                <span><?= $display_name ?></span>
                <i class="glyph-icon icon-angle-down"></i>
            </a>

            

            <div class="dropdown-menu pad0B float-right">
                <div class="box-sm">
                    <div class="login-box clearfix">
                        <div class="user-info">
                        <span>
                            <?= $display_name ?>
                        </span>
                            <a href="<?php echo site_url("users/profile/"); ?>" title=""><?php echo lang('update_personal_details'); ?></a>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="pad5A button-pane button-pane-alt text-center">
                        <a href="<?php echo site_url("logout"); ?>" class="btn display-block font-normal btn-danger">
                            <i class="glyph-icon icon-power-off"></i>
                            <?php echo lang('bf_action_logout'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .container -->
</div><!-- .top-bar -->
<div class="main-header bg-header wow fadeInDown">
    <div class="container">
    <a href="<?php echo STUDENT_PORTAL_URL; ?>" class="header-logo" title="English Gang"></a><!-- .header-logo -->
    <div class="right-header-btn">
        <div id="mobile-navigation">
            <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target=".header-nav"><span></span></button>
        </div>
    </div><!-- .header-logo -->
    <ul class="header-nav collapse">
        <li>
            <a href="<?= STUDENT_PORTAL_URL ?>" title="Homepages">
                <?php echo lang('page_dashboard'); ?>
            </a>
        </li>
        <li>
            <a href="#" title="Hero sections">
                <?php echo lang('my_account'); ?>
                <i class="glyph-icon icon-angle-down"></i>
            </a>
            <ul class="footer-nav">
                <li><a href="<?php echo site_url("users/profile/"); ?>" title="Static hero sections"><span><?php echo lang('update_personal_details'); ?></span></a></li>
                <li><a href="<?php echo site_url("users/password/"); ?>" title="Static hero sections"><span><?php echo lang('change_password'); ?></span></a></li>
            </ul>
        </li>

        <li>
            <a href="<?= MAIN_WEBSITE_THAI_URL ?>?page_id=271" target="_blank" title="Components">
                <?php echo lang('page_faqs'); ?>
            </a>
        </li>
        <li>
            <a href="<?= MAIN_WEBSITE_THAI_URL ?>?page_id=54" target="_blank" title="Components">
                <?php echo lang('page_contact_us'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url("logout"); ?>" title="Components">
                <?php echo lang('bf_action_logout'); ?>
            </a>
        </li>

    </ul><!-- .header-nav -->
</div><!-- .container -->
</div><!-- .main-header -->