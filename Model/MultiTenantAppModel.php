<?php

App::uses('Model','Model');

class MultiTenantAppModel extends Model{

	public function __construct($id = false, $table = null, $ds = null) {
		$currentTenantConfig = Configure::read('Config.multi_tenant_config');
		parent::__construct($id,$table,$currentTenantConfig[Configure::read('Config.current_tenant')]['connection_name']);
		$this->useDbConfig = $currentTenantConfig[Configure::read('Config.current_tenant')]['connection_name'];
	}	

}