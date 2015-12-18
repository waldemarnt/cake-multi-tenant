<?php
class AddEmailsTable extends CakeMigration {

/**
 * Migration description
 *
 * @var string
 */
	public $description = 'add_emails_table';

/**
 * Actions to be performed
 *
 * @var array $migration
 */
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'emails' => array(
					'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
					'host' => array('type' => 'string', 'null' => false),
					'port' => array('type' => 'string', 'null' => false),
					'from_email' => array('type' => 'string', 'null' => false),
					'from_title' => array('type' => 'string', 'null' => false),
					'timeout' => array('type' => 'integer', 'null' => false),
					'username' => array('type' => 'string', 'null' => false),
					'password' => array('type' => 'string', 'null' => false),
					'transport' => array('type' => 'string', 'null' => false),
					'tenant_id' => array('type' => 'integer', 'null' => false),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
					),
					'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
				),
			),
		),
		'down' => array(
			'drop_table' => array(
				'emails',
			),
		),
	);

/**
 * Before migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function before($direction) {
		return true;
	}

/**
 * After migration callback
 *
 * @param string $direction Direction of migration process (up or down)
 * @return bool Should process continue
 */
	public function after($direction) {
		return true;
	}
}
