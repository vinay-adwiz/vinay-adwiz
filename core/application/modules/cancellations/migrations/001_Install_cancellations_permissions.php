<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_cancellations_permissions extends Migration
{
	/**
	 * @var array Permissions to Migrate
	 */
	private $permissionValues = array(
		array(
			'name' => 'Cancellations.Content.View',
			'description' => 'View Cancellations Content',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Content.Create',
			'description' => 'Create Cancellations Content',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Content.Edit',
			'description' => 'Edit Cancellations Content',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Content.Delete',
			'description' => 'Delete Cancellations Content',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Reports.View',
			'description' => 'View Cancellations Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Reports.Create',
			'description' => 'Create Cancellations Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Reports.Edit',
			'description' => 'Edit Cancellations Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Reports.Delete',
			'description' => 'Delete Cancellations Reports',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Settings.View',
			'description' => 'View Cancellations Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Settings.Create',
			'description' => 'Create Cancellations Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Settings.Edit',
			'description' => 'Edit Cancellations Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Settings.Delete',
			'description' => 'Delete Cancellations Settings',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Developer.View',
			'description' => 'View Cancellations Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Developer.Create',
			'description' => 'Create Cancellations Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Developer.Edit',
			'description' => 'Edit Cancellations Developer',
			'status' => 'active',
		),
		array(
			'name' => 'Cancellations.Developer.Delete',
			'description' => 'Delete Cancellations Developer',
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