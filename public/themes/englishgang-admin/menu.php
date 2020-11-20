<?php 
$role_id = $this->auth->role_id(); 
$siteAreaUrl = site_url(SITE_AREA) . '/';

?>
<div id="page-sidebar">
    <div class="scroll-sidebar">


    <ul id="sidebar-menu">
   
   <li class="header"><span>Sites Navigation</span></li>
    <li>
        <a href="<?= MAIN_WEBSITE_URL ?>" target="_blank" title="Elements">
            <i class="glyph-icon icon-linecons-desktop"></i>
            <span>Main Website</span>
        </a>
        <a href="<?= ADMIN_PORTAL_URL ?>" title="Elements">
            <i class="glyph-icon icon-gears"></i>
            <span>Admin Portal</span>
        </a>
        <a href="<?= WP_ADMIN_URL ?>" target="_blank"  title="Elements">
            <i class="glyph-icon icon-wordpress"></i>
            <span>Manage Site Content</span>
        </a>
        <a href="<?= STUDENT_PORTAL_URL ?>" target="_blank"  title="Elements">
            <i class="glyph-icon icon-graduation-cap"></i>
            <span>Student Portal</span>
        </a>
        <a href="<?= TEACHER_PORTAL_URL ?>" target="_blank"  title="Elements">
            <i class="glyph-icon icon-male"></i>
            <span>Teacher Portal</span>
        </a>

    </li>


    <li class="header"><span>Manage</span></li>
    <li>
        <a href="#" title="Elements">
            <i class="glyph-icon icon-group"></i>
            <span>Users</span>
        </a>
        <div class="sidebar-submenu">
            <ul>
                <li><a href="<?php echo site_url(SITE_AREA . "/settings/users/"); ?>" title="Buttons"><span>Manage Users</span></a></li>
                <li><a href="<?php echo site_url(SITE_AREA . "/settings/users/create"); ?>" title="Buttons"><span>Add New User</span></a></li>
            </ul>
        </div><!-- .sidebar-submenu -->
    </li>
    <li>
        <a href="#" title="Elements">
            <i class="glyph-icon icon-linecons-user"></i>
            <span>Lessons</span>
        </a>
        <div class="sidebar-submenu">
            <ul>
                <li><a href="#" title="Buttons"><span>Add New Lesson</span></a></li>
                <li><a href="#" title="Buttons"><span>Manage Lessons</span></a></li>
            </ul>
        </div><!-- .sidebar-submenu -->
    </li>

    <li class="header"><span>Reporting</span></li>
    <li>
        <a href="#" title="Dashboard boxes">
            <i class="glyph-icon icon-pie-chart"></i>
            <span>Reports</span>
        </a>
        <div class="sidebar-submenu">
            <ul>
                <li><a href="#" title="Chart boxes"><span>Report #1</span></a></li>
                <li><a href="#" title="Tile boxes"><span>Report #2</span></a></li>
            </ul>
        </div><!-- .sidebar-submenu -->
    </li>
    <li>
        <a href="#" title="Elements">
            <i class="glyph-icon icon-linecons-money"></i>
            <span>Payments</span>
        </a>
    </li>

<?php   if($role_id == DEVELOPER_ROLE_ID) { ?>

            <li id="developer-menu">                
                <a href="#" title="Dashboard boxes">
            <i class="glyph-icon icon-wrench"></i>
            <span>Developer</span>
        </a>
                <ul class="nav nav-second-level">
                    <?php echo Contexts::render_menu('text', 'normal', false, true); ?>
                </ul>
            </li>
<?php  }
?>    

  
    </ul><!-- #sidebar-menu -->


    </div>
</div>