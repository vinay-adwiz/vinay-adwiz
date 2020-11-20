
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

<div id="page-content" class="col-md-8 center-margin frontend-components mrg25T" style="height: 0%;">
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
                                    
                                    $amount = $selected_plan['price'].'.00';
                                    
                                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                        $CustIP = $_SERVER['HTTP_CLIENT_IP'];
                                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                        $CustIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                    } else {
                                        $CustIP = $_SERVER['REMOTE_ADDR'];
                                    }
                                    
                                    $result_url_1 = site_url('subscription/alipay/response');
                                    
                                    //Construct signature string
                                	$params = ALIPAY_MERCHANT_PASSWORD.ALIPAY_MERCHANT_ID.$payment_id.$result_url_1.$amount.SCB_CURRENCY.$CustIP.ALIPAY_TIMEOUT;
                                    $hash_value = hash('sha256',$params,false);	//Compute hash value
                                    
                                     echo form_open(ALIPAY_PAYMENT_URL, array('class' => 'form-horizontal bordered-row',  'name' => 'frmPayment' , 'autocomplete' => 'off', 'id'=>'myform','method'=>'get')); ?>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="TransactionType" name="TransactionType" id="TransactionType" value="SALE"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="PymtMethod" name="PymtMethod" id="PymtMethod" value="<?php echo ALIPAY_EWALLET; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="ServiceID" name="ServiceID" id="ServiceID" value="<?php echo ALIPAY_MERCHANT_ID; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="PaymentID" name="PaymentID" id="PaymentID" value="<?php echo $payment_id; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="OrderNumber" name="OrderNumber" id="OrderNumber" value="<?php echo $order_id; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                            <?php $payment_description = htmlentities($selected_plan['name']); ?>
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="PaymentDesc" name="PaymentDesc" id="PaymentDesc" value="<?php echo $payment_description; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="MerchantName" name="MerchantName" id="MerchantName" value="<?php echo ALIPAY_MERCHANT_NAME; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="MerchantReturnURL" name="MerchantReturnURL" id="MerchantReturnURL" value="<?php echo $result_url_1; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="Amount" name="Amount" id="Amount" value="<?php echo $amount; ?>"/>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="CurrencyCode" name="CurrencyCode" id="CurrencyCode" value="<?php echo SCB_CURRENCY; ?>"/>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="CustIP" name="CustIP" id="CustIP" value="<?php echo $CustIP; ?>"/>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="CustName" name="CustName" id="CustName" value="<?php echo @$user->first_name.' '.@$user->last_name; ?>"/>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="CustEmail" name="CustEmail" id="CustEmail" value="<?php echo $user->email; ?>"/>
                                            </div> 
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="CustPhone" name="CustPhone" id="CustPhone" value="<?php echo @$user->phone_number; ?>"/>
                                            </div> 
                                        </div>
                                        <div class="input-group">
                                            <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="HashValue" name="HashValue" id="HashValue" value="<?php echo $hash_value; ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="MerchantTermsURL" name="MerchantTermsURL" id="MerchantTermsURL" value="<?php echo EG_TERMS_URL; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="LanguageCode" name="LanguageCode" id="LanguageCode" value="<?php echo ALIPAY_LANGUAGE_CODE; ?>"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="hidden" class="form-control <?php echo $controlClass; ?>" id="PageTimeout" name="PageTimeout" id="PageTimeout" value="<?php echo ALIPAY_TIMEOUT; ?>"/>
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