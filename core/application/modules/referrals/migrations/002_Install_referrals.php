<?php defined('BASEPATH') || exit('No direct script access allowed');

class Migration_Install_referrals extends Migration
{
	/**
	 * @var string The name of the database table
	 */
	private $table_name = 'referrals';

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
        'referrer_id' => array(
            'type'       => 'INT',
            'null'       => false,
        ),
        'signup_date' => array(
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