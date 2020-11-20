<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2015, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT The MIT License.
 * @link      http://cibonfire.com
 * @since     Version 1.0
 */

/**
 * Application language file (English)
 *
 * Localization strings used by Bonfire
 *
 * @package Bonfire\Application\Language\English
 * @author  Bonfire Dev Team
 * @link    http://cibonfire.com/docs/developer
 */


//------------------------------------------------------------------------------
// ! GENERAL SETTINGS
//------------------------------------------------------------------------------

$lang['test_lang']			= 'Testing TH';

$lang['bf_site_name']			= 'Site Name';
$lang['bf_site_email']			= 'Site Email';
$lang['bf_site_email_help']		= 'The default email that system-generated emails are sent from.';
$lang['bf_site_status']			= 'Site Status';
$lang['bf_online']				= 'Online';
$lang['bf_offline']				= 'Offline';
$lang['bf_top_number']			= 'Items <em>per</em> page:';
$lang['bf_top_number_help']		= 'When viewing reports, how many items should be listed at a time?';
$lang['bf_home']				= 'Home';
$lang['bf_site_information']	= 'Site Information';
$lang['bf_timezone']			= 'Timezone';
$lang['bf_language']			= 'ภาษา';
$lang['bf_language_help']		= 'Choose the languages available to the user.';

//------------------------------------------------------------------------------
// ! AUTH SETTINGS
//------------------------------------------------------------------------------
$lang['bf_security']			= 'Security';
$lang['bf_login_type']			= 'Login Type';
$lang['bf_login_type_email']	= 'Email Only';
$lang['bf_login_type_username']	= 'Username Only';
$lang['bf_allow_register']		= 'Allow User Registrations?';
$lang['bf_login_type_both']		= 'Email or Username';
$lang['bf_use_usernames']		= 'User display across bonfire:';
$lang['bf_use_own_name']		= 'Use Own Name';
$lang['bf_allow_remember']		= 'Allow \'Remember Me\'?';
$lang['bf_remember_time']		= 'Remember Users For';
$lang['bf_week']				= 'Week';
$lang['bf_weeks']				= 'Weeks';
$lang['bf_days']				= 'Days';
$lang['bf_username']			= 'Username';
$lang['bf_password']			= 'Password';
$lang['bf_password_confirm']	= 'Password (again)';
$lang['bf_display_name']		= 'Display Name';
$lang['bf_u_fname']		        = 'First Name';
$lang['bf_u_lname']		        = 'Last Name';
$lang['bf_phn_no']		        = 'Phone Number';
$lang['bf_old_password']			= 'Old password';

//------------------------------------------------------------------------------
// ! CRUD SETTINGS
//------------------------------------------------------------------------------

$lang['bf_pages']				= 'Pages';
$lang['bf_enable_rte']			= 'Enable RTE for pages?';
$lang['bf_rte_type']			= 'RTE Type';
$lang['bf_searchable_default']	= 'Searchable by default?';
$lang['bf_cacheable_default']	= 'Cacheable by default?';
$lang['bf_track_hits']			= 'Track Page Hits?';

$lang['bf_action_save']			= 'Save';
$lang['bf_action_delete']		= 'Delete';
$lang['bf_action_edit']			= 'Edit';
$lang['bf_action_undo']			= 'Undo';
$lang['bf_action_cancel']		= 'Cancel';
$lang['bf_action_download']		= 'Download';
$lang['bf_action_preview']		= 'Preview';
$lang['bf_action_search']		= 'Search';
$lang['bf_action_purge']		= 'Purge';
$lang['bf_action_restore']		= 'Restore';
$lang['bf_action_show']			= 'Show';

$lang['bf_actions']				= 'Actions';
$lang['bf_clear']				= 'Clear';
$lang['bf_action_list']			= 'List';
$lang['bf_action_create']		= 'Create';
$lang['bf_action_ban']			= 'Ban';

//------------------------------------------------------------------------------
// ! SETTINGS LIB
//------------------------------------------------------------------------------
$lang['bf_ext_profile_show']	= 'Does User accounts have extended profile?';
$lang['bf_ext_profile_info']	= 'Check "Extended Profiles" to have extra profile meta-data available option(wip), omiting some default bonfire fields (eg: address).';

$lang['bf_yes']					= 'Yes';
$lang['bf_no']					= 'No';
$lang['bf_none']				= 'None';
$lang['bf_id']					= 'ID';

$lang['bf_or']					= 'or';
$lang['bf_size']				= 'Size';
$lang['bf_files']				= 'Files';
$lang['bf_file']				= 'File';

$lang['bf_with_selected']		= 'With selected';

$lang['bf_env_dev']				= 'Development';
$lang['bf_env_test']			= 'Testing';
$lang['bf_env_prod']			= 'Production';

$lang['bf_show_profiler']		= 'Show Admin Profiler?';
$lang['bf_show_front_profiler']	= 'Show Front End Profiler?';

$lang['bf_cache_not_writable']	= 'The application cache folder is not writable';

$lang['bf_password_strength']			= 'Password Strength Settings';
$lang['bf_password_length_help']		= 'Minimum password length e.g. 8';
$lang['bf_password_force_numbers']		= 'Should password force numbers?';
$lang['bf_password_force_symbols']		= 'Should password force symbols?';
$lang['bf_password_force_mixed_case']	= 'Should password force mixed case?';
$lang['bf_password_show_labels']		= 'Display password validation labels';
$lang['bf_password_iterations_note']	= 'Higher values increase the security and the time taken to hash the passwords.<br/>See the <a href="http://www.openwall.com/phpass/" target="blank">phpass page</a> for more information. If in doubt, leave at 8.';

//------------------------------------------------------------------------------
// ! USER/PROFILE
//------------------------------------------------------------------------------
$lang['bf_user']				= 'User';
$lang['bf_users']				= 'Users';
$lang['bf_email']				= 'อีเมล';
$lang['bf_user_settings']		= 'ประวัติ';
$lang['bf_description']			= 'รายละเอียด';
$lang['bf_select_state'] 		= 'เลือกเมือง';
$lang['bf_select_no_state'] 	= 'ไม่มีเมือง';

//------------------------------------------------------------------------------
// !
//------------------------------------------------------------------------------
$lang['bf_both']				= 'both';
$lang['bf_go_back']				= 'Go Back';
$lang['bf_new']					= 'New';
$lang['bf_required_note']		= 'Required fields are in <b>bold</b>.';
$lang['bf_form_label_required']	= '<span class="required">*</span>';

//------------------------------------------------------------------------------
// BF_Model
//------------------------------------------------------------------------------
$lang['bf_model_db_error']		= 'DB Error: %s';
$lang['bf_model_no_data']		= 'No data available.';
$lang['bf_model_invalid_id']	= 'Invalid ID passed to model.';
$lang['bf_model_no_table']		= 'Model has unspecified database table.';
$lang['bf_model_fetch_error']	= 'Not enough information to fetch field.';
$lang['bf_model_count_error']	= 'Not enough information to count results.';
$lang['bf_model_unique_error']	= 'Not enough information to check uniqueness.';
$lang['bf_model_find_error']	= 'Not enough information to find by.';

//------------------------------------------------------------------------------
// Contexts
//------------------------------------------------------------------------------
$lang['bf_no_contexts']			= 'The contexts array is not properly setup. Check your application config file.';
$lang['bf_context_content']		= 'Content';
$lang['bf_context_reports']		= 'Reports';
$lang['bf_context_settings']	= 'Settings';
$lang['bf_context_developer']	= 'Developer';

//------------------------------------------------------------------------------
// Activities
//------------------------------------------------------------------------------
$lang['bf_act_settings_saved']		= 'App settings saved from';
$lang['bf_unauthorized_attempt']	= 'unsuccessfully attempted to access a page which required the following permission "%s" from ';

$lang['bf_keyboard_shortcuts']		= 'Available keyboard shortcuts:';
$lang['bf_keyboard_shortcuts_none']	= 'There are no keyboard shortcuts assigned.';
$lang['bf_keyboard_shortcuts_edit']	= 'Update the keyboard shortcuts';

//------------------------------------------------------------------------------
// Common
//------------------------------------------------------------------------------
$lang['bf_question_mark']		= '?';
$lang['bf_language_direction']	= 'ltr';
$lang['bf_name']				= 'Name';
$lang['bf_status']				= 'Status';

//------------------------------------------------------------------------------
// Login
//------------------------------------------------------------------------------
$lang['bf_action_register']		= 'สร้างบัญชี';
$lang['bf_forgot_password']		= 'ืมรหัสผ่าน?';
$lang['bf_remember_me']			= 'จำฉัน';


//------------------------------------------------------------------------------
// Password Help Fields to be used as a warning on register
//------------------------------------------------------------------------------
$lang['bf_password_min_length_help']		= 'รหัสผ่านต้องมีอย่างน้อย %s ตัวอักษร';

$lang['bf_password_number_required_help']	= 'รหัสผ่านต้องประกอบไปด้วยอย่างน้อย 1 ตัวเลข';
$lang['bf_password_caps_required_help']		= 'รหัสผ่านต้องประกอบด้วยอย่างน้อย 1 ตัวพิมพ์ใหญ่';
$lang['bf_password_symbols_required_help']	= 'รหัสผ่านต้องประกอบไปด้วยอย่างน้อย 1 อักขระ';

$lang['bf_password_length']					= 'ความยาวของรหัสผ่าน';

//------------------------------------------------------------------------------
// Activation
//------------------------------------------------------------------------------
$lang['bf_activate_method']			= 'Activation Method';
$lang['bf_activate_none']			= 'None';
$lang['bf_activate_email']			= 'อีเมล';
$lang['bf_activate_admin']			= 'Admin';
$lang['bf_activate']				= 'Activate';
$lang['bf_activate_resend']			= 'Resend Activation';

$lang['bf_reg_complete_error']		= 'An error occurred completing your registration. Please try again or contact the site administrator for help.';
$lang['bf_reg_activate_email']		= 'An email containing your activation code has been sent to [EMAIL].';
$lang['bf_reg_activate_admin']		= 'You will be notified when the site administrator has approved your membership.';
$lang['bf_reg_activate_none']		= 'Please login to begin using the site.';
$lang['bf_user_not_active']			= 'User account is not active.';
$lang['bf_login_activate_title']	= 'Need to activate your account?';
$lang['bf_login_activate_email']	= '<b>Have an activation code to enter to activate your membership?</b> Enter it on the [ACCOUNT_ACTIVATE_URL] page.<br /><br />    <b>Need your code again?</b> Request it again on the [ACTIVATE_RESEND_URL] page.';

//------------------------------------------------------------------------------
// Profiler Template
//------------------------------------------------------------------------------
$lang['bf_profiler_box_benchmarks']  = 'Benchmarks';
$lang['bf_profiler_box_console']     = 'Console';
$lang['bf_profiler_box_files']       = 'Files';
$lang['bf_profiler_box_memory']      = 'Memory Usage';
$lang['bf_profiler_box_queries']     = 'Queries';
$lang['bf_profiler_box_session']     = 'Session User Data';

$lang['bf_profiler_menu_console']    = 'Console';
$lang['bf_profiler_menu_files']      = 'Files';
$lang['bf_profiler_menu_memory']     = 'Memory Used';
$lang['bf_profiler_menu_memory_mb']  = 'MB';
$lang['bf_profiler_menu_queries']    = 'Queries';
$lang['bf_profiler_menu_queries_db'] = 'Database';
$lang['bf_profiler_menu_time']       = 'Load Time';
$lang['bf_profiler_menu_time_ms']    = 'ms';
$lang['bf_profiler_menu_time_s']     = 's';
$lang['bf_profiler_menu_vars']       = '<span>vars</span> &amp; Config';

$lang['bf_profiler_true']            = 'true';
$lang['bf_profiler_false']           = 'false';

//------------------------------------------------------------------------------
// Form Validation
//------------------------------------------------------------------------------
$lang['bf_form_allowed_types']		= '%s must contain one of the allowed selections.';
$lang['bf_form_allowed_types_none']	= 'Configuration Error: No valid types available for the %s field.';
$lang['bf_form_alpha_extra']		= 'The %s field may only contain alpha-numeric characters, spaces, periods, underscores, and dashes.';
$lang['bf_form_matches_pattern']	= 'The %s field does not match the required pattern.';
$lang['bf_form_max_file_size']      = 'The file in %s field must not exceed {max_size}';
$lang['bf_form_one_of']				= '%s must contain one of the available selections.';
$lang['bf_form_one_of_none']        = 'Configuration Error: No valid values available for the %s field.';
$lang['bf_form_unique'] 			= 'The value in &quot;%s&quot; is already being used.';
$lang['bf_form_valid_password']		= 'The %s field must be at least {min_length} characters long.';
$lang['bf_form_valid_password_nums']	= '%s must contain at least 1 number.';
$lang['bf_form_valid_password_syms']	= '%s must contain at least 1 punctuation mark.';
$lang['bf_form_valid_password_mixed_1']	= '%s must contain at least 1 uppercase characters.';
$lang['bf_form_valid_password_mixed_2']	= '%s must contain at least 1 lowercase characters.';

$lang['bf_form_valid_url']  = '%s must contain a valid URL.';

//------------------------------------------------------------------------------
// Menu Strings - feel free to add your own custom modules here
// if you want to localize your menus
//------------------------------------------------------------------------------
$lang['bf_menu_activities']     = 'Activities';
$lang['bf_menu_code_builder']   = 'Code Builder';
$lang['bf_menu_db_tools']       = 'Database Tools';
$lang['bf_menu_db_maintenance'] = 'Maintenance';
$lang['bf_menu_db_backup']      = 'Backups';
$lang['bf_menu_emailer']        = 'Email Queue';
$lang['bf_menu_email_settings'] = 'Settings';
$lang['bf_menu_email_template'] = 'Template';
$lang['bf_menu_email_queue']    = 'View Queue';
$lang['bf_menu_kb_shortcuts']   = 'Keyboard Shortcuts';
$lang['bf_menu_logs']           = 'Logs';
$lang['bf_menu_migrations']     = 'Migrations';
$lang['bf_menu_permissions']    = 'Permissions';
$lang['bf_menu_queue']          = 'Queue';
$lang['bf_menu_roles']          = 'Roles';
$lang['bf_menu_settings']       = 'Settings';
$lang['bf_menu_sysinfo']        = 'System Information';
$lang['bf_menu_template']       = 'Template';
$lang['bf_menu_translate']      = 'Translate';
$lang['bf_menu_users']          = 'Users';

//------------------------------------------------------------------------------
// Anything that doesn't follow the 'bf_*' convention:
//------------------------------------------------------------------------------
$lang['log_intro']		= 'These are your log messages';

//------------------------------------------------------------------------------
// User Meta examples
//------------------------------------------------------------------------------
$lang['user_meta_street_name']	= 'Street Name';
$lang['user_meta_type']			= 'Type';
$lang['user_meta_country']		= 'Country';
$lang['user_meta_state']		= 'State';

//------------------------------------------------------------------------------
// Migrations lib
//------------------------------------------------------------------------------
$lang['no_migrations_found']			= 'No migration files were found';
$lang['multiple_migrations_version']	= 'Multiple migrations version: %d';
$lang['multiple_migrations_name']		= 'Multiple migrations name: %s';
$lang['migration_class_doesnt_exist']	= 'Migration class does not exist: %s';
$lang['wrong_migration_interface']		= 'Wrong migration interface: %s';
$lang['invalid_migration_filename']		= 'Wrong migration filename: %s - %s';

//------------------------------------------------------------------------------
// Form validation labels (for CI 3.0, should be fixed in 3.0.1)
//------------------------------------------------------------------------------

$lang['bf_home_page']			= 'หน้าแรก';
$lang['bf_action_logout']		= 'ออกจากระบบ';
$lang['bf_action_login']		= 'เข้าสู่ระบบ';
$lang['page_dashboard']			= 'จัดการข้อมูลส่วนตัว';
$lang['page_contact_us']		= 'ติดต่อเรา';
$lang['page_faqs']		= 'คำถามที่พบบ่อย';


$lang['title_student_portal']		= 'ระบบของนักเรียน';
$lang['title_welcome_student_portal']		= 'ขอต้อนรับเข้าสู่ระบบของEnglish Gang';

$lang['form_validation_bf_users'] = 'ผู้ใช้';

$lang['my_account'] = 'บัญชีของฉัน';
$lang['update_personal_details'] = 'เปลี่ยนแปลงข้อมูลส่วนตัว';
$lang['childs_dob'] = 'วันเดือนปีเกิด';
$lang['childs_gender'] = 'เพศ';
$lang['childs_grade_level'] = 'ระดับการศึกษาปัจจุบัน';
$lang['school_name'] = 'ชื่อโรงเรียนที่กำลังศึกษา';
$lang['hours_english'] = 'ชั่วโมงเรียนภาษาอังกฤษ คำแนะนำที่จะได้รับต่อสัปดาห์';
$lang['pref_teacher_gender'] = 'เพศของครูผู้สอน';
$lang['submit'] = 'ตกลง';
$lang['gender'] = 'เลือกเพศ';

$lang['price_package'] = 'อัตราค่าบริการ';

$lang['bf_view_teachers'] = 'ดูรายละเอียดของครูผู้สอน';
$lang['bf_purchase_package'] = 'ซื้อแพคเกจใหม่';
$lang['change_password'] = 'เปลี่ยนรหัสผ่าน';
$lang['english_gang_home'] = 'หน้าแรก';
$lang['portal_dashboard'] = 'โปรแกรมการจัดการ';

$lang['my_classes'] = 'คลาสเรียนของฉัน';
// $lang['book_a_class'] = 'คลิกที่นี่';
$lang['book_a_class'] = 'จองคลาสเรียน';
$lang['upcoming_classes'] = 'คลาสเรียนที่จะมาถึง';
$lang['completed_classes'] = 'คลาสเรียนที่จบแล้ว';

$lang['feedback'] = 'ข้อเสนอแนะ';
$lang['teacher_feedback'] = 'ข้อเสนอแนะจากครูผู้สอน';
$lang['feedback_thanks'] = 'ขอบคุณ ข้อเสนอแนะของคุณเข้าสู่ระบบเรียบร้อยแล้ว';
$lang['invalid_class_id'] = 'รหัสคลาสเรียนไม่ถูกต้อง';
$lang['feedback_error_not_allowed'] = 'คุณไม่สามารถแจ้งข้อเสนอแนะสำหรับคลาสเรียนนี้';
$lang['feedback_error_already_provided'] = 'ข้อเสนอแนะได้รับการอนุมัติแล้ว';
$lang['feedback_instructions'] = 'กรุณาใส่ข้อเสนอแนะถึงครูผู้สอนในช่องด้านล่าง';

$lang['submit'] = 'ตกลง';
$lang['teacher'] = 'ครูผู้สอน';
$lang['lesson'] = 'บทเรียน';
$lang['class_date'] = 'วันที่ของคลาสเรียน';
$lang['enter_feedback'] = 'ใส่ข้อเสนอแนะ';
$lang['view_my_feedback'] = 'ดูข้อเสนอแนะของฉัน';
$lang['bf_cancel_account'] = 'ยกเลิกบัญชี';

$lang['bf_referrals'] = 'เพื่อนแนะนำเพื่อน';
$lang['payment_confirmation'] = 'ยืนยันการชำระเงิน';
$lang['invalid_refererence_number'] = 'เลขอ้างอิงไม่ถูกต้อง';
$lang['error_processing_payment'] = 'ขั้นตอนการชำระเงินล้มเหลว กรุณาติดต่อฝ่ายบริการลูกค้า';
$lang['subscription_payment_accepted'] = 'ขอบคุณ การชำระเงินของคุณเรียบร้อยแล้ว และการสมัครสมาชิกเปิดใช้งานได้ทันที';
$lang['subscription_payment_failed'] = 'ขออภัย เราไม่สามารถดำเนินการหักค่าบริการจากบัตรของคุณได้ กรุณาติดต่อเจ้าของธนาคารของคุณเพื่อสอบถามข้อมูลเพิ่มเติม';

//--------- New --------------------------------------------------------------
$lang['bf_my_calendar'] = 'ปฎิทินของฉัน';
$lang['course_progress'] = 'ความคืบหน้าของคลาสเรียน';
$lang['next_class_is'] = 'คลาสเรียนต่อไปของคุณคือ';
$lang['book_now'] = 'จอง';
$lang['curriculum_progress'] = 'ความคืบหน้าของหลักศูตร';
$lang['completed_of'] = 'คุณเรียนไปทั้งหมด %s คลาส จากทั้งหมด %s คลาส';
$lang['no_upcoming_classes'] = 'ไม่มีคลาสเรียนที่กำลังจะมาถึง';

$lang['bf_themes'] = 'หัวข้อ';
$lang['bf_phrases'] = 'วลี';
$lang['bf_vocabulary'] = 'คำศัพท์';
$lang['bf_teacher'] = 'ครู';

$lang['eg_referrals'] = 'เรียนภาษาอังกฤษออนไลน์กับครูต่างชาติเจ้าของภาษาด้วยหลักสูตรที่มีประสิทธิภาพ คลิกที่นี่ เพื่อลงทะเบียนพร้อมทำแบบทดสอบวัดระดับความรู้ฟรี!';

$lang['eg_register'] = 'ลงทะเบียนกับ English Gang';
$lang['en_ref_signup'] = 'สมัครเพื่อขอรับรหัสอ้างอิงของ English Gang';

$lang['num_remaining_classes'] = 'คุณเหลือ %s คลาสในแพคเกจปัจจุบันของคุณ';
$lang['book_first_class_now'] = 'จองคลาสเรียนของคุณตอนนี้!';
$lang['buy_more_credits'] = 'ซื้อเครดิตเพิ่ม';

$lang['booking_in_progress'] = 'กรุณารอสักครู่ ระบบกำลังดำเนินการ';

$lang['booking_successful'] = 'ตารางเรียนนี้ได้ทำการจองเรียบร้อยแล้ว';

$lang['register_form_firstname'] = 'ชื่อ';
$lang['register_form_lastname'] = 'นามสกุล';
$lang['register_form_phone'] = 'หมายเลขโทรศัพท์';
$lang['register_form_email'] = 'อีเมล';
$lang['register_form_password'] = 'รหัสผ่าน';
$lang['register_form_repeat_pwd'] = 'ยืนยันรหัสผ่าน';
$lang['register_form_ref_code'] = 'รหัสเจ้าหน้าที่แนะนำหลักสูตร';



$lang['js_ref_code_err'] = 'รหัสอ้างอิงไม่ถูกต้อง';
$lang['js_ref_code_err_2'] = 'เกิดความผิดพลาด คุณไม่สามารถลงทะเบียนได้';
$lang['js_acct_created_successfully'] = 'บัญชีสร้างเสร็จสมบูรณ์';
$lang['js_email_error'] = 'อีเมลนี้ได้ถูกใช้งานในระบบแล้ว กรุณาระบุอีเมลใหม่อีกครั้ง';
$lang['js_u_fname_req'] = 'กรุณาระบุชื่อจริง';
$lang['js_u_lname_req'] = 'กรุณาระบุนามสกุล';
$lang['js_email_req'] = 'กรุณาระบุอีเมล';
$lang['js_email_regx'] = 'กรุณาระบุอีเมลที่ถูกต้อง';
$lang['js_phn_no_req'] = 'กรุณาใส่หมายเลขโทรศัพท์ที่ถูกต้อง';
$lang['js_phn_no_min_len'] = 'หมายเลขโทรศัพท์ต้องมีความยาว 10 ตัว';
$lang['js_phn_no_max_len'] = 'หมายเลขโทรศัพท์ต้องไม่เกิน 12 ตัว';
$lang['js_phn_no_regx'] = 'กรุณาใส่หมายเลขโทรศัพท์ที่ถูกต้อง';
$lang['js_pass_req'] = 'กรุณาระบุรหัสผ่าน';
$lang['js_pass_min_len'] = 'รหัสผ่านต้องมีอย่างน้อย 6 ตัว';
$lang['js_pass_regx'] = 'รหัสผ่านจะต้องมีความยาวอย่างน้อย 6 ตัว และประกอบไปด้วย 1 ตัวพิมพ์ใหญ่, 1 ตัวพิมพ์เล็ก และ 1 ตัวเลข';
$lang['js_pass_con_req'] = 'กรุณาระบุรหัสผ่านอีกครั้ง';
$lang['js_pass_con_min_len'] = 'รหัสผ่านต้องมีอย่างน้อย 6 ตัว';
$lang['js_passwords_equal'] = 'รหัสผ่านไม่ตรงกับรหัสผ่านที่ระบุไว้ก่อนหน้านี้';

$lang['booking_name_of_upcoming_class'] = 'ชื่อของคลาสเรียนที่กำลังจะมาถึง';
$lang['booking_definition_color_bars'] = 'ความหมายของแถบสี';
$lang['booking_blue_bar_course'] = 'กรุณาเลือกเวลาเรียนในช่องสีฟ้า';
$lang['booking_class_already_booked'] = 'คลาสที่ผู้เรียนได้จองไว้เรียบร้อยแล้ว';
$lang['booking_timezones'] = 'วันและเวลาที่แสดงในปฎิทินเป็นเขตเวลาของประเทศไทย(UTC +7). สำหรับการตรวจสอบเวลาท้องถิ่นของคุณ กับ เวลาประเทศไทย กรุณา';
$lang['booking_blue_bar_course'] = 'คลิกที่นี่';
$lang['booking_err_time_booked'] = 'ช่วงเวลาที่คุณเลือกถูกจองเรียบร้อยแล้ว';
$lang['booking_err_select_lesson'] = 'กรุณาเลือกบทเรียน';
$lang['booking_err_class_cant_be_booked'] = 'มีข้อผิดพลาด ตารางเรียนนี้ไม่สามารถจองได้';
$lang['booking_err_class_not_avail'] = 'คุณไม่สามารถเลือกตารางเรียนนี้ได้เนื่องจากยังไม่เปิดการสอน';
$lang['booking_err_class_not_booked'] = 'ตารางเรียนนี้ยังไม่ได้ทำการจอง';
$lang['booking_err_not_open'] = 'คลาสเรียนนี้ไม่เปิดให้จอง';
$lang['booking_err_cant_select_date'] = 'คุณไม่สามารถเลือกวันที่นี้ได้';
$lang['package_vat'] = 'ราคารวม VAT';

$lang['pkg_payment_option'] = 'ช่องทางการชำระเงิน ';

$lang['success_cancelling_class'] = 'ยกเลิกคลาสเรียนเรียบร้อยแล้ว';
$lang['error_cancelling_class'] = 'พบปัญหาในการยกเลิก กรุณาติดต่อเจ้าหน้าที่';

$lang['payment_credit_cards'] = 'บัตรเครดิต / เดบิต';
$lang['payment_internet_banking'] = 'ผ่อนชำระรายเดือน / ชำระผ่านเคาน์เตอร์ / ชำระผ่านธนาคาร';
$lang['payment_alipay'] = 'Alipay';

$lang['my_feedback'] = 'การตอบกลับสำหรับนักเรียน';
$lang['no_feedback'] = 'นักเรียนยังไม่ได้รับการตอบกลับใดๆ';

$lang['unavailable_asseements'] = 'ไม่สามารถทดสอบ<br /><span class="unavail-center">กับคุณครูท่านนี้ได้</span>';
$lang['slide_more'] = 'โปรดสไลด์ไปทางซ้ายเพื่อดูคลาสถัดไป';