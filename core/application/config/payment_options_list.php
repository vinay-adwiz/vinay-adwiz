<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2014, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */
//------------------------------------------------------------------------------
// Countries
//------------------------------------------------------------------------------
$config['_payment_options'] = array(
    'SCB'      => array('name' => 'SCB', 'text' => 'payment_credit_cards', 'logo' => STUDENT_PORTAL_URL .'assets/images/payment_option/credit-cards.jpg', 'img_left' => '150'),
    '2C2P'   => array('name' => '2C2P', 'text' => 'payment_internet_banking', 'logo' => '', 'img_left' => '0'),
    'Alipay'   => array('name' => 'Alipay', 'text' => 'payment_alipay', 'logo' => STUDENT_PORTAL_URL .'assets/images/payment_option/alipay.jpg', 'img_left' => '70'),
);

