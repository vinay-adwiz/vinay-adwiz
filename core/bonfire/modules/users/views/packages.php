
<?php

$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'   => $errorClass,
    'controlClass' => $controlClass,
);

?>


<div class="hero-box hero-box-smaller full-bg-13 font-inverse" data-top-bottom="background-position: 50% 0px;" data-bottom-top="background-position: 50% -600px;">
    <div class="container">
        <h1 class="hero-heading wow fadeInDown" data-wow-duration="0.6s"><?php e(lang('packages')); ?></h1>
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
                <h2><?php e(lang('purchase_package')); ?></h2>
                <p>&nbsp;</p>
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-error">
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php
                    endif;
                ?>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">

                            <h3 class="title-hero">
                            <?php  e(lang('select_package')); ?>
                            </h3>
                            <p> <?php echo Template::message(); ?>
                            <div class="example-box-wrapper">

                                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off')); ?>

                                     <div class="form-group <?php echo form_error('package_id') ? 'has-error' : ''; ?>">
                                        <div class="col-sm-12" style="padding-bottom: 13px; padding-left: 23px;">
                                            <p><?php echo sprintf(lang('num_remaining_classes'), $remaining_credit); ?></p>
                                        </div>
                                        <label class="col-sm-3 control-label" style="text-align: left; padding-left: 23px;"><?php e(lang('package_name')); ?></label>
                                        <div class="col-sm-6  packages">
                                <?php
                                        $selected_package_id = isset($_POST['package_id']) ? $_POST['package_id'] : '';
                                        foreach($all_packages as $package) { 
                                            $package_checked = (isset($selected_package_id) && $package['id'] == $selected_package_id) ? 'checked="checked"' : '';
                                    ?>               

                                            <div class="timeline-box timeline-box-right">
                                                <div class="tl-row">
                                                    <div class="tl-item">

                                                        <div class="popover left">
                                                            <div class="arrow"></div>
                                                            <div class="popover-content">
                                                                <div class="tl-label bs-label label-success"> <input type="radio" <?= $package_checked ?>name="package_id" value="<?= $package['id'] ?>"> <?= $package['name'] ?></div>
                                                                <p class="tl-content"><?php e(lang('price')); ?>: <?= $package['price'] ?> <?= CURRENCY ?> <br /><?php e(lang('number_classes')); ?>: <?= $package['number_classes'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
<?php
                                        }
                                    ?>
                                            <?php echo form_error('package_id', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group <?php echo form_error('package_id') ? 'has-error' : ''; ?>">
                                        <label class="col-sm-3 control-label"><?php e(lang('pkg_payment_option')); ?></label>
                                        <div class="col-sm-6  packages" style="margin-left: 35px;">
                                <?php
                                        $selected_payment_option = isset($_POST['payment_option']) ? $_POST['payment_option'] : '';
                              
                                        foreach($payment_options as $payment_option) { 

                                                $payment_checked = (isset($payment_option) && $payment_option['name'] == $selected_payment_option) ? 'checked="checked"' : '';

                                            ?>               

                                            <div class="timeline-box timeline-box-right">
                                                <div class="tl-row">
                                                    <div class="tl-item">

                                                        <div class="left">
                                                            
                                                            <div style="float: left; text-align: left; height: 30px;">
                                                                <input type="radio" name="payment_option" <?= $payment_checked ?> value="<?= $payment_option['name'] ?>"> 
                                                                <p style="    position: absolute;top: 10px;left: 30px;"><?= lang($payment_option['text']) ?> </p>
                                                            </div>
                                                            <?php if (empty($payment_option['logo'] === false)) : ?>
                                                                <div style="float: left; text-align: left; height: 30px; position: absolute;top: 10px;left: <?= $payment_option['img_left'] ?>px;"><img style="padding-left: 10px; max-height: 22px; margin-top: -2px;" src="<?= $payment_option['logo'] ?>" /></div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
<?php
                                        }
                                    ?>
                                            <?php echo form_error('payment_option', '<div class="alert alert-error">', '</div>'); ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="process" value="1" />
                                    <div class="form-group">
                                        <div class="col-sm-12 control-label"><input class="btn btn-primary"  name="save" type="submit" value="<?php e(lang('submit')); ?>"></div>
                                    </div>

                                <?php echo form_close(); ?>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
