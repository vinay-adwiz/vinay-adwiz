<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2015, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

/**
 * User Model.
 *
 * The central way to access and perform CRUD on users.
 *
 * @package Bonfire\Modules\Users\Models\User_model
 * @author  Bonfire Dev Team
 * @link    http://cibonfire.com/docs/developer
 */
class User_model extends BF_Model
{
    /** @var string Name of the users table. */
    protected $table_name = 'users';

    /** @var string Name of the user meta table. */
    protected $meta_table = 'user_meta';

    /** @var string Name of the teacher applications table. */
    protected $applications_table = 'applications';

    /** @var string Name of the application answers table. */
    protected $application_answers_table = 'application_answers';

    /** @var string Name of the curriculum table. */
    protected $curriculum_table = 'curriculum';

    /** @var string Name of the publuc profile table. */
    protected $public_profile_table = 'public_profile';

    /** @var string Name of the application answers table. */
    protected $teacher_availability_table = 'teacher_availability';

    /** @var string Name of the application answers table. */
    protected $class_schedules_table = 'class_schedules';

    /** @var string Name of the roles table. */
    protected $roles_table = 'roles';

    /** @var boolean Use soft deletes or not. */
    protected $soft_deletes = true;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var boolean Set the modified time automatically. */
    protected $set_modified = false;

    /** @var boolean Skip the validation. */
    protected $skip_validation = true;

    /** @var array Validation rules. */
    protected $validation_rules = array(
        array(
            'field' => 'u_fname',
            'label' => 'lang:bf_u_fname',
            'rules' => 'required|trim|max_length[255]|check_only_english',
        ),
        array(
            'field' => 'u_lname',
            'label' => 'lang:bf_u_lname',
            'rules' => 'required|trim|max_length[255]|check_only_english',
        ),
        array(
            'field' => 'email',
            'label' => 'lang:bf_email',
            'rules' => 'required|trim|valid_email|max_length[254]',
        ),
        array(
            'field' => 'phone_number',
            'label' => 'lang:bf_phn_no',
            'rules' => 'required|max_length[12]|min_length[10]|regex_match[/^[0-9\-\(\)\s]+$/]',
        ),
        array(
            'field' => 'password',
            'label' => 'lang:bf_password',
            'rules' => 'max_length[120]|valid_password|matches[pass_confirm]',
        ),
        array(
            'field' => 'pass_confirm',
            'label' => 'lang:bf_password_confirm',
            'rules' => '',
        ),
        array(
            'field' => 'select_country',
            'label' => 'lang:bf_select_country',
            'rules' => 'required',
        ),
        array(
            'field' => 'select_state',
            'label' => 'lang:bf_select_state',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'city',
            'label' => 'lang:bf_city',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'select_timezone',
            'label' => 'lang:bf_select_timezone',
            'rules' => 'required',
        ),
        array(
            'field' => 'display_name',
            'label' => 'lang:bf_display_name',
            'rules' => 'trim|max_length[255]',
        ),
        array(
            'field' => 'language',
            'label' => 'lang:bf_language',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'select_timezone',
            'label' => 'Timezone',
            'rules' => 'trim|max_length[40]',
        ),
        array(
            'field' => 'username',
            'label' => 'lang:bf_username',
            'rules' => 'trim|max_length[30]',
        ),
        array(
            'field' => 'role_id',
            'label' => 'lang:us_role',
            'rules' => 'trim|max_length[2]|is_numeric',
        ),
        array(
            'field' => 'facebook_id',
            'label' => 'Facebook ID',
            'rules' => 'trim|max_length[30]',
        ),
        array(
            'field' => 'line_id',
            'label' => 'LINE ID',
            'rules' => 'trim|max_length[30]',
        ),
        array(
            'field' => 'address_1',
            'label' => 'lang:bf_address_1',
            'rules' => 'required|trim|check_valid_address',
        ),
        array(
            'field' => 'address_2',
            'label' => 'lang:bf_address_2',
            'rules' => 'trim|check_valid_address',
        ),
        array(
            'field' => 'post_code',
            'label' => 'lang:bf_post_code',
            'rules' => 'trim|alpha_dash',
        ),
        array(
            'field' => 'child_gender',
            'label' => 'Child gender',
            'rules' => 'trim|required',
        ),

        array(
            'field' => 'child_dob',
            'label' => 'Child\'s date of birth',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'child_grade_level',
            'label' => 'Current grade level',
            'rules' => 'trim|max_length[12]',
        ),
        array(
            'field' => 'child_school',
            'label' => 'School name',
            'rules' => 'trim|max_length[64]',
        ),
        array(
            'field' => 'child_hours_english',
            'label' => 'Hours of English instruction received per week',
            'rules' => 'trim|is_numeric',
        ),        
    );

    /** @var Array Additional validation rules only used on insert. */
    protected $insert_validation_rules = array(
        array(
            'field' => 'password',
            'label' => 'lang:bf_password',
            'rules' => 'required',
        ),
        array(
            'field' => 'pass_confirm',
            'label' => 'lang:bf_password_confirm',
            'rules' => 'required',
        ),      
    );

    /** @var array Metadata for the model's database fields. */
    protected $field_info = array(
        array('name' => 'id', 'primary_key' => 1),
        array('name' => 'created_on'),
        array('name' => 'deleted'),
        array('name' => 'role_id'),
        array('name' => 'email'),
        array('name' => 'username'),
        array('name' => 'password_hash'),
        array('name' => 'reset_hash'),
        array('name' => 'last_login'),
        array('name' => 'last_ip'),
        array('name' => 'banned'),
        array('name' => 'ban_message'),
        array('name' => 'reset_by'),
        array('name' => 'display_name'),
        array('name' => 'display_name_changed'),
        array('name' => 'timezone'),
        array('name' => 'language'),
        array('name' => 'active'),
        array('name' => 'activate_hash'),
        array('name' => 'force_password_reset'),
        array('name' => 'first_name'),
        array('name' => 'last_name'),
        array('name' => 'user_type'),
    );

    //--------------------------------------------------------------------------

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    

    //--------------------------------------------------------------------------
    // CRUD Method Overrides.
    //--------------------------------------------------------------------------

    /**
     * Count the users in the system.
     *
     * @param boolean $get_deleted If true, count users which have been deleted,
     * else count users which have not been deleted.
     *
     * @return integer The number of users found.
     */
    public function count_all($get_deleted = false)
    {
        if ($get_deleted) {
            // Get only the deleted users
            $this->db->where("{$this->table_name}.deleted !=", 0);
        } else {
            $this->db->where("{$this->table_name}.deleted", 0);
        }

        return $this->db->count_all_results($this->table_name);
    }

    /**
     * Perform a standard delete, but also allow a record to be purged.
     *
     * @param integer $id    The ID of the user to delete.
     * @param boolean $purge If true, the account will be purged from the system.
     * If false, performs a standard delete (with soft-deletes enabled).
     *
     * @return boolean True on success, else false.
     */
    public function delete($id = 0, $purge = false)
    {
        // Temporarily store the current setting for soft-deletes.
        $tempSoftDeletes = $this->soft_deletes;
        if ($purge === true) {
            // Temporarily set the soft_deletes to false to purge the account.
            $this->soft_deletes = false;
        }

        // Reset soft-deletes after deleting the account.
        $result = parent::delete($id);
        $this->soft_deletes = $tempSoftDeletes;

        return $result;
    }

    /**
     * Find a user's record and role information.
     *
     * @param integer $id The user's ID.
     *
     * @return boolean|object An object with the user's information.
     */
    public function find($id = null)
    {
        $this->preFind();

        return parent::find($id);
    }

    /**
     * Find all user records and the associated role information.
     *
     * @return boolean An array of objects with each user's information.
     */
    public function find_all()
    {
        $this->preFind();

        return parent::find_all();
    }

    /**
     * Find a single user based on a field/value match, including role information.
     *
     * @param string $field The field to match. If 'both', attempt to find a user
     * with the $value field matching either the username or email.
     * @param string $value The value to search for.
     * @param string $type  The type of where clause to create ('and' or 'or').
     *
     * @return boolean|object An object with the user's info, or false on failure.
     */
    public function find_by($field = null, $value = null, $type = 'and')
    {
        $this->preFind();

        return parent::find_by($field, $value, $type);
    }

    /**
     * Create a new user in the database.
     *
     * @param array $data An array of user information. 'password' and either 'email'
     * or 'username' are required, depending on the 'auth.use_usernames' setting.
     * 'email' or 'username' must be unique. If 'role_id' is not included, the default
     * role from the Roles model will be assigned.
     *
     * @return boolean|integer The ID of the new user on success, else false.
     */
    public function insert($data = array())
    {
        // If 'display_name' is not provided, set it to 'username' or 'email'.
        if (empty($data['display_name'])) {
            if ($this->settings_lib->item('auth.use_usernames') == 1
                && ! empty($data['username'])
            ) {
                $data['display_name'] = $data['username'];
            } else {
                $data['display_name'] = $data['email'];
            }
        }

        // Hash the password.
        $password = $this->auth->hash_password($data['password']);
        if (empty($password) || empty($password['hash'])) {
            return false;
        }

        $data['password_hash'] = $password['hash'];

        unset($data['password'], $password);

        // Get the default role if the role_id was not provided.
        if (! isset($data['role_id'])) {
            if (! class_exists('role_model', false)) {
                $this->load->model('roles/role_model');
            }
            $data['role_id'] = $this->role_model->default_role_id();
        }

        $id = parent::insert($data);
        Events::trigger('after_create_user', $id);

        return $id;
    }

    /**
     * Update an existing user. Before saving, it will:
     * - Generate a new password/hash if both password and pass_confirm are provided.
     * - Store the country code.
     *
     * @param integer $id   The user's ID.
     * @param array $data An array of key/value pairs to update for the user.
     *
     * @return boolean True if the update succeeded, null on invalid $id, or false
     * on failure.
     */
    public function update($id = null, $data = array())
    {
        if (empty($id)) {
            return null;
        }

        $trigger_data = array(
            'user_id' => $id,
            'data'    => $data,
        );
        Events::trigger('before_user_update', $trigger_data);

        // If the password is provided, hash it.
        if (! empty($data['password'])) {
            $password = $this->auth->hash_password($data['password']);
            if (empty($password) || empty($password['hash'])) {
                return false;
            }

            $data['password_hash'] = $password['hash'];

            unset($data['password'], $password);
        }

        // If the country is passed as 'iso', change it to 'country_iso'.
        if (isset($data['iso'])) {
            $data['country_iso'] = $data['iso'];
            unset($data['iso']);
        }

        $result = parent::update($id, $data);
        if ($result) {
            $trigger_data = array(
                'user_id' => $id,
                'data'    => $data,
            );
            Events::trigger('after_user_update', $trigger_data);
        }

        return $result;
    }

    //--------------------------------------------------------------------------
    // Other BF_Model Method Overrides.
    //--------------------------------------------------------------------------

    /**
     * Extracts the model's fields (except the key and those handled by observers)
     * from the $post_data and returns an array of name => value pairs.
     *
     * @param array $post_data The post data, usually $this->input->post() when
     * called from the controller.
     *
     * @return array An array of name => value pairs containing the prepared data
     * for the model's fields.
     */
    public function prep_data($post_data)
    {
        // Take advantage of BF_Model's prep_data() method.
        $data = parent::prep_data($post_data);

        // Special handling of the data specific to the User_model.

        // Only set 'timezone' if one was selected from the 'timezones' select.
        if (! empty($post_data['timezones'])) {
            $data['timezone'] = $post_data['timezones'];
        }

        // Only set 'password' if a value was provided (so the user's profile can
        // be updated without changing the password).
        if (! empty($post_data['password'])) {
            $data['password'] = $post_data['password'];
        }

        if (@$data['display_name'] === '') {
            unset($data['display_name']);
        }

        // Convert actions to the proper values.
        if (isset($post_data['restore']) && $post_data['restore']) {
            // 'restore': unset the soft-delete flag.
            $data['deleted'] = 0;
        }
        if (isset($post_data['unban']) && $post_data['unban']) {
            // 'unban': unset the banned flag.
            $data['banned'] = 0;
        }
        if (isset($post_data['activate']) && $post_data['activate']) {
            // 'activate': set the 'active' flag.
            $data['active'] = 1;
        } elseif (isset($post_data['deactivate']) && $post_data['deactivate']) {
            // 'deactivate': unset the 'active' flag.
            $data['active'] = 0;
        }

        return $data;
    }

    // -------------------------------------------------------------------------
    // Roles
    // -------------------------------------------------------------------------

    /**
     * Count the number of users that belong to each role.
     *
     * @return boolean|array An array of objects with the name of each role and
     * the number of users in that role, else false.
     */
    public function count_by_roles()
    {
        $this->db->select(array("{$this->roles_table}.role_name", 'count(1) as count'))
                 ->from($this->table_name)
                 ->join($this->roles_table, "{$this->roles_table}.role_id = {$this->table_name}.role_id", 'left')
                 ->group_by("{$this->roles_table}.role_name");

        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }

        return false;
    }

    /**
     * Update all users with the current role to have the default role.
     *
     * @param integer $current_role The ID of the role of users which will be set
     * to the default role.
     *
     * @return boolean True on successful update, else false.
     */
    public function set_to_default_role($current_role)
    {
        // Is the $current_role the right data type?
        if (! is_int($current_role)) {
            return false;
        }

        // Get the default role ID.
        if (! class_exists('role_model', false)) {
            $this->load->model('roles/role_model');
        }
        $defaultRoleId = $this->role_model->default_role_id();

        $this->db->where('role_id', $current_role);
        $query = $this->db->update(
            $this->table_name,
            array('role_id' => $defaultRoleId)
        );

        return (bool) $query;
    }

    //--------------------------------------------------------------------------
    // Password Methods.
    //--------------------------------------------------------------------------

    /**
     * Flag one or more user accounts to require a password reset on the user's
     * next login.
     *
     * @param integer $user_id The ID of the user to flag for password reset.
     *
     * @return boolean True if the account was updated successfully, else false.
     */
    public function force_password_reset($user_id = null)
    {
        if (! empty($user_id) && is_numeric($user_id)) {
            $this->db->where('id', $user_id);
        }

        return $this->db->set('force_password_reset', 1)->update($this->table_name);
    }

    /**
     * Generates a new password hash for the given password.
     *
     * @param string $old The password to hash.
     * @param integer $iterations    The number of iterations to use in generating the hash
     *
     * @return array An array with the hashed password and the number of iterations, or false
     */
    public function hash_password($old = '', $iterations = 0)
    {
        $password = $this->auth->hash_password($old, $iterations);
        if (empty($password) || empty($password['hash'])) {
            return false;
        }

        return array($password['hash'], $password['iterations']);
    }

    /**
     * Helper Method for Generating Password Hints based on Settings library.
     *
     * Call this method in the controller and echo $password_hints in the view.
     *
     * @return void
     */
    public function password_hints()
    {
        $message = array(
            sprintf(
                lang('bf_password_min_length_help'),
                (string) $this->settings_lib->item('auth.password_min_length')
            )
        );

        if ($this->settings_lib->item('auth.password_force_numbers') == 1) {
            $message[] = lang('bf_password_number_required_help');
        }

        if ($this->settings_lib->item('auth.password_force_symbols') == 1) {
            $message[] = lang('bf_password_symbols_required_help');
        }

        if ($this->settings_lib->item('auth.password_force_mixed_case') == 1) {
            $message[] = lang('bf_password_caps_required_help');
        }

        Template::set('password_hints', implode('<br />', $message));

        unset($message);
    }

    //--------------------------------------------------------------------------
    // !META METHODS
    //--------------------------------------------------------------------------

    /**
     * Retrieve all meta values defined for a user.
     *
     * @param integer $user_id The ID of the user for which the meta will be retrieved.
     * @param array   $fields  The meta_key names to retrieve.
     *
     * @return stdClass An object with the key/value pairs, or an empty object.
     */
    public function find_meta_for($user_id = null, $fields = null)
    {
        // Is $user_id the right data type?
        if (! is_numeric($user_id)) {
            $this->error = lang('us_invalid_user_id');
            return new stdClass();
        }

        // Limiting to certain fields?
        if (! empty($fields) && is_array($fields)) {
            $this->db->where_in('meta_key', $fields);
        }

        $query = $this->db->where('user_id', $user_id)
                          ->get($this->meta_table);
        if (! $query->num_rows()) {
            return new stdClass();
        }

        $result = new stdClass();
        foreach ($query->result() as $row) {
            $key = $row->meta_key;
            $result->$key = $row->meta_value;
        }

        return $result;
    }

    /**
     * Locate a single user and the user's meta information.
     *
     * @param integer $user_id The ID of the user to fetch.
     *
     * @return boolean|object An object with the user's profile and meta information,
     * or false on failure.
     */
    public function find_user_and_meta($user_id = null)
    {
        // Is $user_id the right data type?
        if (! is_numeric($user_id)) {
            $this->error = lang('us_invalid_user_id');
            return false;
        }

        // Does a user with this $user_id exist?
        $result = $this->find($user_id);
        if (! $result) {
            $this->error = lang('us_invalid_user_id');
            return false;
        }

        // Get the meta data for this user and join it to the user profile data.
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->meta_table);
        if ($query->num_rows()) {
            foreach ($query->result() as $row) {
                $key = $row->meta_key;
                $result->$key = $row->meta_value;
            }
        }

        return $result;
    }

    /**
     * Save one or more key/value pairs of meta information for a user.
     *
     * @example
     * $data = array(
     *    'location'    => 'That City, Katmandu',
     *    'interests'   => 'My interests'
     * );
     * $this->user_model->save_meta_for($user_id, $data);
     *
     * @param integer $user_id The ID of the user for which to save the meta data.
     * @param array   $data    An array of key/value pairs to save.
     *
     * @return boolean True on success, else false.
     */
    public function save_meta_for($user_id = null, $data = array())
    {
        // Is $user_id the right data type?
        if (! is_numeric($user_id)) {
            $this->error = lang('us_invalid_user_id');
            return false;
        }

        // If there's no data, get out of here.
        if (empty($data)) {
            return true;
        }

        $result = false;
        $successCount = 0;
        foreach ($data as $key => $value) {
            $obj = array(
                'meta_key'   => $key,
                'meta_value' => $value,
                'user_id'    => $user_id,
            );
            $where = array(
                'meta_key' => $key,
                'user_id'  => $user_id,
            );

            // Determine whether the data needs to be updated or inserted.
            $query = $this->db->where($where)
                              ->get($this->meta_table);
            if ($query->num_rows()) {
                $result = $this->db->update($this->meta_table, $obj, $where);
            } else {
                $result = $this->db->insert($this->meta_table, $obj);
            }

            // Count the number of successful insert/update results.
            if ($result) {
                ++$successCount;
            }
        }

        if ($successCount == count($data)) {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------
    // !ACTIVATION
    //--------------------------------------------------------------------------

    /**
     * Accepts an activation code and validates against a matching entry in the database.
     *
     * There are some instances where the activation hash should be removed but
     * the user should be left inactive (e.g. Admin Activation), so $leave_inactive
     * enables that use case.
     *
     * @param int    $user_id        The user to be activated (null will match any).
     * @param string $code           The activation code to be verified.
     * @param bool   $leave_inactive Flag whether to remove the activate hash value,
     * but leave active = 0.
     *
     * @return int User Id on success, false on error.
     */
    public function activate($user_id, $code, $leave_inactive = false)
    {
        if ($user_id) {
            $this->db->where('id', $user_id);
        }

        $query = $this->db->select('id')
                          ->where('activate_hash', $code)
                          ->get($this->table_name);

        if ($query->num_rows() !== 1) {
            $this->error = lang('us_err_no_matching_code');
            return false;
        }

        // Now we can find the $user_id, even if it was passed as NULL
        $result = $query->row();
        $user_id = $result->id;

        $active = $leave_inactive === false ? 1 : 0;
        if ($this->update($user_id, array('activate_hash' => '', 'active' => $active))) {
            return $user_id;
        }

        return false;
    }

    /**
     * This function is triggered during account setup to ensure user is not active
     * and, if not supressed, generate an activation hash code. This function can
     * be used to deactivate accounts based on public view events.
     *
     * @param int    $user_id    The username or email to match to deactivate
     * @param string $login_type Login Method
     * @param bool   $make_hash  Create a hash
     *
     * @return mixed $activate_hash on success, false on error
     */
    public function deactivate($user_id, $make_hash = true)
    {
        // create a temp activation code.
        $activate_hash = '';
        if ($make_hash === true) {
            $this->load->helper('string');
            $activate_hash = sha1(random_string('alnum', 40) . time());
        }

        $this->db->update(
            $this->table_name,
            array('active' => 0, 'activate_hash' => $activate_hash),
            array('id' => $user_id)
        );

        if ($this->db->affected_rows() != 1) {
            return false;
        }

        return $make_hash ? $activate_hash : true;
    }

    /**
     * Admin specific activation function for admin approvals or re-activation.
     *
     * @param int $user_id The user ID to activate.
     *
     * @return bool True on success, false on error.
     */
    public function admin_activation($user_id = false)
    {
        if ($user_id === false) {
            $this->error = lang('us_err_no_id');
            return false;
        }

        $query = $this->db->select('id')
                      ->where('id', $user_id)
                      ->limit(1)
                      ->get($this->table_name);

        if ($query->num_rows() !== 1) {
            $this->error = lang('us_err_no_matching_id');
            return false;
        }

        $result = $query->row();

        $this->update($result->id, array('activate_hash' => '', 'active' => 1));
        if ($this->db->affected_rows() > 0) {
            return $result->id;
        }

            $this->error = lang('us_err_user_is_active');
        return false;
    }

    /**
     * Admin only deactivation function.
     *
     * @param int $user_id The user ID to deactivate.
     *
     * @return boolean True on success, false on error.
     */
    public function admin_deactivation($user_id = false)
    {
        if ($user_id === false) {
            $this->error = lang('us_err_no_id');
            return false;
        }

        if ($this->deactivate($user_id, 'id', false)) {
            return $user_id;
        }

            $this->error = lang('us_err_user_is_inactive');
        return false;
    }

    /**
     * Count Inactive users.
     *
     * @return int Inactive user count.
     */
    public function count_inactive_users()
    {
        $this->db->where('active', -1);
        return $this->count_all(false);
    }

    /**
     * Configure activation for the given user based on current user_activation_method.
     *
     * @param number $user_id User's ID.
     *
     * @return array A 'message' (string) and 'error' (boolean, true if an error
     * occurred sending the activation email).
     */
    public function set_activation($user_id)
    {
        // User activation method
        $activation_method = $this->settings_lib->item('auth.user_activation_method');

        // Prepare user messaging vars
        $emailMsgData   = array();
        $emailView      = '';
        $subject        = '';
        $email_mess     = '';
        $message        = lang('us_email_thank_you');
        $type           = 'success';
        $site_title     = $this->settings_lib->item('site.title');
        $error          = false;
        $ccAdmin      = false;

        switch ($activation_method) {
            case 0:
                // No activation required.
                // Activate the user and send confirmation email.
                $subject = str_replace(
                    '[SITE_TITLE]',
                    $this->settings_lib->item('site.title'),
                    lang('us_account_reg_complete')
                );

                $emailView  = '_emails/activated';
                $message    .= lang('us_account_active_login');

                $emailMsgData = array(
                    'title' => $site_title,
                    'link'  => site_url(),
                );
                break;
            case 1:
                // Email Activiation.
                // Run the account deactivate to assure everything is set correctly.
                $activation_code    = $this->deactivate($user_id);

                // Create the link to activate membership
                $activate_link = site_url("activate/{$user_id}");
                $subject            =  lang('us_email_subj_activate');
                $emailView          = '_emails/activate';
                $message            .= lang('us_check_activate_email');

                $emailMsgData = array(
                    'title' => $site_title,
                    'code'  => $activation_code,
                    'link'  => $activate_link
                );
                break;
            case 2:
                // Admin Activation.
                $ccAdmin   = true;
                $subject    =  lang('us_email_subj_pending');
                $emailView  = '_emails/pending';
                $message    .= lang('us_admin_approval_pending');

                $emailMsgData = array(
                    'title' => $site_title,
                );
                break;
        }

        $email_mess = $this->load->view($emailView, $emailMsgData, true);

        // Now send the email
        $this->load->library('emailer/emailer');
        $data = array(
            'to'        => $this->find($user_id)->email,
            'subject'   => $subject,
            'message'   => $email_mess,
        );

        if ($this->emailer->send($data)) {
            // If the message was sent successfully and the admin must be notified
            // (Admin Activation is enabled), send another email to the system_email.
            if ($ccAdmin) {
                /**
                 * @todo Add a setting to allow the user to change the email address
                 * of the recipient of this message.
                 *
                 * @todo Add CC/BCC capabilities to emailer, so this doesn't require
                 * sending a second email.
                 */
                $data['to'] = $this->settings_lib->item('system_email');
                if (! empty($data['to'])) {
                    $this->emailer->send($data);
                }
            }
        } else {
            // If the message was not sent successfully, set an error message.
            $message    .= lang('us_err_no_email') . $this->emailer->error;
            $error      = true;
        }

        return array('message' => $message, 'error' => $error);
    }

    // -------------------------------------------------------------------------
    // Misc. Methods.
    // -------------------------------------------------------------------------

    /**
     * Return the most recent login attempts.
     *
     * @param integer $limit The maximum number of results to return.
     *
     * @return boolean|array An array of objects with the login attempts, or false.
     */
    public function get_login_attempts($limit = 15)
    {
        $this->db->limit($limit)
                 ->order_by('login', 'desc');

        $query = $this->db->get('login_attempts');
        if ($query->num_rows()) {
            return $query->result();
        }

        return false;
    }

    public function is_valid_teacher($teacher_id)
    {
        $this->db->select("email");
        $this->db->from('users');
        $this->db->join($this->applications_table, "users.id = {$this->applications_table}.user_id");
        $this->db->join($this->public_profile_table, "users.id = {$this->public_profile_table}.user_id", 'left outer');
        $this->db->where(array("{$this->table_name}.id" => $teacher_id, 'user_type'=>'teacher', 'deleted'=> '0', 'banned'=>'0', 'active'=>'1', 'status' => APPLICATION_STATUS_APPROVED, "{$this->public_profile_table}.approved" => '1' ));
 
        $check = $this->db->get();
        $check_rows = $check->num_rows();

        if ($check_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Set the select and join portions of the SQL query for the find* methods.
     *
     * @todo Set this in the before_find observer?
     *
     * @return void
     */
    protected function preFind()
    {
        if (empty($this->selects)) {
            $this->select("{$this->table_name}.*, role_name");
        }

        $this->db->join(
            $this->roles_table,
            "{$this->roles_table}.role_id = {$this->table_name}.role_id",
            'left'
        );
    }
    
     public function fb_user($data = array()){
        
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where(array('email'=>$data['email']));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        $update_data = array();
        if($prevCheck > 0){            
            $update_data['last_login'] = date("Y-m-d H:i:s");
            $update = $this->db->update('users',$update_data,array('id'=>$data['id']));
            $userID = $data['id'];
        }else{
            $data['created_on'] = date("Y-m-d H:i:s");
            $data['last_login'] = date("Y-m-d H:i:s");
            $insert = $this->db->insert('users',$data);
            $userID = $this->db->insert_id();
        }
        return $userID?$userID:FALSE;
    }
    
    
    public function check_user($email){
        
        $this->db->select('id,password_hash,email');
        $this->db->from('users');
        $this->db->where(array('email'=>$email));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){
            $return = $prevQuery->row();
        }
        else{
            $return = array();
        }
        return $return;
    }


    public function get_teachers() {
        
        $this->load->helper('zoom');

        $this->db->select("{$this->table_name}.id, email");
        $this->db->from('users');
        $this->db->join($this->applications_table, "users.id = {$this->applications_table}.user_id");
        $this->db->join($this->public_profile_table, "users.id = {$this->public_profile_table}.user_id", 'left outer');
        $this->db->where(array('user_type'=>'teacher', 'deleted'=> '0', 'banned'=>'0', 'active'=>'1', 'status' => APPLICATION_STATUS_APPROVED, "{$this->public_profile_table}.approved" => '1' ));
        $this->db->order_by("display_order", "ASC"); 
        
        $query = $this->db->get();
        $result = $query->result_array();

        $result = array_map("unserialize", array_unique(array_map("serialize", $result)));
        $all_teachers = array();
        $count = 0;

        for ($i=0; $i <= sizeof($result) ; $i++) { 

            if (isset($result[$i]['id'])) {
                if ($this->teacher_has_slots($result[$i]['id'])) {
                    $all_teachers[$count] =  $result[$i];
                    $all_teachers[$count]['details'] =  $this->load_teacher_profile($result[$i]['id']);
                    $count++;
                }
            }
        }

        if (sizeof($all_teachers) === 0) {
            return false;
        } else {
            return $all_teachers;
        }
    }
    
    public function teacher_in_selected_daterange($teacher_id='',$start_datetime='',$end_datetime=''){
        
        $start_date = strtotime($start_datetime);
        $start_datetime = date('Y-m-d H:i:s', $start_date);
        
        $end_date = strtotime($end_datetime);
        $end_datetime = date('Y-m-d H:i:s', $end_date);
        
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where('available_slot', '1');
        $this->db->from($this->teacher_availability_table);
        $this->db->where("CONCAT(available_start_date,' ',available_start_time) >= ",$start_datetime);
        $this->db->where("CONCAT(available_end_date,' ',available_end_time) <= ",$end_datetime);
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count > 0) {
            return true;
        } else {
            return false;    
        }
    }
    
    public function check_is_teacher_available($teacher_id){
        $current_date_time = date("Y-m-d H:i:s");
        $this->db->where('teacher_id', $teacher_id);
        $this->db->where('available_slot', '1');
        $this->db->from($this->teacher_availability_table);
        $this->db->where("CONCAT(available_start_date,' ',available_start_time) > ",$current_date_time);
        $query_2 = $this->db->get();
        $count_2 = $query_2->num_rows();
        if($count_2 > 0){
            return true;
        }
        else{
            return false;    
        }
    }

    // check to see if the teacher has any 
    // available slots for booking in the future
    public function teacher_has_slots($teacher_id) {

        $today = date('Y-m-d');

        $this->db->where('teacher_id', $teacher_id);
        $this->db->where('available_slot', '1');
        $this->db->where('available_start_date >=', $today);
        $this->db->from($this->teacher_availability_table);

        $count = $this->db->count_all_results();

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function load_teacher_profile($teacher_id) {

        $result = array();

        // Get user meta
        $result['meta'] = $this->find_user_and_meta($teacher_id);

        // Get public profile
        $this->db->select("*");
        $this->db->from($this->public_profile_table);
        $this->db->where(array('user_id' => $teacher_id, 'approved' => '1'));
        $this->db->order_by("id", "desc");
        $this->db->limit('1');
        
        $pp_query = $this->db->get();
        $result['public_profile'] = $pp_query->row();

        $this->db->select("answer");
        $this->db->from($this->application_answers_table);
        $this->db->where(array('user_id' => $teacher_id, 'question_id' => '2'));
        $this->db->order_by("application_id", "DESC"); 
        $this->db->limit('1');
        $s_date_query = $this->db->get();
        $result['available_start_date'] = $s_date_query->row();

        $result['avatar'] = $this->get_avatar($teacher_id);

        return $result;
    }

    public function get_resume($user_id){
        
        $this->db->select('resume, created_on');
        $this->db->from('resumes');
        $this->db->where(array('user_id'=>$user_id));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){

            $return = $prevQuery->row();
            $return->resume_path = 'uploads/resumes/' . $user_id . '/'. $return->resume;

        } else {
            $return = array();
        }
        return $return;
    }

    public function get_avatar($user_id){
        
        $this->db->select('avatar');
        $this->db->from($this->public_profile_table);
        $this->db->where(array('user_id'=>$user_id));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){

            $return = $prevQuery->row();

            if (empty($return->avatar)) {
                $return = array();
            } else {
                $return = 'uploads/avatars/' . $user_id . '/'. $return->avatar;
            }
            
        } else {
            $return = array();
        }
        return $return;
    }
    
    
    public function get_user_by_search($params = array())
    {
        
        $retun_array = array();
        
        $search_data = !empty($params['search_data'])?$params['search_data']:'';
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $select = "SELECT id FROM `bf_users` WHERE `email` like '%".$search_data."%' ORDER BY id ASC LIMIT ".$params['limit']." OFFSET ".$params['start'];
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $select = "SELECT id FROM `bf_users` WHERE `email` like '%".$search_data."%' ORDER BY id ASC LIMIT ".$params['limit'];    
        }
        else{
            $select = "SELECT id FROM `bf_users` WHERE `email` like '%".$search_data."%' ORDER BY id ASC";
        }
        
        
        $query = $this->db->query($select);
        
        $rowcount = $query->num_rows();
        
        $result = $query->result_array();
        if(!empty($result)){
            $retun_array['result'] = $result;
            $retun_array['rowcount'] = $rowcount;
            return $retun_array;
        }else{
            
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $select = "SELECT user_id FROM `bf_user_meta` WHERE (`meta_key` = 'first_name' AND `meta_value` LIKE '%".$search_data."%') OR (`meta_key` = 'last_name' AND `meta_value` LIKE '%".$search_data."%') ORDER BY user_id ASC LIMIT ".$params['limit']." OFFSET ".$params['start'];
            }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                $select = "SELECT user_id FROM `bf_user_meta` WHERE (`meta_key` = 'first_name' AND `meta_value` LIKE '%".$search_data."%') OR (`meta_key` = 'last_name' AND `meta_value` LIKE '%".$search_data."%') ORDER BY user_id ASC LIMIT ".$params['limit'];    
            }
            else{
                $select = "SELECT user_id FROM `bf_user_meta` WHERE (`meta_key` = 'first_name' AND `meta_value` LIKE '%".$search_data."%') OR (`meta_key` = 'last_name' AND `meta_value` LIKE '%".$search_data."%') ORDER BY user_id ASC";
            }
            
            $query = $this->db->query($select);
            $result = $query->result_array();
            $rowcount = $query->num_rows();
            if(!empty($result)){
                $retun_array['result'] = $result;
                $retun_array['rowcount'] = $rowcount;
                return $retun_array;
            }else{
                //$result = '';
                return $retun_array;
            }
               
        }
    }

    // Deprecated function. Use get_next_class in student subscriptions model
    // $count is ignored for now
    public function get_next_classes($student_id, $count = 3) {

        $this->load->model('student_subscriptions/student_subscriptions_model');

        return $this->student_subscriptions_model->get_next_class($student_id);
        
    }   


    public function get_all_user($params = array())
    {
        $retun_array = array();
        if(array_key_exists("user_filter",$params)){
            $user_filter = $params['user_filter'];    
        }
        
        if(!empty($user_filter)){
            switch ($user_filter) {
                case 'inactive':
                    $where = 'active = 0';
                    break;
                case 'banned':
                    $where = 'banned = 1';
                    break;
                case 'deleted':
                    $where = 'deleted = 1';
                    break;
                case 'teachers':
                    $where = 'user_type = "teacher"';
                    break;
                case 'students':
                    $where = 'user_type = "student"';
                    break;
                case 'all':
                    $where = '';
                    break;
                default:
                    $where = '';
                    
            }
        }
        
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            if(!empty($where)){
                $select = "SELECT id FROM `bf_users` WHERE ".$where." ORDER BY id ASC LIMIT ".$params['limit']." OFFSET ".$params['start'];    
            }
            else{
                $select = "SELECT id FROM `bf_users` ORDER BY id ASC LIMIT ".$params['limit']." OFFSET ".$params['start'];
            }
            
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            if(!empty($where)){
                $select = "SELECT id FROM `bf_users` WHERE ".$where." ORDER BY id ASC LIMIT ".$params['limit'];    
            }
            else{
                $select = "SELECT id FROM `bf_users` ORDER BY id ASC LIMIT ".$params['limit'];
            }
                
        }
        else{
            if(!empty($where)){
                $select = "SELECT id FROM `bf_users` WHERE ".$where." ORDER BY id ASC";    
            }else{
                $select = "SELECT id FROM `bf_users` ORDER BY id ASC";
            }
            
        }
        
        //$select = "SELECT id FROM `bf_users` ORDER BY id ASC LIMIT ".$params['limit'];
        $query = $this->db->query($select);
        
        $rowcount = $query->num_rows();
        
        $result = $query->result_array();
        if(!empty($result)){
            $retun_array['result'] = $result;
            $retun_array['rowcount'] = $rowcount;
            return $retun_array;
        }
        else{
            return $retun_array;
        }
    }
    
    public function update_profile_views($user_id) {
        
        $this->db->select('meta_value');
        $this->db->from($this->meta_table);
        $this->db->where(array('user_id'=>$user_id, 'meta_key' => META_KEY_PROFILE_VIEW));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){

            $return = $prevQuery->row();
            $new_count = intval($return->meta_value) + 1;

            $data = array(
                           'meta_value' => $new_count
                        );

            $this->db->where('user_id', $user_id);
            $this->db->where('meta_key', META_KEY_PROFILE_VIEW);
            $this->db->update($this->meta_table, $data); 

        } else {

            // doesnt exist so insert new view
            $data = array(
               'user_id' => $user_id,
               'meta_key' => META_KEY_PROFILE_VIEW,
               'meta_value' => '1'
            );

            $this->db->insert($this->meta_table, $data); 
        }

        return true;
    }    

    public function get_profile_views($user_id) {
        
        $this->db->select('meta_value');
        $this->db->from($this->meta_table);
        $this->db->where(array('user_id'=>$user_id, 'meta_key' => META_KEY_PROFILE_VIEW));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){
            return intval($return->meta_value);
        } else {
            return 0;
        }
    }    

    public function check_referrer_code_exists($code) {

        $this->db->select('*');
        $this->db->from($this->meta_table);
        $this->db->where(array('meta_value'=>$code));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){
           return true;   
        } else {
            return false;
        }
    }

    public function generate_user_referrer_code($user_id) {

        $code = generate_referral_code(REFERRAL_CODE_LENGTH);
        if ($this->check_referrer_code_exists($code)) {
            
            // code used so try new one
            $this->generate_user_referrer_code($user_id);

        }  else {

            // clear old referral codes (there should be any but just in case)
            $this->db->where('user_id', $user_id);
            $this->db->where('meta_key', REFERRAL_CODE_USER_META);
            $this->db->delete($this->meta_table); 

            $this->db->flush_cache();

            $data = array(
               'user_id' => $user_id,
               'meta_key' => REFERRAL_CODE_USER_META,
               'meta_value' => $code
            );

            $this->db->insert($this->meta_table, $data); 
            return $code;
        }

    }

    // checks if the pro user has slot available for lesson time
    // so that we dont double book slots in zoom
    public function pro_user_slot_available($zoom_email, $class_start_date, $class_start_time) {

        $this->db->select('*');
        $this->db->from($this->class_schedules_table);
        $this->db->where(array('zoom_owner' => $zoom_email, 'class_start_date' => $class_start_date, 'class_start_time' => $class_start_time, 'status' => CLASS_STATUS_BOOKED));
        $prevQuery = $this->db->get();

        $prevCheck = $prevQuery->num_rows();
        
        if($prevCheck > 0){
           return false;   
        } else {
            return true;
        }

    }

    public function get_pro_zoom_account($class_start_date, $class_start_time) {

        $this->load->config('zoom_pro_list');

        $zoom_pro_accounts = $this->config->item('_zoom_pro_accounts');
        $number_accounts = sizeof($zoom_pro_accounts);
        foreach($zoom_pro_accounts as $key => $value) {
            if ($this->pro_user_slot_available($value['email'], $class_start_date, $class_start_time)) {
                return $value;
            }            
        }

        return $zoom_pro_accounts[0];
    }

    public function get_future_classes($class_id) {

        $this->db->select('*');
        $this->db->from($this->class_schedules_table);
        $this->db->where(array('id' => $class_id));
        $query = $this->db->get();

        $check = $query->num_rows();
        
        if($check > 0){

            // get all classes with start after current class
            $result = $query->result_array();
            $class_start_date = $result[0]['class_start_date'];
            $class_start_time = $result[0]['class_start_time'];

            $sql = "SELECT id, curriculum_id, calendar_event_id FROM bf_class_schedules WHERE status = ". CLASS_STATUS_BOOKED ." AND student_id = " .$result[0]['student_id']. " AND ((class_start_date > '".$class_start_date."') OR (class_start_date = '".$class_start_date."' AND class_start_time > '".$class_start_time."')) ORDER BY curriculum_id ASC";

            $next_query = $this->db->query($sql);
            $result = $next_query->result_array();
            return $result;

        } else {
            return false;   
        }
    }

    public function reset_googlecal_future_classes($base_class_id) {

        $classes_for_update = $this->get_future_classes($base_class_id);

        $this->load->library('googleapi');

        $target_time_zone = new DateTimeZone(date_default_timezone_get());
        $date_time = new DateTime('now', $target_time_zone);
        $gmt_timezone = $date_time->format('P');
        $calendarId = $this->config->item('calendar_id');

        foreach ($classes_for_update as $class) {

            $this->calendarapi = new Google_Service_Calendar($this->googleapi->client());

            $this->db->select('*');
            $this->db->from('class_schedules');
            $this->db->where(array('id'=>$class['id']));
            
            $prevClassQuery = $this->db->get();
            $prevClassCheck = $prevClassQuery->num_rows();
            $resultClass = $prevClassQuery->result_array();
            $calendar_event_id = $resultClass[0]['calendar_event_id'];
            
            if (empty($calendar_event_id) === false) {

                $teacher_id = $resultClass[0]['teacher_id'];
                $student_id = $resultClass[0]['student_id'];
                $zoom_url = $resultClass[0]['zoom_url'];

                $teacher_meta = $this->user_model->find_user_and_meta($teacher_id); 
                $teacher_name = @$teacher_meta->first_name . " " . @$teacher_meta->last_name;

                $student_meta = $this->user_model->find_user_and_meta($student_id); 
                $student_name = @$student_meta->first_name . " " . @$student_meta->last_name;
                
                $curriculum_details = $this->curriculum_model->load_curriculum_details($class['curriculum_id']);
                $title_html = 'EG-'.$class['id'].' ['.$student_name.'-'.$teacher_name.' - '.$zoom_url.'] '.$curriculum_details['topic']; 

                $event = $this->calendarapi->events->get($calendarId, $calendar_event_id);
                
                $event->setSummary($title_html);
                $optionalArguments = array("sendUpdates"=>"none");
                $this->calendarapi->events->update($calendarId, $calendar_event_id, $event, $optionalArguments);
            }
        }

    }
}
//end User_model
