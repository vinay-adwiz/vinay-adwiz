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

$lang['test_lang']			= 'Testing EN';

$lang['bf_select_country']			= 'Country';
$lang['bf_city']			= 'District';

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
$lang['bf_language']			= 'Language';
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
$lang['bf_old_password']        = 'Old password';
$lang['bf_address_1']		    = 'Address 1';
$lang['bf_address_2']		    = 'Address 2';
$lang['bf_post_code']		    = 'Post Code';

//------------------------------------------------------------------------------
// ! CRUD SETTINGS
//------------------------------------------------------------------------------
$lang['bf_home_page']			= 'Homepage';
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
$lang['bf_action_login']		= 'Login';
$lang['bf_action_logout']		= 'Logout';
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
$lang['bf_description']			= 'Description';
$lang['bf_email']				= 'Email';
$lang['bf_user_settings']		= 'My Profile';
$lang['bf_select_state'] 		= 'Select Province';
$lang['bf_select_no_state'] 	= 'No State Available';

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
$lang['bf_action_register']		= 'Sign Up';
$lang['bf_forgot_password']		= 'Forgot your password?';
$lang['bf_remember_me']			= 'Remember me';

//------------------------------------------------------------------------------
// Password Help Fields to be used as a warning on register
//------------------------------------------------------------------------------
$lang['bf_password_number_required_help']	= 'Password must contain at least 1 number.';
$lang['bf_password_caps_required_help']		= 'Password must contain at least 1 capital letter.';
$lang['bf_password_symbols_required_help']	= 'Password must contain at least 1 symbol.';

$lang['bf_password_min_length_help']		= 'Password must be at least %s characters long.';
$lang['bf_password_length']					= 'Password Length';

//------------------------------------------------------------------------------
// Activation
//------------------------------------------------------------------------------
$lang['bf_activate_method']			= 'Activation Method';
$lang['bf_activate_none']			= 'None';
$lang['bf_activate_email']			= 'Email';
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
// Anything that doesn't follow the 'bf_*'convention:
//-----------------------------------------------------------------------------
$lang['log_intro']		= 'Thse are your log messages';

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
$lang['form_validation_bf_users'] = 'Users';

$lang['page_contact_us']		= 'Contact us';
$lang['page_faqs']		= 'FAQ';

$lang['title_student_portal']		= 'Student Portal';
$lang['title_welcome_student_portal']= 'Welcome to English Gang portal';

$lang['update_personal_details'] = 'Update your personal information';
$lang['childs_dob'] = 'DOB';
$lang['childs_gender'] = 'Gender';
$lang['childs_grade_level'] = 'Current Level of Education';
$lang['school_name'] = 'School name';
$lang['hours_english'] = 'English Period: Advice Received per Week';
$lang['pref_teacher_gender'] = 'Gender of teacher';

$lang['my_classes'] = 'My classes';
// $lang['book_a_class'] = 'Click here';
$lang['book_a_class'] = 'Book a Class';
$lang['upcoming_classes'] = 'Up-Coming Classes';
$lang['completed_classes'] = 'Completed Classes';

$lang['submit'] = 'Submit';
$lang['gender'] = 'Select gender';
$lang['teacher'] = 'Teacher';
$lang['lesson'] = 'Lesson';
$lang['class_date'] = 'Class date';

$lang['bf_referrals'] = 'Refer a Friend';
$lang['num_remaining_classes'] = 'You still have %s classes remaining';
$lang['password_hints'] = 'Your password must contain at least 6 figures including 1 uppercase and 1 lowercase English letter and 1 number';


$lang['us_bad_email_pass']			= 'Email or password incorrect';
$lang['us_must_login']				= 'You need to log in to view this page';
$lang['us_no_permission']			= 'You have no permission to access this page';
$lang['us_fields_required']         = 'Please enter %s and password in the blank space.';



$lang['register_form_firstname'] = 'First name';
$lang['register_form_lastname'] = 'Last name';
$lang['register_form_phone'] = 'Phone number';
$lang['register_form_email'] = 'Email';
$lang['register_form_password'] = 'Password';
$lang['register_form_repeat_pwd'] = 'Confirm New Password';
$lang['register_form_ref_code'] = 'Referral code';

$lang['us_first_name']				= 'First name';
$lang['us_last_name']				= 'Last name';
$lang['us_address_1']					= 'address 1';
$lang['us_address_2']					= 'address 2';
$lang['us_street_1']				= 'Road 1';
$lang['us_street_2']				= 'Road 2';
$lang['us_city']					= 'City';
$lang['us_state']					= 'State';
$lang['us_country']					= 'Country';
$lang['us_zipcode']					= 'Postal code';

$lang['us_user_management']			= 'User Management';
$lang['us_email_in_use']			= 'This email is already being used. ';

$lang['us_edit_profile']			= 'Change Personal Info';
$lang['us_edit_note']				= 'Enter your information then click save';

$lang['us_reset_password']			= 'Change password';
$lang['us_reset_note']				= 'Enter your email. We will send a temporary password to the email address you have entered.';
$lang['us_send_password']			= 'Send password';

$lang['us_login']					= 'Please log in';
$lang['us_remember_note']			= 'Remember me';
$lang['us_sign_up']					= 'Create an account';
$lang['us_forgot_your_password']	= 'Forgot password?';
$lang['us_let_me_in']				= 'Login';
$lang['us_or']				= 'or';


$lang['us_password_mins']			= 'At least 8 letters';
$lang['us_register']				= 'Register';
$lang['us_already_registered']		= 'Have you registered?';

$lang['us_account_created_success'] = 'Account created. Please login.';

$lang['us_invalid_user_id']         = 'Invalid user id.';
$lang['us_invalid_email']           = 'This email cannot be found in our system.';

$lang['us_reset_password_note']     = 'Re-enter password below';
$lang['us_reset_pass_subject']      = 'Your temporary password';
$lang['us_reset_pass_message']      = 'Please re-check your email to view how to change your password.';
$lang['us_reset_pass_error']        = 'Error. You cannot send an email. ';
$lang['us_set_password']			= 'New password has been saved';
$lang['us_reset_password_success']  = 'Please login with new password';
$lang['us_reset_password_error']    = 'There is something wrong about reset password: %s';

$lang['us_user_created_success']    = 'Your account has been successfully created.';
$lang['us_user_update_success']     = 'User has been successfully updated.';

//email subjects
$lang['us_email_subj_activate']		= 'Activate';
$lang['us_email_subj_pending']		= 'Account created. Please login.';
$lang['us_email_thank_you']			= 'Thank you for registering.';
$lang['us_email_already_use']		= 'This email has already been taken.';



/* Password strength/match */
$lang['us_pass_strength']			= 'strong';
$lang['us_pass_match']				= 'Compare';
$lang['us_passwords_no_match']		= 'Incompatible';
$lang['us_passwords_match']			= 'Compatible';
$lang['us_pass_weak']				= 'Weak';
$lang['us_pass_good']				= 'Good';
$lang['us_pass_strong']				= 'ดีมาก';

$lang['us_forced_password_reset_note']	= 'For account security, please enter your new password.';
$lang['us_old_password_error']    = 'Incorrect current password';
$lang['us_change_password_success']  = 'Password change successful';
$lang['us_change_password_error']    = 'Password change unsuccessful: %s';

$lang['bf_view_available_teachers'] = 'Our teachers';
$lang['bf_back_to_portal'] = 'Back to portal';
$lang['bf_view_all_teachers'] = 'View all teachers';
$lang['bf_male'] = 'Male';
$lang['bf_female'] = 'Female';

$lang['bf_profile_highlight'] = 'Profile highlight';
$lang['bf_start_date'] = 'Start date';
$lang['bf_no_male_teachers'] = 'There are no male teachers available at this moment.';
$lang['bf_no_female_teachers'] = 'There are no female teachers available at this moment.';
$lang['bf_no_teachers'] = 'There are no teachers available at this moment.';


$lang['bf_teacher_profile'] = 'Teachers background';
$lang['bf_profile'] = 'Profile';
$lang['bf_location'] = 'Place';
$lang['bf_book_lesson'] = 'Book a class';
$lang['packages'] = 'Package';
$lang['bf_booking_instructions'] = 'Your next class. Click on a black space in the calendar below to book this class.';
$lang['bf_color_guide'] = 'กำหนดสี';

$lang['bf_lesson'] = 'Lesson';
$lang['bf_available_slot'] = 'Available classes';
$lang['bf_current_booking'] = 'Your current classes booking';
$lang['change_password'] = 'Change password';
$lang['english_gang_home'] = 'Home';
$lang['portal_dashboard'] = 'Management program';


$lang['purchase_package'] = 'New Package Payment';
$lang['package_name'] = 'Please choose 1 package from the right and proceed with the payment.';
$lang['current_package'] = ' You still have %s classes remaining before buying a package.';
$lang['select_package'] = 'Select package';
$lang['buy_new_package'] = 'You have no classes remaining. Please select a new package below.';

$lang['packages_available'] = 'You still have %s classes remaining.';
$lang['cancel_lose'] = 'If you cancel your account now, you will not be able to access your account and your remaining class(es) will be cancelled.';

$lang['number_classes'] = 'Number of classes';
$lang['price'] = 'Price';
$lang['my_classes'] = 'My classes';
$lang['classes_completed_to_date'] = 'Completed Classes to Date';

$lang['curriculum_level'] = 'Course level';
$lang['lesson'] = 'Lesson';

$lang['assessment_plan'] = 'Placement Test level';
$lang['teacher'] = 'Teacher';
$lang['bf_profile_views'] = 'View Profile';
$lang['class_time'] = 'Class time';
$lang['provide_feedback'] = 'Make a suggestion.';
$lang['view_feedback'] = 'View suggestions';
$lang['no_completed_classes'] = 'You have not completed your class.';
$lang['no_upcoming_classes'] = '';
$lang['cancel_class'] = 'Cancel class';
$lang['no_more_credit'] = 'You have already used all the credit in your current class. Please subscribe to a new package before booking your next class.';

$lang['cancellation_reason'] = 'Cancellation reason';
$lang['cancellation_reason_help'] = 'Please enter your cancellation reason';
$lang['cancellation_free'] = 'You can cancel this class for free.';
$lang['cancellation_paid'] = 'This cancellation is within the 24-hr period. Your money will be collected for this class.';
$lang['cancellation_paid_accept'] = 'I accept the cancellation fees.';
$lang['cancellation_paid_accept_error'] = 'I accept the cancellation terms and conditions.';

$lang['success_cancelling_class'] = 'This class has been successfully cancelled.';
$lang['error_cancelling_class'] = 'Problems encountered in the cancellation. Please contact staff member.';

$lang['us_account_deleted']	= 'Your account has been cancelled. If this cancellation is an error, please contact our staff members at %s.';

$lang['my_account'] = 'My account';
$lang['my_password'] = 'My password';
$lang['new_password'] = 'New password';
$lang['confirm_password'] = 'Confirm password';
$lang['confirm_new_password'] = 'Confirm new password';
$lang['enter_old_password'] = 'Old password';
$lang['enter_new_password'] = 'Enter new password';
$lang['change_password'] = 'Change password';
$lang['old_password'] = 'Current password';

$lang['refund_reason'] = 'Reason of cancellations';
$lang['request_a_refund'] = 'Requesting refund.';
$lang['enter_reason'] = 'Please state your reason for cancelling this class.';
$lang['cancel_instructions'] = 'Are you certain that you want to cancel your account?';
$lang['cancellation_accept'] = 'I understand that I will not be able to log in again.';

$lang['cancellation_success'] = 'Thank you. Your account has been cancelled.';
$lang['us_no_access_login'] = 'Login fail';
$lang['make_favorite'] = 'Favorite lists';
$lang['remove_favorite'] = 'Delete favorite lists';
$lang['favorite_removed'] = 'Favorites List has been deleted.';
$lang['favorite_added'] = 'Add my favorite lists';
$lang['register_online'] = 'Register Online';

$lang['bf_manage_referrals'] = 'My reference code managent';
$lang['referral_not_set_up'] = 'Please setup your reference code';
$lang['create_referral_code'] = 'Create my reference code';
$lang['your_referral_url'] = 'Your reference URL ';
$lang['referral_instructions'] = 'Just tell a friend to register for an online English course with English Gang and immediately receive a 500-baht discount, valid the next time you buy a package. By';
$lang['error_buying_package'] = 'Payment failed. Please try again.';
$lang['peak_hour_slot'] = 'Period attracting the greatest interest.';

$lang['my_favorites'] = 'Favorite lists';
$lang['favs_not_set'] = 'You have not specified the things you like.';

$lang['signup_with_fb'] = 'Register with Facebook';
$lang['login_facebook'] = 'Register via Facebook';

$lang['bf_timezone'] = 'Time zone';
$lang['bf_phn_no'] = 'Phone number';
$lang['class_booked'] = 'This class has already been booked.';
$lang['password_hints'] = 'Your password must contain at least 6 figures including 1 uppercase and 1 lowercase English letter and 1 number.';


$lang['bf_my_calendar'] = 'My calendar';
$lang['course_progress'] = 'Class progess';
$lang['next_class_is'] = 'Your up-coming classes.';
$lang['book_now'] = 'Book';
$lang['curriculum_progress'] = 'Course progress.';
$lang['completed_of'] = 'You have completed %s out of %s classes.';
$lang['no_upcoming_classes'] = 'There are no up-coming classes';

$lang['bf_themes'] = 'Topic';
$lang['bf_phrases'] = 'Phrase';
$lang['bf_vocabulary'] = 'Vocabulary';
$lang['bf_teacher'] = 'Teacher';

$lang['payment_confirmation'] = 'Comfirm payment';
$lang['invalid_refererence_number'] = 'Incorrect reference number.';
$lang['error_processing_payment'] = 'Payment error. Please contact our staff directly.';
$lang['subscription_payment_accepted'] = 'Thank you. Your payment is complete and you can start booking classes immediately.';
$lang['subscription_payment_failed'] = 'Sorry. We cannot take payment from your credit card. Please contact your bank for more information.';
$lang['subscription_payment_pending'] = 'Your payment is pending.';
$lang['subscription_payment_cancelled'] = 'Payment cancelled by User.';
$lang['subscription_payment_rejected'] = 'Your payment was rejected.';

$lang['enter_feedback'] = 'Make a suggestion.';

$lang['view_my_feedback'] = 'View my suggestions.';
$lang['bf_cancel_account'] = 'Cancel account';

$lang['eg_referrals'] = 'Learn English online with native English-speaking teachers  and an efficient course. Click here to register and receive a free placement test.';
$lang['eg_register'] = 'Register with Engling gang' ;
$lang['Booking_err_select_lesson'] = 'Please select the lesson';
$lang['booking_err_class_cant_be_booked'] = 'Error. You cannot book this class.';
$lang['booking_err_class_not_avail'] = 'You cannot choose this class because it is not currently offered.';
$lang['booking_err_class_not_booked'] = 'This class has not been booked.';
$lang['booking_err_not_open'] = 'This class is not available for booking.';
$lang['booking_err_cant_select_date'] = 'You can only book a slot which is after your last scheduled booking';
$lang['booking_err_teacher_has_not_hour_slot'] = 'The 1 hour booking is past the teacher availability';
$lang['package_vat'] = 'VAT included';


$lang['bf_no_female_teachers'] = 'There are no female teachers available at this moment.';

$lang['feedback'] = 'Suggestion';
$lang['teacher_feedback'] = 'Teacher suggestions';
$lang['feedback_thanks'] = 'Thank you. Your suggestion has entered the system.';
$lang['invalid_class_id'] = 'Incorrect class code.';
$lang['feedback_error_not_allowed'] = 'You cannot make a suggestion for this class.';
$lang['feedback_error_already_provided'] = 'Suggestion has been approved.';
$lang['feedback_instructions'] = 'Please make suggestions for the teacher in the space below.';


$lang['js_ref_code_err'] = 'Incorrect reference code.';
$lang['js_ref_code_err_2'] = 'Error. You cannot register.';
$lang['js_acct_created_successfully'] = 'Your account has been successfully created.';
$lang['js_email_error'] = 'This email is already being used. Please enter a new email.';
$lang['js_u_fname_req'] = 'Enter fisrt name.';
$lang['js_u_lname_req'] = 'Enter last name.';
$lang['js_email_req'] = 'Please enter email';
$lang['js_email_regx'] = 'Please enter correct email';
$lang['js_phn_no_req'] = 'Please enter the correct phone number.';
$lang['js_phn_no_min_len'] = 'Phone number must be 10 digits long.';
$lang['js_phn_no_max_len'] = 'Phone number must not exceed 12 digits.';
$lang['js_phn_no_regx'] = 'Please enter the correct phone number.';
$lang['js_pass_req'] = 'Please enter password';
$lang['js_pass_min_len'] = 'Password must contain at least 6 figures.';
$lang['js_pass_regx'] = 'Your password must contain at least 6 figures including 1 uppercase and 1 lowercase English letter and 1 number';
$lang['js_pass_con_req'] = 'Please re-enter password';
$lang['js_pass_con_min_len'] = 'Password must contain at least 6 figures.';
$lang['js_passwords_equal'] = 'Password does not match the previously entered password.';


$lang['bf_view_teachers'] = 'View teachers profile';
$lang['bf_purchase_package'] = 'Purchase new package';
$lang['bf_action_register']		= 'Create an account';
$lang['form_validation_bf_users'] = 'User';
$lang['us_login']					= 'Please login';
$lang['us_remember_note']			= 'Remember me';


$lang['price_package'] = 'Package';
$lang['register_online'] = 'register online';
$lang['page_dashboard']			= 'Manage personal information.';
$lang['us_already_registered']		= 'Have you registered?';

$lang['pkg_payment_option'] = 'Payment Option';

$lang['payment_credit_cards'] = 'Credit / Debit Card';
$lang['payment_internet_banking'] = 'Monthly Installments / Over The Counter / Bank Channel';
$lang['payment_alipay'] = 'Alipay';

$lang['booking_name_of_upcoming_class'] = 'Name of upcoming class';
$lang['booking_definition_color_bars'] = 'Definition of colored bars';
$lang['booking_blue_bar_course'] = 'Available time slot';
$lang['booking_class_already_booked'] = 'Upcoming class';
$lang['booking_timezones'] = 'The calendar is in Thailand timezone (UTC +7).';
$lang['booking_err_time_booked'] = 'Your selected time has already been booked';

$lang['book_first_class_now'] = 'Book your first class now';
$lang['booking_in_progress'] = 'Please wait. Booking in Progress';

$lang['booking_successful'] = 'Booking Successful';

$lang['buy_more_credits'] = 'Buy more credits';

$lang['my_feedback'] = 'View my Feedback';
$lang['no_feedback'] = 'You have no feedback yet';
$lang['unavailable_asseements'] = 'Unavailable for Assessments';

$lang['slide_more'] = 'Please slide left to see more classes';
