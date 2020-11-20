
<?php

$errorClass   = empty($errorClass) ? ' error' : $errorClass;
$controlClass = empty($controlClass) ? 'span6' : $controlClass;
$fieldData = array(
    'errorClass'   => $errorClass,
    'controlClass' => $controlClass,
);

?>
<div style="text-align: center;position: absolute;width: 98%;height: 100%;">
    <p>Processing your request.</p>
    <p>Please wait....</p>
    <img src="<?php echo site_url('assets/images/spinner/loader-dark.gif') ?>" style="width: 50px;" />
</div>

<div id="page-content" class="col-md-8 center-margin frontend-components mrg25T" style="height: 0px;">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div id="page-title">
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
                            <div class="example-box-wrapper">

                                <?php
                                
                                if(isset($selected_plan['name']) && isset($selected_plan['price'])){
                                
                                
                                     echo form_open(_2C2P_PAYMENT_URL, array('class' => 'form-horizontal bordered-row', 'autocomplete' => 'off', 'id'=>'myform')); ?>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="version" name="version" id="version" value="<?php echo _2C2P_VERSION; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="merchant_id" name="merchant_id" id="merchant_id" value="<?php echo _2C2P_MERCHANT_ID; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="currency" name="currency" id="currency" value="<?php echo _2C2P_CURRENCY; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                            <?php $result_url_1 = site_url('subscription/2c2p/response'); ?>
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="result_url_1" name="result_url_1" id="result_url_1" value="<?php echo $result_url_1; ?>"/>
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="result_url_2" name="result_url_2" id="result_url_2" value="<?php echo $result_url_1; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        
                                            <?php
                                            $payment_description =htmlentities($selected_plan['name']);
                                            switch(strlen($selected_plan['price'])){
                                                case "12":
                                                    $amount = $selected_plan['price'];
                                                break;
                                                case "11":
                                                    $amount = str_pad($selected_plan['price'].'0',12,"0",STR_PAD_LEFT);
                                                break;
                                                default;
                                                    $amount = str_pad($selected_plan['price'].'00',12,"0",STR_PAD_LEFT);
                                            }
                                            
                                            //Construct signature string
                                            $params = _2C2P_VERSION._2C2P_MERCHANT_ID.$payment_description.$order_id._2C2P_CURRENCY.$amount.$result_url_1.$result_url_1;
                                            $hash_value = hash_hmac('sha1',$params, _2C2P_API_SECRET_ID,false);	//Compute hash value
                                            
                                            ?>
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="hash_value" name="hash_value" id="hash_value" value="<?php echo $hash_value; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="payment_description" name="payment_description" id="payment_description" value="<?php echo $payment_description; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="order_id" name="order_id" id="order_id" value="<?php echo $order_id; ?>"/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="amount" name="amount" id="amount" value="<?php echo $amount; ?>"/>
                                            </div> 
                                        </div>
    
                                        <div class="form-group">
                                            <div class="col-sm-12 control-label"><input style="visibility:hidden;" class="btn btn-primary"  name="save" type="submit" value="<?php e(lang('submit')); ?>"></div>
                                        </div>
    
                                <?php 
                                    echo form_close();
                                
                                }?>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	document.forms.myform.submit();
</script>