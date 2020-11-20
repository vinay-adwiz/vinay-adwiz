<?php

echo theme_view('header');

// side menu
echo theme_view('menu');
?>
<div id="page-content-wrapper">
    <div id="page-content">
        <div class="container">

<?php            
    echo Template::message();
    echo isset($content) ? $content : Template::content();
?>
        </div>
    </div>         
</div>

<?php

echo theme_view('footer');

?>