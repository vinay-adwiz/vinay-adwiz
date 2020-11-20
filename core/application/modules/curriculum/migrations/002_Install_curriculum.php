<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_curriculum extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'curriculum';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'curriculum_unit' => array(
            'type'       => 'INT',
            'null'       => false,
        ),
        'lesson_number' => array(
            'type'       => 'INT',
            'null'       => true,
        ),
        'topic' => array(
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => false,
        ),
        'phrases' => array(
            'type'       => 'VARCHAR',
            'constraint' => 1000,
            'null'       => true,
        ),
        'vocabulary' => array(
            'type'       => 'VARCHAR',
            'constraint' => 1000,
            'null'       => true,
        ),
        'previous_lesson' => array(
            'type'       => 'INT',
            'null'       => true,
        ),
        'active' => array(
            'type'       => 'TINYINT',
            'null'       => true,
        ),
        'created_on' => array(
            'type'       => 'datetime',
            'default'    => '0000-00-00 00:00:00',
        ),
        'modified_on' => array(
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