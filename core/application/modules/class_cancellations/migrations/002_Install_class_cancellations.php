<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_class_cancellations extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'class_cancellations';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'class_id' => array(
            'type'       => 'INT',
            'null'       => false,
        ),
        'cancelled_by' => array(
            'type'       => 'INT',
            'null'       => false,
        ),
        'cancellation_reason' => array(
            'type'       => 'BIGINT',
            'null'       => false,
        ),
        'chargeable' => array(
            'type'       => 'TINYINT',
            'null'       => false,
        ),
        'cencellation_date' => array(
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