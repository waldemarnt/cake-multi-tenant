<?php
class TenantAdminTables extends CakeMigration
{
    /**
     * Migration description
     *
     * @var string
     */
    public $description = 'tenant_admin_tables';

    /**
     * Actions to be performed
     *
     * @var array $migration
     */
    public $migration = array(
        'up' => array(
            'create_table' => array(
                'tenants' => array(
                    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
                    'name' => array('type' => 'string', 'null' => false),
                    'connection_name' => array('type' => 'string', 'null' => false),
                    'indexes' => array(
                        'PRIMARY' => array('column' => 'id', 'unique' => 1),
                    ),
                    'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB'),
                ),
                'datasources' => array(
                    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
                    'name' => array('type' => 'string', 'null' => false),
                    'datasource' => array('type' => 'string', 'null' => false),
                    'password' => array('type' => 'string', 'null' => false),
                    'persistent' => array('type' => 'boolean', 'null' => false, 'default' => false),
                    'host' => array('type' => 'string', 'null' => false),
                    'login' => array('type' => 'string', 'null' => false),
                    'db' => array('type' => 'string', 'null' => false),
                    'prefix' => array('type' => 'string', 'null' => false),
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
                'tenants',
                'datasources'
            ),
        ),
    );
    /**
     * Before migration callback
     *
     * @param string $direction Direction of migration process (up or down)
     * @return bool Should process continue
     */
    public function before($direction)
    {
        return true;
    }

    /**
     * After migration callback
     *
     * @param string $direction Direction of migration process (up or down)
     * @return bool Should process continue
     */
    public function after($direction)
    {
        return true;
    }
}
