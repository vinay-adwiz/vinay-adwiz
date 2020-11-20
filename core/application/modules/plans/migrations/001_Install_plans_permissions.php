<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_plans_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Plans.Content.View',
			'description' => 'View Plans Content',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Content.Create',
			'description' => 'Create Plans Content',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Content.Edit',
			'description' => 'Edit Plans Content',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Content.Delete',
			'description' => 'Delete Plans Content',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Reports.View',
			'description' => 'View Plans Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Reports.Create',
			'description' => 'Create Plans Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Reports.Edit',
			'description' => 'Edit Plans Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Reports.Delete',
			'description' => 'Delete Plans Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Settings.View',
			'description' => 'View Plans Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Settings.Create',
			'description' => 'Create Plans Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Settings.Edit',
			'description' => 'Edit Plans Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Settings.Delete',
			'description' => 'Delete Plans Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Developer.View',
			'description' => 'View Plans Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Developer.Create',
			'description' => 'Create Plans Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Developer.Edit',
			'description' => 'Edit Plans Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Plans.Developer.Delete',
			'description' => 'Delete Plans Developer',
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