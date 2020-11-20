<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_plans extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'plans';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'name' => array(
            'type'       => 'VARCHAR',
            'constraint' => 64,
            'null'       => false,
        ),
        'price' => array(
            'type'       => 'INT',
            'null'       => false,
        ),
        'number_classes' => array(
            'type'       => 'INTEGER',
            'null'       => false,
        ),
        'created_on' => array(
            'type'       => 'datetime',
            'default'    => '0000-00-00 00:00:00',
        ),
	);

	/**
	 * Install this version
	 *
	 * @return void
	 */
	public function up()
	{
		$this->dbforge->add_field($this->fields);
		$this->dbforge->add_key('id', true);
		$this->dbforge->create_table($this->table_name);
	}

	/**
	 * Uninstall this version
	 *
	 * @return void
	 */
	public function down()
	{
		$this->dbforge->drop_table($this->table_name);
	}
}