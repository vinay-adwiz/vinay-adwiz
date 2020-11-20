<?php

$position =  '';
$display_name = '';

if ($this->auth->is_logged_in()) {

    $role_id = $this->auth->role_id();

    $position = ($role_id == DEVELOPER_ROLE_ID) ? 'Developer' : 'Administrator';

    $user_id = $this->auth->user_id();
    $qry = $this->db->query('select * from bf_user_meta where (user_id = "'.$user_id.'") ');
    $count_rows = $qry->num_rows();  
     
    if ($count_rows > 0) {
        foreach ($qry->result() as $row) {
            if ($row->meta_key == 'first_name') {
                $first_name = ucfirst($row->meta_value);
            }

            if ($row->meta_key == 'last_name') {
                $last_name = ucfirst($row->meta_value);
            }

        }

        $display_name = @$first_name . " " . @$last_name;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <style>
        /* Loading Spinner */
        .spinner{margin:0;width:70px;height:18px;margin:-35px 0 0 -9px;position:absolute;top:50%;left:50%;text-align:center}.spinner > div{width:18px;height:18px;background-color:#333;border-radius:100%;display:inline-block;-webkit-animation:bouncedelay 1.4s infinite ease-in-out;animation:bouncedelay 1.4s infinite ease-in-out;-webkit-animation-fill-mode:both;animation-fill-mode:both}.spinner .bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}.spinner .bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}@-webkit-keyframes bouncedelay{0%,80%,100%{-webkit-transform:scale(0.0)}40%{-webkit-transform:scale(1.0)}}@keyframes bouncedelay{0%,80%,100%{transform:scale(0.0);-webkit-transform:scale(0.0)}40%{transform:scale(1.0);-webkit-transform:scale(1.0)}}
    </style>


    <meta charset="UTF-8">
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
<title> English Gang Admin Portal</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

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


<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.css">


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



<!-- ICONS -->

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/_icons/fontawesome/fontawesome.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/_icons/linecons/linecons.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/_icons/spinnericon/spinnericon.css">


<!-- WIDGETS -->

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
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/slidebars/slidebars.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/slider-ui/slider.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/summernote-wysiwyg/summernote-wysiwyg.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/tabs-ui/tabs.css">

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/timepicker/timepicker.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/tocify/tocify.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/tooltip/tooltip.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/touchspin/touchspin.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/uniform/uniform.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/wizard/wizard.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/widgets/xeditable/xeditable.css">

<!-- SNIPPETS -->

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/chat.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/files-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/login-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/notification-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/progress-box.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/todo.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/user-profile.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/snippets/mobile-navigation.css">

<!-- APPLICATIONS -->

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/applications/mailbox.css">

<!-- Admin theme -->

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/themes/admin/layout.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/themes/admin/color-schemes/default.css">

<!-- Components theme -->

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/themes/components/default.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/themes/components/border-radius.css">

<!-- Admin responsive -->

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/responsive-elements.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/helpers/admin-responsive.css">

    <!-- JS Core -->

    <script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-core.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-ui-core.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-ui-widget.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-ui-mouse.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-ui-position.js"></script>
    <!--<script type="text/javascript" src="<?= base_url(); ?>assets/js-core/transition.js"></script>-->
    <script type="text/javascript" src="<?= base_url(); ?>assets/js-core/modernizr.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js-core/jquery-cookie.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/form-validation.js"></script>





    <script type="text/javascript">
        $(window).load(function(){
            setTimeout(function() {
                $('#loading').fadeOut( 400, "linear" );
            }, 300);
        });
    </script>

     <?php echo Assets::css(); ?>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">
    <script>var BASE_URL = '<?php echo base_url(); ?>';</script>

</head>


    <body>


    <div id="loading">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div id="page-wrapper">
        <div id="page-header" class="bg-gradient-9">
    <div id="mobile-navigation">
        <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar"><span></span></button>
        <a href="<?php echo base_url(); ?>" class="logo-content-small" title="English Gang"></a>
    </div>
    <div id="header-logo" class="logo-bg">
        <a href="<?php echo base_url(); ?>" class="logo-content-big" title="English Gang">
            English <i>Gang</i>
            <span>Administration Portal</span>
        </a>
        <a href="<?php echo base_url(); ?>" class="logo-content-small" title="English Gang">
            English <i>Gang</i>
            <span>Administration Portal</span>
        </a>
        <a id="close-sidebar" href="#" title="Close sidebar">
            <i class="glyph-icon icon-angle-left"></i>
        </a>
    </div>
    <div id="header-nav-left">
        <div class="user-account-btn dropdown">
            <a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown">
                <img width="28" src="<?= base_url(); ?>assets/image-resources/gravatar.jpg" alt="Profile image">
                <span><?= $display_name ?></span>
                <i class="glyph-icon icon-angle-down"></i>
            </a>
            <div class="dropdown-menu float-left">
                <div class="box-sm">
                    <div class="login-box clearfix">
                        <div class="user-img">
                            <img src="<?= base_url(); ?>assets/image-resources/gravatar.jpg" alt="">
                        </div>
                        <div class="user-info">
                            <span>
                                <?= $display_name ?>
                                <i><?= $position ?></i>
                            </span>
                            <a href="/admin/settings/users/edit/<?= $user_id ?>" title="Edit profile">Edit profile</a>
                            <a href="#" title="View notifications">View notifications</a>
                        </div>
                    </div>
                    <div class="pad5A button-pane button-pane-alt text-center">
                        <a href="<?php echo site_url('logout'); ?>" class="btn display-block font-normal btn-danger">
                            <i class="glyph-icon icon-power-off"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- #header-nav-left -->

    <div id="header-nav-right">

        <div class="dropdown" id="notifications-btn">
            <a data-toggle="dropdown" href="#" title="">
                <span class="small-badge bg-yellow"></span>
                <i class="glyph-icon icon-linecons-megaphone"></i>
            </a>
            <div class="dropdown-menu box-md float-right">

                <div class="popover-title display-block clearfix pad10A">
                    Notifications
                </div>
                <div class="scrollable-content scrollable-slim-box">
                    <ul class="no-border notifications-box">
                        <li>
                            <span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span>
                            <span class="notification-text">This is an error notification</span>
                            <div class="notification-time">
                                a few seconds ago
                                <span class="glyph-icon icon-clock-o"></span>
                            </div>
                        </li>
                        <li>
                            <span class="bg-warning icon-notification glyph-icon icon-users"></span>
                            <span class="notification-text font-blue">This is a warning notification</span>
                            <div class="notification-time">
                                <b>15</b> minutes ago
                                <span class="glyph-icon icon-clock-o"></span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="pad10A button-pane button-pane-alt text-center">
                    <a href="#" class="btn btn-primary" title="View all notifications">
                        View all notifications
                    </a>
                </div>
            </div>
        
        </div>
        <a class="header-btn" id="logout-btn" href="<?php echo site_url('logout'); ?>" title="Logout">
            <i class="glyph-icon icon-linecons-lock"></i>
        </a>

    </div><!-- #header-nav-right -->
</div>
         