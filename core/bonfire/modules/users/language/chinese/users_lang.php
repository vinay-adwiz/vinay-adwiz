<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	Copyright (c) 2011 Lonnie Ezell

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/


$lang['us_bad_email_pass']			= '电子邮件或密码不正确';
$lang['us_must_login']				= '您要进入系统，以看此页面
';
$lang['us_no_permission']			= '您不能进入此页面';

$lang['us_fields_required']         = '请在空格填写%s及密码';

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

$lang['us_first_name']				= '实姓名';
$lang['us_last_name']				= '姓氏';
$lang['us_address_1']					= 'ที่อยู่ 1';
$lang['us_address_2']					= 'ที่อยู่ 2';
$lang['us_street_1']				= '路1';
$lang['us_street_2']				= '路2';
$lang['us_city']					= '城市';
$lang['us_state']					= 'รัฐ/อำเภอ';
$lang['us_no_states']				= 'There are no states/provences/counties/regions for this country. Create them in the address config file';
$lang['us_no_countries']			= 'Unable to find any countries. Create them in the address config file.';
$lang['us_country']					= 'ประเทศ';
$lang['us_zipcode']					= 'รหัสไรษณีย์';

$lang['us_user_management']			= 'User Management';
$lang['us_email_in_use']			= '此电子邮件已被使用了 ';




$lang['us_edit_profile']			= 'แก้ไขประวัติส่วนตัว';
$lang['us_edit_note']				= '在下面填写您的细节，然后按保存';

$lang['us_reset_password']			= '重新设置密码';
$lang['us_reset_note']				= '输入您的电子邮件，我们将送暂时密码到您的电子邮件';
$lang['us_send_password']			= '密码';

$lang['us_login']					= '进入系统';
$lang['us_remember_note']			= 'จำฉัน';
$lang['us_sign_up']					= 'สร้างบัญชี';
$lang['us_forgot_your_password']	= 'ลืมรหัสผ่าน?';
$lang['us_let_me_in']				= '进入系统';

$lang['us_or']				= 'หรือ';

$lang['us_password_mins']			= '至少8 个字母';
$lang['us_register']				= 'ลงทะเบียน';
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
$lang['us_email_thank_you']			= '谢谢您的登记';
$lang['us_email_already_use']		= '此电子邮件已被使用了 ';

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
$lang['bf_male'] = 'เพศชาย';
$lang['bf_female'] = 'เพศหญิง';

$lang['bf_profile_highlight'] = 'ประวัติที่น่าสนใจ';
$lang['bf_start_date'] = '开始日期';
$lang['bf_no_male_teachers'] = '现在没有有空的男老师';
$lang['bf_no_female_teachers'] = 'ไม่มีครูผู้สอนเพศหญิงว่างอยู่ในขณะนี้';
$lang['bf_no_teachers'] = '现在没有有空的老师';

$lang['bf_teacher_profile'] = '老师的简历';
$lang['bf_profile'] = '简历';
$lang['bf_location'] = '地点';
$lang['bf_book_lesson'] = 'จองคลาสเรียน';
$lang['packages'] = '配套';
$lang['bf_booking_instructions'] = '您的下一课程，点击下面月历的空格，以预订此课程';
$lang['bf_color_guide'] = 'กำหนดสี';

$lang['bf_lesson'] = 'บทเรียน';
$lang['bf_available_slot'] = '还空着的课程';
$lang['bf_current_booking'] = '目前所预订的课程';

$lang['purchase_package'] = 'ชำระค่าแพคเกจใหม่';
$lang['package_name'] = '请选择右边的一个配套，及继续付款手续';
$lang['current_package'] = '%s 是您现在的配套，您还剩下%s 课程，在买配套之前';
$lang['select_package'] = 'เลือกแพคเกจ';
$lang['buy_new_package'] = '您没有剩余的课程，请在下面选新的配套';

$lang['packages_available'] = '%是您现在的配套，您还剩下%s课程';
$lang['cancel_lose'] = 'หากคุณยกเลิกตอนนี้ คุณจะไม่สามารถเข้าสู่บัญชีของคุณได้และคลาสเรียนที่เหลือจะถูกยกเลิก';

$lang['number_classes'] = 'จำนวนของคลาสเรียน';
$lang['price'] = 'ราคา';
$lang['my_classes'] = 'คลาสเรียนของฉัน';
$lang['classes_completed_to_date'] = 'คลาสเรียนเสร็จสมบูรณ์จนถึงปัจจุบัน';

$lang['curriculum_level'] = 'ระดับหลักสูตร';
$lang['lesson'] = 'บทเรียน';

$lang['assessment_plan'] = 'ระดับการประเมินผล';
$lang['teacher'] = '老师的';
$lang['bf_profile_views'] = '看简历';
$lang['class_time'] = 'เวลาของคลาสเรียน';
$lang['provide_feedback'] = 'ให้ข้อเสนอแนะ';
$lang['view_feedback'] = '看建议';
$lang['no_completed_classes'] = 'คลาสเรียนของคุณยังไม่เสร็จสิ้น';
$lang['no_upcoming_classes'] = 'คุณไม่มีการจองคลาสเรียนที่กำลังจะมาถึง';
$lang['cancel_class'] = 'ยกเลิกคลาสเรียน';
$lang['no_more_credit'] = '您在目前的课程已使用您的全部信用，在预订下一课程之前，请先购买新配套';

$lang['cancellation_reason'] = 'เหตุผลในการยกเลิก';
$lang['cancellation_reason_help'] = 'กรุณาระบุเหตุผลในการยกเลิกคลาสเรียนนี้';
$lang['cancellation_free'] = 'คุณสามารถยกเลิกคลาสเรียนนี้ได้ฟรี';
$lang['cancellation_paid'] = '此取消在24小时以内，您会被要求缴付此课程的学费';
$lang['cancellation_paid_accept'] = '我愿意接受支付取消服务费';
$lang['cancellation_paid_accept_error'] = '我愿意接受取消的条件及协定';


$lang['us_account_deleted']	= '您的账号被取消，如果此取消有错误，请联系我们的工作人员于 %s.';

$lang['my_account'] = 'บัญชีของฉัน';
$lang['my_password'] = 'รหัสผ่านของฉัน';
$lang['new_password'] = 'รหัสผ่านใหม่';
$lang['confirm_password'] = 'ยืนยันรหัสผ่าน';
$lang['confirm_new_password'] = 'ยืนยันรหัสผ่านใหม่';
$lang['enter_old_password'] = 'ใส่รหัสผ่านเดิม';
$lang['enter_new_password'] = 'ใส่รหัสผ่านใหม่';
$lang['change_password'] = 'เปลี่ยนรหัสผ่าน';
$lang['old_password'] = 'รหัสผ่านเดิม';

$lang['refund_reason'] = 'เหตุผลในการยกเลิก';
$lang['request_a_refund'] = '申请退款';
$lang['enter_reason'] = 'กรุณาระบุเหตุผลในการยกเลิก';
$lang['cancel_instructions'] = 'คุณแน่ใจหรือไม่ว่าต้องการยกเลิก?';
$lang['cancellation_accept'] = 'ฉันเข้าใจ ฉันจะไม่สามารถเข้าสู่ระบบได้อีก';

$lang['cancellation_success'] = '谢谢，您的账号被取消了';
$lang['us_no_access_login'] = '不能进入系统';
$lang['make_favorite'] = '我最爱的节目';
$lang['remove_favorite'] = '删除最爱的节目';
$lang['favorite_removed'] = '最爱的节目被删除了';
$lang['favorite_added'] = '增加最爱的节目';
$lang['register_online'] = 'register online chinese';

$lang['bf_manage_referrals'] = 'การจัดการรหัสอ้างอิงของฉัน';
$lang['referral_not_set_up'] = 'คุณยังไม่ได้ตั้งค่ารหัสอ้างอิง';
$lang['create_referral_code'] = 'สร้างรหัสอ้างอิงของฉัน';
$lang['your_referral_url'] = '您的参考URL';
$lang['referral_instructions'] = '只要介绍您的朋友来与English Gang登记学习线上英语，立刻得到学费 500 铢折扣，当购买下一课程配套，即...';
$lang['error_buying_package'] = '付款程序产生错误，请再试一次';
$lang['peak_hour_slot'] = '人们给予注意最多的时间';

$lang['my_favorites'] = '我的爱好';
$lang['favs_not_set'] = '您还未注明您的爱好';

$lang['signup_with_fb'] = 'ลงทะเบียนด้วย Facebook';
$lang['login_facebook'] = 'เข้าสู่ระบบด้วย Facebook';

$lang['bf_timezone'] = 'เขตเวลา';
$lang['bf_phn_no'] = 'หมายเลขโทรศัพท์';

$lang['class_booked'] = 'คลาสเรียนของคุณถูกจองเรียบร้อยแล้ว';

$lang['password_hints'] = 'รหัสผ่านจะต้องมีความยาวอย่างน้อย 6 ตัว และประกอบไปด้วย 1 ตัวพิมพ์ใหญ่, 1 ตัวพิมพ์เล็ก และ 1 ตัวเลข';
$lang['users_successfully_updated'] = 'ข้อมูลผู้ใช้งานอัพเดตเรียบร้อยแล้ว';
$lang['is_invalid_email'] = ' อีเมลไม่ถูกต้อง<br />';
$lang['has_following_errors'] = 'ข้อมูลดังกล่าวผิดพลาด:<br />';
