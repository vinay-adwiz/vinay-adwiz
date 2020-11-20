<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_payment extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'payment';

	/**
	 * @var array The table's fields
	 */
	private $fields = array(
		'id' => array(
			'type'       => 'INT',
			'constraint' => 11,
			'auto_increment' => true,
		),
        'subscription_id' => array(
            'type'       => 'INT',
            'null'       => false,
        ),
        'reference_number' => array(
            'type'       => 'VARCHAR',
            'constraint' => 16,
            'null'       => false,
        ),
        'payment_status' => array(
            'type'       => 'CHAR',
            'constraint' => 3,
            'null'       => false,
        ),
        'amount' => array(
            'type'       => 'DECIMAL',
            'constraint' => '13,2',
            'null'       => false,
        ),
        'currency' => array(
            'type'       => 'CHAR',
            'constraint' => 3,
            'null'       => false,
        ),
        'reference_date' => array(
            'type'       => 'CHAR',
            'constraint' => 16,
            'null'       => false,
        ),
        'transaction_number' => array(
            'type'       => 'VARCHAR',
            'constraint' => 64,
            'null'       => true,
        ),
        'approval_code' => array(
            'type'       => 'VARCHAR',
            'constraint' => 32,
            'null'       => true,
        ),
        'transaction_date' => array(
            'type'       => 'CHAR',
            'constraint' => 16,
            'null'       => true,
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