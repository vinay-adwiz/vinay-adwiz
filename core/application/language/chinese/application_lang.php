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
$lang['bf_email']				= '电子邮件';
$lang['bf_user_settings']		= '简历';

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
$lang['bf_forgot_password']		= '忘记密码?';
$lang['bf_remember_me']			= '记得我';




//------------------------------------------------------------------------------
// Activation
//------------------------------------------------------------------------------
$lang['bf_activate_method']			= 'Activation Method';
$lang['bf_activate_none']			= 'None';
$lang['bf_activate_email']			= '电子邮件';
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

$lang['bf_home_page']			= '首页';
$lang['bf_action_logout']		= '退出系统';
$lang['bf_action_login']		= '进入系统';

$lang['page_contact_us']		= '联系我们';
$lang['page_faqs']		= '常见问题';

$lang['title_student_portal']		= '学生的系统';
$lang['title_welcome_student_portal']		= '欢迎进入English Gang 的系统';



$lang['my_account'] = '我的账号';
$lang['update_personal_details'] = '更改个人信息';
$lang['childs_dob'] = '出生年月日';
$lang['childs_gender'] = '性别';
$lang['childs_grade_level'] = '现在的教育程度';
$lang['school_name'] = '现在正在读的学校名称';
$lang['hours_english'] = '英文课堂数目，推荐每星期应有的课堂数目';
$lang['pref_teacher_gender'] = '老师的性别';
$lang['submit'] = '同意';


$lang['bf_purchase_package'] = '缴付新套餐费用';
$lang['change_password'] = '更改密码';
$lang['english_gang_home'] = '首页';


$lang['my_classes'] = '我的课程';
$lang['book_a_class'] = '预订课程';
$lang['upcoming_classes'] = '将要来到的课程';
$lang['completed_classes'] = '已学完的课程';

$lang['submit'] = '同意';
$lang['teacher'] = '老师的';
$lang['lesson'] = '课程';
$lang['class_date'] = '课程时间';
$lang['bf_cancel_account'] = '取消账号';

$lang['bf_referrals'] = '朋友介绍朋友';


//--------- New --------------------------------------------------------------
$lang['bf_my_calendar'] = '我的日历';
$lang['next_class_is'] = '您的下一课程是';
$lang['book_now'] = '预订';
$lang['no_upcoming_classes'] = '对于将要来到的课程，您还未做预订';
$lang['bf_teacher'] = '老师';
$lang['num_remaining_classes'] = '您现在的套餐还剩下 %s 课程';

$lang['password_hints'] = '密码至少包含六个字符，英文大写 1，小写 1 ，数字 1';

$lang['us_sign_up']					= '建立账号';
$lang['us_forgot_your_password']	= '忘记密码?';
$lang['us_let_me_in']				= '进入系统';


$lang['us_bad_email_pass']			= '电子邮件或密码不正确';
$lang['us_must_login']				= '您要进入系统，以看此页面';
$lang['us_no_permission']			= '您不能进入此页面';

$lang['us_fields_required']         = '请在空格填写%s及密码';

$lang['register_form_firstname'] = '名字';
$lang['register_form_lastname'] = '姓氏';
$lang['register_form_phone'] = '电话号码';
$lang['register_form_email'] = '电子邮件';
$lang['register_form_password'] = '我的密码';
$lang['register_form_repeat_pwd'] = '确认密码';


$lang['us_access_logs']				= 'Access Logs';
$lang['us_logged_in_on']			= '<b>%s</b> logged in on %s';
$lang['us_no_access_message']		= '<p>Congratulations!</p><p>All of your users have good memories!</p>';
$lang['us_log_create']				= 'created a new %s';
$lang['us_log_edit']				= 'modified user';
$lang['us_log_delete']				= 'deleted user';
$lang['us_log_logged']				= 'logged in from';
$lang['us_log_logged_out']			= 'logged out from';
$lang['us_log_reset']				= 'reset their password.';
$lang['us_log_register']			= 'registered a new account.';
$lang['us_log_edit_profile']		= 'updated their profile';


$lang['us_purge_del_confirm']		= 'Are you sure you want to completely remove the user account(s) - there is no going back?';
$lang['us_action_purged']			= 'Users purged.';
$lang['us_action_deleted']			= 'The User was successfully deleted.';
$lang['us_action_not_deleted']		= 'We could not delete the user: ';
$lang['us_delete_account']			= 'Delete Account';
$lang['us_delete_account_note']		= '<h3>Delete this Account</h3><p>Deleting this account will revoke all of their privileges on the site.</p>';
$lang['us_delete_account_confirm']	= 'Are you sure you want to delete the user account(s)?';

$lang['us_restore_account']			= 'Restore Account';
$lang['us_restore_account_note']	= '<h3>Restore this Account</h3><p>Un-delete this user\'s account.</p>';
$lang['us_restore_account_confirm']	= 'Restore this users account?';

$lang['us_role']					= 'Role';
$lang['us_role_lower']				= 'role';
$lang['us_no_users']				= 'No users found.';
$lang['us_create_user']				= 'Create New User';
$lang['us_create_user_note']		= '<h3>Create A New User</h3><p>Create new accounts for other users in your circle.</p>';
$lang['us_edit_user']				= 'Edit User';
$lang['us_restore_note']			= 'Restore the user and allow them access to the site again.';
$lang['us_unban_note']				= 'Un-Ban the user and all them access to the site.';
$lang['us_account_status']			= 'Account Status';

$lang['us_failed_login_attempts']	= 'Failed Login Attempts';
$lang['us_failed_logins_note']		= '<p>Congratulations!</p><p>All of your users have good memories!</p>';

$lang['us_banned_admin_note']		= 'This user has been banned from the site.';
$lang['us_banned_msg']				= 'This account does not have permission to enter the site.';

$lang['us_first_name']				= '名字';
$lang['us_last_name']				= '姓氏';
$lang['us_address_1']					= '地址 1';
$lang['us_address_2']					= '地址 2';
$lang['us_street_1']				= '路 1';
$lang['us_street_2']				= '路 2';
$lang['us_city']					= '城';
$lang['us_state']					= '区/县';
$lang['us_no_states']				= 'There are no states/provences/counties/regions for this country. Create them in the address config file';
$lang['us_no_countries']			= 'Unable to find any countries. Create them in the address config file.';
$lang['us_country']					= '国家';
$lang['us_zipcode']					= '邮递区号';

$lang['us_user_management']			= 'User Management';
$lang['us_email_in_use']			= '此电子邮件已被使用了';




$lang['us_edit_profile']			= '更改个人信息';
$lang['us_edit_note']				= '在下面填写您的细节，然后按保存';

$lang['us_reset_password']			= '更改密码';
$lang['us_reset_note']				= '输入您的电子邮件，我们将送暂时密码到您的电子邮件';
$lang['us_send_password']			= '密码';

$lang['us_login']					= '进入系统';
$lang['us_remember_note']			= '记得我';
$lang['us_sign_up']					= '建立账号';
$lang['us_forgot_your_password']	= '忘记密码?';
$lang['us_let_me_in']				= '进入系统';

$lang['us_or']				= '或';

$lang['us_password_mins']			= '至少8 个字母';
$lang['us_register']				= '登记';
$lang['us_already_registered']		= '是否已登记';

$lang['us_action_save']				= 'Save User';
$lang['us_unauthorized']			= 'Unauthorized. Sorry you do not have the appropriate permission to manage the "%s" role.';
$lang['us_empty_id']				= 'No userid provided. You must provide a userid to perform this action.';
$lang['us_self_delete']				= 'Unauthorized. Sorry, you can not delete yourself.';

$lang['us_filter_first_letter']		= 'Username starts with: ';
$lang['us_account_details']			= 'Account Details';
$lang['us_last_login']				= 'Last Login';


$lang['us_account_created_success'] = '账号简历成功，请进入系统';

$lang['us_invalid_user_id']         = 'Invalid user id.';
$lang['us_invalid_email']           = '我们的系统里没有此电子邮件';

$lang['us_reset_password_note']     = '请在下面输入新密码';
$lang['us_reset_invalid_email']     = 'That did not appear to be a valid password reset request.';
$lang['us_reset_pass_subject']      = '您的暂时密码';
$lang['us_reset_pass_message']      = '请查看您的电子邮件，以了解更改密码的方法';
$lang['us_reset_pass_error']        = '无法送电子邮件';

$lang['us_set_password']			= '重新记录密码';
$lang['us_reset_password_success']  = '请以新的密码进入系统';
$lang['us_reset_password_error']    = '在重新设定密码时，产生某种错误: %s';


$lang['us_profile_updated_success'] = 'Profile successfully updated.';
$lang['us_profile_updated_error']   = 'There was a problem updating your profile ';

$lang['us_register_disabled']       = 'New account registrations are not allowed.';

$lang['us_user_created_success']    = '建立用户账号成功';
$lang['us_user_update_success']     = '用户更新成功';

$lang['us_user_restored_success']   = 'User successfully restored.';
$lang['us_user_restored_error']     = 'Unable to restore user: ';


/* Activations */
$lang['us_active']					= '开始使用';
$lang['us_inactive']				= '关闭使用';
$lang['us_activate']				= 'Activation';
$lang['us_user_activate_note']		= 'Enter your activation code to confirm your e-mail address and activate your membership.';
$lang['us_activate_note']			= 'Activate the user and allow them access to the site';
$lang['us_deactivate_note']			= 'Deactivate the user to prevent access to the site';
$lang['us_activate_enter']			= 'Please enter your activation code to continue.';
$lang['us_activate_code']			= 'Activation Code';
$lang['us_activate_request']		= 'Request a new one';
$lang['us_activate_resend']			= 'Resend Activation Code';
$lang['us_activate_resend_note']	= 'Enter your email and we will resend your activation code to you.';
$lang['us_confirm_activate_code']	= 'Confirm Activation Code';
$lang['us_activate_code_send']		= 'Send Activation Code';
$lang['bf_action_activate']			= 'Activate';
$lang['bf_action_deactivate']		= 'Deactivate';
$lang['us_account_activated']		= 'User account activation.';
$lang['us_account_deactivated']		= 'User account deactivation.';
$lang['us_account_activated_admin']	= 'Administrative account activation.';
$lang['us_account_deactivated_admin']	= 'Administrative account deactivation.';
$lang['us_active']					= 'Active';
$lang['us_inactive']				= 'Inactive';
//email subjects
$lang['us_email_subj_activate']		= '开始使用';
$lang['us_email_subj_pending']		= '申请参加成功，等待启用';
$lang['us_email_thank_you']			= '谢谢您的登记 ';
$lang['us_email_already_use']		= '此电子邮件已被使用了';

// Activation Statuses
$lang['us_registration_fail'] 		= 'Registration did not complete successfully. ';
$lang['us_check_activate_email'] 	= 'Please check your email for instructions to activate your account.';
$lang['us_admin_approval_pending']  = 'Your account is pending admin approval. You will receive email notification if your account is activated.';
$lang['us_account_not_active'] 		= 'Your account is not yet active please activate your account by entering the code.';
$lang['us_account_active'] 			= 'Congratulations. Your account is now active!.';
$lang['us_account_active_login'] 	= 'Your account is active and you can now login.';
$lang['us_account_reg_complete'] 	= 'Registration to [SITE_TITLE] completed!';
$lang['us_active_status_changed'] 	= 'The user status was successfully changed.';
$lang['us_active_email_sent'] 		= 'Activation email was sent.';
// Activation Errors
$lang['us_err_no_id'] 				= 'No User ID was received.';
$lang['us_err_status_error'] 		= 'The users status was not changed: ';
$lang['us_err_no_email'] 			= 'Unable to send an email: ';
$lang['us_err_activate_fail'] 		= 'Your membership could not be activated at this time due to the following reason: ';
$lang['us_err_activate_code'] 		= 'Please check your code and try again or contact the site administrator for help.';
$lang['us_err_no_matching_code'] 	= 'No matching activation code was found in the system.';
$lang['us_err_no_matching_id'] 		= 'No matching user id was found in the system.';
$lang['us_err_user_is_active'] 		= 'The user is already active.';
$lang['us_err_user_is_inactive'] 	= 'The user is already inactive.';

/* Password strength/match */
$lang['us_pass_strength']			= '坚固';
$lang['us_pass_match']				= '比较';
$lang['us_passwords_no_match']		= '不一致';
$lang['us_passwords_match']			= '一致';
$lang['us_pass_weak']				= '轻';
$lang['us_pass_good']				= '好';
$lang['us_pass_strong']				= '很好';

$lang['us_tab_all']					= 'All Users';
$lang['us_tab_inactive']			= 'Inactive';
$lang['us_tab_banned']				= 'Banned';
$lang['us_tab_deleted']				= 'Deleted';
$lang['us_tab_roles']				= 'By Role';

$lang['us_forced_password_reset_note']	= '为了账号的安全，请选择新的密码';

$lang['us_back_to']					= 'Back to ';
$lang['us_no_account']              = 'No account?';
$lang['us_force_password_reset']    = 'Force password reset on next login';
$lang['us_old_password_error']    = '旧的密码不正确';

$lang['us_change_password_success']  = '已经更换密码了';
$lang['us_change_password_error']    = '更改密码不成功: %s';

$lang['bf_view_available_teachers'] = '我们的老师';
$lang['bf_back_to_portal'] = '回到系统';
$lang['bf_view_all_teachers'] = '查看所有老师姓名';
$lang['bf_male'] = '男';
$lang['bf_female'] = '女';

$lang['bf_profile_highlight'] = '有趣的简历';
$lang['bf_start_date'] = '开始日期';
$lang['bf_no_male_teachers'] = '现在没有有空的男老师';

$lang['bf_no_teachers'] = '现在没有有空的老师';

$lang['bf_teacher_profile'] = '老师的简历';
$lang['bf_profile'] = '简历';
$lang['bf_location'] = '地点';
$lang['bf_book_lesson'] = '预订课程';
$lang['packages'] = '套餐';
$lang['bf_booking_instructions'] = '您的下一课程，点击下面月历的空格，以预订此课程';
$lang['bf_color_guide'] = '彩色条意义';

$lang['bf_lesson'] = '课程';
$lang['bf_available_slot'] = '还空着的课程';
$lang['bf_current_booking'] = '目前所预订的课程';

$lang['purchase_package'] = '缴付新套餐费用';
$lang['package_name'] = '请选择右边的一个套餐，及继续付款手续';
$lang['current_package'] = '%s 是您现在的套餐，您还剩下 %s 课程，在买套餐之前';
$lang['select_package'] = '选择套餐';
$lang['buy_new_package'] = '您没有剩余的课程，请在下面选新的套餐';

$lang['packages_available'] = '您还剩下 %s  课程';
$lang['cancel_lose'] = '若您现在取消，您将不能再进入您的账号，及您的课程将被取消';

$lang['number_classes'] = '课堂数目';
$lang['price'] = '学费';
$lang['my_classes'] = '我的课程';
$lang['classes_completed_to_date'] = '直到现在所已完成的课程';

$lang['curriculum_level'] = '课程等级';
$lang['lesson'] = '课程';

$lang['assessment_plan'] = '评估等级';
$lang['teacher'] = '老师';
$lang['bf_profile_views'] = '看简历';
$lang['class_time'] = '课程时间';
$lang['provide_feedback'] = '给予建议';
$lang['view_feedback'] = '看建议';
$lang['no_completed_classes'] = '您的课程还未结束';
$lang['no_upcoming_classes'] = '对于将要来到的课程，您还未做预订';
$lang['cancel_class'] = '取消课程';
$lang['no_more_credit'] = '您在目前的课程已使用您的全部信用，在预订下一课程之前，请先购买新套餐';

$lang['cancellation_reason'] = '取消原因';
$lang['cancellation_reason_help'] = '请注明取消此课程的理由';
$lang['cancellation_free'] = '您可以免费的取消此课程';
$lang['cancellation_paid'] = '此取消在24小时以内，您会被要求缴付此课程的学费';
$lang['cancellation_paid_accept'] = '我愿意接受支付取消服务费';
$lang['cancellation_paid_accept_error'] = '我愿意接受取消的条件及协定';

$lang['success_cancelling_class'] = '已完成课程取消';
$lang['error_cancelling_class'] = '发现取消问题，请联系工作人员';

$lang['us_account_deleted']	= '您的账号被取消，如果此取消有错误，请联系我们的工作人员于  %s.';

$lang['my_account'] = '我的账户';
$lang['my_password'] = '我的密码';
$lang['new_password'] = '新密码';
$lang['confirm_password'] = '确认密码';
$lang['confirm_new_password'] = '确认密码';
$lang['enter_old_password'] = '原密码';
$lang['enter_new_password'] = '新密码';
$lang['change_password'] = '更改密码';
$lang['old_password'] = '原密码';

$lang['refund_reason'] = '取消理由';
$lang['request_a_refund'] = '申请退款';
$lang['enter_reason'] = '请注明取消此课程的理由';
$lang['cancel_instructions'] = '您是否确定要取消?';
$lang['cancellation_accept'] = '我了解，我将不能再进入系统';

$lang['cancellation_success'] = '谢谢，您的账号被取消了';
$lang['us_no_access_login'] = '不能进入系统';
$lang['make_favorite'] = '我最爱的节目';
$lang['remove_favorite'] = '删除最爱的节目';
$lang['favorite_removed'] = '最爱的节目被删除了';
$lang['favorite_added'] = '增加最爱的节目';
$lang['register_online'] = 'register online';

$lang['bf_manage_referrals'] = '处理我的参考密码';
$lang['referral_not_set_up'] = '您还未设定参考密码';
$lang['create_referral_code'] = '新建我的参考密码';
$lang['your_referral_url'] = '您的参考URL';
$lang['referral_instructions'] = '只要介绍您的朋友来与English Gang登记学习线上英语，立刻得到学费 500 铢折扣，当购买下一课程套餐，即..';
$lang['error_buying_package'] = '付款程序产生错误，请再试一次';
$lang['peak_hour_slot'] = '人们给予注意最多的时间';

$lang['my_favorites'] = '我的爱好';
$lang['favs_not_set'] = '您还未注明您的爱好';

$lang['signup_with_fb'] = '以 FACBBOOK 注册';
$lang['login_facebook'] = 'เข้าสู่ระบบด้วย Facebook';

$lang['bf_timezone'] = '时区';
$lang['bf_phn_no'] = '电话号码';

$lang['class_booked'] = '学生已预订号的课程';

$lang['password_hints'] = '密码至少包含六个字符，英文大写 1 ，小写 1 ，数字 1 ';


$lang['course_progress'] = '课程进度';
$lang['curriculum_progress'] = '课程进度';
$lang['completed_of'] = '从全部%s课程，您已学了%s课程';
$lang['bf_themes'] = '项目';
$lang['bf_phrases'] = '短语';
$lang['bf_vocabulary'] = '生字';
$lang['payment_confirmation'] = '确认付款';
$lang['invalid_refererence_number'] = '参考密码不正确';
$lang['error_processing_payment'] = '付款程序失败，请联系客服部门';
$lang['subscription_payment_accepted'] = '谢谢您，您的付款已完成及参加会员，可以马上启用';
$lang['subscription_payment_failed'] = '对不起，我们不能从您的信用卡扣除服务费，请联系银行人员，以询问更多的资料';
$lang['enter_feedback'] = '填写建议';
$lang['view_my_feedback'] = '看我的建议';
$lang['eg_referrals'] = 'ch:与外国母语老师学线上英文应用有效率的课程，请点击这里以做登记并免费做知识水平测验表!';
$lang['eg_register'] = '与English Gang登记';
$lang['en_ref_signup'] = '参加以申请English Gang 的参考密码';
$lang['book_first_class_now'] = '现在就预订您的学习课程!';
$lang['buy_more_credits'] = '多买信用';

$lang['booking_in_progress'] = 'Please wait.... Booking in progress';

$lang['booking_successful'] = '此学习课程表已预订好了';
$lang['register_online'] = 'register online';
$lang['register_form_ref_code'] = '介绍课程的工作人员代码';

$lang['bf_description']			= '细节';
$lang['bf_select_state'] 		= '选择城市';
$lang['bf_select_no_state'] 	= '没有城市';

$lang['booking_name_of_upcoming_class'] = '将要来到的课程名称';
$lang['booking_definition_color_bars'] = '色带的意思';
$lang['booking_blue_bar_course'] = '请在蓝色格子选上课时间';
$lang['booking_class_already_booked'] = '学生已经预定好的课程';
$lang['booking_timezones'] = '月历里的时间为泰国时区的时间(UTC +7) ，对于查看您的当地时间和泰国时间，请';
$lang['booking_blue_bar_course'] = '点击这里';
$lang['booking_err_time_booked'] = '您所选的时间已被预订了';
$lang['booking_err_select_lesson'] = '请选择课程';
$lang['booking_err_class_cant_be_booked'] = '产生错误，此课程不能够预订';
$lang['booking_err_class_not_avail'] = '您不能选此课程，因为还没有开课';
$lang['booking_err_class_not_booked'] = '此上课表还未预定';
$lang['booking_err_not_open'] = '此课程不开放预定';
$lang['booking_err_cant_select_date'] = '您不能选此日';

$lang['bf_language']			= '语言';

$lang['teacher_feedback'] = '老师的建议';
$lang['feedback_thanks'] = '谢谢，您的建议已进入我们的系统了';
$lang['invalid_class_id'] = '学习课程密码不对';
$lang['feedback_error_not_allowed'] = '对于此课程，您不能给予建议';
$lang['feedback_error_already_provided'] = '建议已被批准';
$lang['feedback_instructions'] = '请在下面的格子填写有关对老师的建议';
$lang['bf_no_female_teachers'] = '现在没有有空的女老师';
$lang['js_ref_code_err'] = '参考密码不正确';
$lang['js_ref_code_err_2'] = '发生错误，您不能登记';
$lang['js_acct_created_successfully'] = 'Account created successfully';
$lang['js_email_error'] = '此电子邮件已被系统使用，请再次输入电子邮件';
$lang['js_u_fname_req'] = '请注明真实姓名';
$lang['js_u_lname_req'] = '请注明姓氏';
$lang['js_email_req'] = '请注明电子邮件';
$lang['js_email_regx'] = '请注明正确的电子邮件';
$lang['js_phn_no_req'] = '请填写正确的电话号码';
$lang['js_phn_no_min_len'] = '电话号码必须等于10 个字';
$lang['js_phn_no_max_len'] = '电话号码不能超过12 个字';
$lang['js_phn_no_regx'] = '请填写正确的电话号码';
$lang['js_pass_req'] = '请输入密码';
$lang['js_pass_min_len'] = '密码至少要有6个字';
$lang['js_pass_regx'] = '密码必须包含1个大写字母，1个小写字母，一个数字，';
$lang['js_pass_con_req'] = '请再次输入密码';
$lang['js_pass_con_min_len'] = '密码至少包含六个字符';
$lang['js_passwords_equal'] = '密码于此前所输入不一样';

$lang['bf_password_min_length_help']		= '密保至少要有%s个字';

$lang['bf_password_number_required_help']	= '密码至少包要含一个数字';
$lang['bf_password_caps_required_help']		= '密码至少要包含一个大写字母';
$lang['bf_password_symbols_required_help']	= '密码至少要包含一个字符';

$lang['bf_password_length']					= '密码的长度';

$lang['bf_view_teachers'] = '看老师的细节内容';
$lang['portal_dashboard'] = '管理程式';
$lang['bf_action_register']		= '建立账户';

$lang['form_validation_bf_users'] = '使用者';
$lang['us_login']					= '进入系统';
$lang['us_remember_note']			= '记得我';
$lang['gender'] = '选择性别';

$lang['price_package'] = '服务费';

$lang['register_online'] = 'register online';
$lang['page_dashboard']			= '处理个人信息';
$lang['us_already_registered']		= '是否已登记';
$lang['us_register']				= '注册';
$lang['feedback'] = '建议';
$lang['package_vat'] = '价钱已包括增值税';
$lang['pkg_payment_option'] = '付款方式';

$lang['payment_credit_cards'] = '信用卡 / 借记卡';
$lang['payment_internet_banking'] = '每月分期付款 / 通过银行支付';
$lang['payment_alipay'] = 'Alipay';

$lang['my_feedback'] = '学生反馈';
$lang['no_feedback'] = '学生目前没有任何反';

$lang['unavailable_asseements'] = '不提供评估测试';

$lang['slide_more'] = 'Please slide left to see more classes';