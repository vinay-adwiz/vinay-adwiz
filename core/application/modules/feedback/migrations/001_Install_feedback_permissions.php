<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_feedback_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Feedback.Content.View',
			'description' => 'View Feedback Content',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Content.Create',
			'description' => 'Create Feedback Content',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Content.Edit',
			'description' => 'Edit Feedback Content',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Content.Delete',
			'description' => 'Delete Feedback Content',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Reports.View',
			'description' => 'View Feedback Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Reports.Create',
			'description' => 'Create Feedback Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Reports.Edit',
			'description' => 'Edit Feedback Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Reports.Delete',
			'description' => 'Delete Feedback Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Settings.View',
			'description' => 'View Feedback Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Settings.Create',
			'description' => 'Create Feedback Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Settings.Edit',
			'description' => 'Edit Feedback Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Settings.Delete',
			'description' => 'Delete Feedback Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Developer.View',
			'description' => 'View Feedback Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Developer.Create',
			'description' => 'Create Feedback Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Developer.Edit',
			'description' => 'Edit Feedback Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Feedback.Developer.Delete',
			'description' => 'Delete Feedback Developer',
			'status' => 'active',
		),
    );

    /**
     * @var string The name of the permission key in the role_permissions table
     */
    private $permissionKey = 'permission_id';

    /**
     * @var string The name of the permission name field in the permissions table
     */
    private $permissionNameField = 'name';

	/**
	 * @var string The name of the role/permissions ref table
	 */
	private $rolePermissionsTable = 'role_permissions';

    /**
     * @var numeric The role id to which the permissions will be applied
     */
    private $roleId = '6';

    /**
     * @var string The name of the role key in the role_permissions table
     */
    private $roleKey = 'role_id';

	/**
	 * @var string The name of the permissions table
	 */
	private $tableName = 'permissions';

	//--------------------------------------------------------------------

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$rolePermissionsData = array();
		foreach ($this->permissionValues as $permissionValue) {
			$this->db->insert($this->tableName, $permissionValue);

			$rolePermissionsData[] = array(
                $this->roleKey       => $this->roleId,
                $this->permissionKey => $this->db->insert_id(),
			);
		}

		$this->db->insert_batch($this->rolePermissionsTable, $rolePermissionsData);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
        $permissionNames = array();
		foreach ($this->permissionValues as $permissionValue) {
            $permissionNames[] = $permissionValue[$this->permissionNameField];
        }

        $query = $this->db->select($this->permissionKey)
                          ->where_in($this->permissionNameField, $permissionNames)
                          ->get($this->tableName);

        if ( ! $query->num_rows()) {
            return;
        }

        $permissionIds = array();
        foreach ($query->result() as $row) {
            $permissionIds[] = $row->{$this->permissionKey};
        }

        $this->db->where_in($this->permissionKey, $permissionIds)
                 ->delete($this->rolePermissionsTable);

        $this->db->where_in($this->permissionNameField, $permissionNames)
                 ->delete($this->tableName);
	}
}