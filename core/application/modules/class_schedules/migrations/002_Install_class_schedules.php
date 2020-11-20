<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_class_schedules extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'class_schedules';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'available_start_date' => array(
            'type'       => 'DATE',
            'null'       => false,
            'default'    => '0000-00-00',
        ),
        'available_start_time' => array(
            'type'       => 'TIME',
            'null'       => false,
        ),
        'available_end_date' => array(
            'type'       => 'DATE',
            'null'       => false,
            'default'    => '0000-00-00',
        ),
        'available_end_time' => array(
            'type'       => 'TIME',
            'null'       => false,
        ),
        'teacher_id' => array(
            'type'       => 'INT',
            'null'       => false,
        ),
        'student_id' => array(
            'type'       => 'INT',
            'null'       => true,
        ),
        'curriculum_id' => array(
            'type'       => 'INT',
            'null'       => true,
        ),
        'is_peak_period' => array(
            'type'       => 'TINYINT',
            'null'       => false,
        ),
        'zoom_url' => array(
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => true,
        ),
        'status' => array(
            'type'       => 'INT',
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