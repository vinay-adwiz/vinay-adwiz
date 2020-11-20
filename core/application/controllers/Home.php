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
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

/**
 * Home controller
 *
 * The base controller which displays the homepage of the Bonfire site.
 *
 * @package    Bonfire
 * @subpackage Controllers
 * @category   Controllers
 * @author     Bonfire Dev Team
 * @link       http://guides.cibonfire.com/helpers/file_helpers.html
 *
 */
class Home extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper('application');
		$this->load->library('Template');
		$this->load->library('Assets');
		$this->lang->load('application');
		$this->load->library('events');
		$this->load->helper('date');

		$this->load->model('student_subscriptions/student_subscriptions_model');
		$this->load->model('curriculum/curriculum_model');


        $this->load->library('installer_lib');
        if (! $this->installer_lib->is_installed()) {
            $ci =& get_instance();
            $ci->hooks->enabled = false;
            redirect('install');
        }

        // Make the requested page var available, since
        // we're not extending from a Bonfire controller
        // and it's not done for us.
        $this->requested_page = isset($_SESSION['requested_page']) ? $_SESSION['requested_page'] : null;
	}

	//--------------------------------------------------------------------

	/**
	 * Displays the homepage of the Bonfire app
	 *
	 * @return void
	 */
	public function index()
	{
		$this->load->library('users/auth');
		$this->set_current_user();
		

		if ($this->auth->is_logged_in() === false) {
			header("Location: ".site_url()."login/");
			die();
		} else {
			$user_id = $this->current_user->id;
		}
		$next_class = $this->student_subscriptions_model->get_next_class($user_id);
		$lessons_in_level = $lessons_in_level_completed = $percentage_completed = '0';

// $get_max_date = $this->student_subscriptions_model->get_max_date($user_id);

// $get_max_time = $this->student_subscriptions_model->get_max_time($user_id, $get_max_date);


// dump($get_max_time); die();
		if (empty($next_class) === false) {

			$curriculum = $this->curriculum_model->load_curriculum_details($next_class[0]->id);
			$lessons_in_level = $this->curriculum_model->get_number_lessons_curriculum_level($curriculum['curriculum_level']);
			$lessons_in_level_completed = $this->curriculum_model->get_number_lessons_completed_curriculum_level($user_id, $curriculum['curriculum_level']);

			Template::set('curriculum_level', $curriculum['level']);
            Template::set('next_class', $next_class[0]);	
		} else {
			Template::set('curriculum_level',false);	
		}


        $student_remaining = $this->student_subscriptions_model->get_total_remaining_classes($user_id);
        Template::set('student_remaining', $student_remaining);

 		$all_upcoming_classes = $this->student_subscriptions_model->get_classes($user_id, CLASS_STATUS_BOOKED);

		Template::set('lessons_in_level', $lessons_in_level);	
		Template::set('lessons_in_level_completed', $lessons_in_level_completed);	
		Template::set('all_upcoming_classes', $all_upcoming_classes);	

				
		Template::render();
	} //end index()

	//--------------------------------------------------------------------


	/**
	 * Displays the user referral page
	 *
	 * @return void
	 */
	public function referrals($ref_code)
	{
		Template::set('ref_code', $ref_code);
		Template::set('page_type', 'referrals');
		Template::render();
	}//end index()


	/**
	 * If the Auth lib is loaded, it will set the current user, since users
	 * will never be needed if the Auth library is not loaded. By not requiring
	 * this to be executed and loaded for every command, we can speed up calls
	 * that don't need users at all, or rely on a different type of auth, like
	 * an API or cronjob.
	 *
	 * Copied from Base_Controller
	 */
	protected function set_current_user()
	{
        if (class_exists('Auth')) {
			// Load our current logged in user for convenience
            if ($this->auth->is_logged_in()) {
				$this->current_user = clone $this->auth->user();

				$this->current_user->user_img = gravatar_link($this->current_user->email, 22, $this->current_user->email, "{$this->current_user->email} Profile");

				// if the user has a language setting then use it
                if (isset($this->current_user->language)) {
					$this->config->set_item('language', $this->current_user->language);
				}
            } else {
				$this->current_user = null;
			}

			// Make the current user available in the views
            if (! class_exists('Template')) {
				$this->load->library('Template');
			}
			Template::set('current_user', $this->current_user);
		}
	}
}
/* end ./application/controllers/home.php */
