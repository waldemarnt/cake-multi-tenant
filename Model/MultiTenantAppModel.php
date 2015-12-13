<?php

App::uses('Model', 'Model');
App::uses('DataSourceTenant', 'Lib/DataSource');

class MultiTenantAppModel extends Model
{
    public function __construct($id = false, $table = null, $ds = null)
    {
        DataSourceTenant::initDatasources();
        $currentTenantConfig = Configure::read('Config.multi_tenant_config');
        parent::__construct($id, $table, $currentTenantConfig[Configure::read('Config.current_tenant')]['connection_name']);
        $this->useDbConfig = $currentTenantConfig[Configure::read('Config.current_tenant')]['connection_name'];
    }
}
