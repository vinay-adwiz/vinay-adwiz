<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_favorite_teachers extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'favorite_teachers';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'student_id' => array(
            'type'       => 'INT',
            'null'       => false,
        ),
        'teacher_id' => array(
            'type'       => 'BIGINT',
            'null'       => false,
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