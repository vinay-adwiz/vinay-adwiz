<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_cancellations extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'cancellations';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'user_id' => array(
            'type'       => 'INT',
            'null'       => false,
        ),
        'cancellation_reason' => array(
            'type'       => 'TEXT',
            'null'       => false,
        ),
        'is_refunded' => array(
            'type'       => 'TINYINT',
            'null'       => false,
        ),
        'refund_date' => array(
            'type'       => 'DATETIME',
            'null'       => false,
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