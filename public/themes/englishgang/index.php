<?php
if (@$page_type == 'forgot_password' || @$page_type == 'reset_password' || @$page_type == 'activate' || @$page_type == 'cancelled' || @$page_type == 'referrals') :
	echo theme_view('header_basic');
	echo isset($content) ? $content : Template::content();
	echo theme_view('footer_basic');
	echo '<div class="container"><!-- Start of Main Container -->';
else :
	echo theme_view('header'); ?>


    <?php
    //echo theme_view('_sitenav');
    echo isset($content) ? $content : Template::content();

    echo theme_view('footer');
?>
<?php
endif; ?>