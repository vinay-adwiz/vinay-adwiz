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
// User Meta Fields Config - These are just examples of various options
// The following examples show how to use regular inputs, select boxes,
// state and country select boxes.
//------------------------------------------------------------------------------

$config['user_meta_fields'] =  array(

	array(
		'name'   => 'first_name',
		'label'   => 'First Name',
      'rules'         => 'required|trim|max_length[64]',
	),
	array(
		'name'   => 'last_name',
		'label'   => 'Last Name',
		'rules'   => 'required|trim|max_length[64]',
	),
	array(
		'name'   => 'phone_number',
		'label'   => 'Phone Number',
		'rules'   => 'required|trim|max_length[12]',
	),
);