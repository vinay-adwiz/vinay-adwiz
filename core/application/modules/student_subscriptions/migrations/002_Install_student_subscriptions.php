<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_student_subscriptions extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'student_subscriptions';

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
        'plan_id' => array(
            'type'       => 'INT',
            'null'       => false,
        ),
        'payment_id' => array(
            'type'       => 'INT',
            'null'       => true,
        ),
        'completion_date' => array(
            'type'       => 'DATETIME',
            'null'       => true,
            'default'    => '0000-00-00 00:00:00',
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