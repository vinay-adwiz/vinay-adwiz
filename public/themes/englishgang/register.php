
<?php
	echo theme_view('header_basic'); 
    echo isset($content) ? $content : Template::content();
    echo theme_view('footer_basic'); 
?>