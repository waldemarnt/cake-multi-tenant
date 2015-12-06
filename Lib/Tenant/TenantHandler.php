<?php


class TenantHandler
{
    public static function setActiveTenant($currentTenant = null)
    {
        if ($currentTenant) {
            Configure::write('Config.current_tenant', $currentTenant);
        }
    }

    public static function getActiveTenant()
    {
        $config = Configure::read('Unit.multi_tenant_config');
        if ($config) {
            return $config[Configure::read('Config.current_tenant')];
        } else {
            throw new Exception('Error Core.php file does not contain multi_tenant_config informations', 1);
        }
    }
}
