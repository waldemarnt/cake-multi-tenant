<?php

App::uses('DispatcherFilter', 'Routing');
App::uses('TenantHandler', 'MultiTenant.Lib/Tenant');

class MultiTenantDispatcher
{
    public function __construct()
    {
    }

    /**
     * @param CakeEvent $event
     *
     * Inject current tenant inside the CakeRequestObject
     *
     * @return CakeEvent
     */
    public function init(CakeEvent $event)
    {
        $request = $event->data['request'];
        $currentTenant = Configure::read('Config.current_tenant');
        $currentTenantConfig = Configure::read('Config.multi_tenant_config');
        if(!isset($currentTenantConfig[$request['current_tenant']]['connection_name'])) {
            throw new InvalidArgumentException("URL inválida, {$request['current_tenant']} não foi encontrado.");
        }

        if (isset($request['current_tenant'])) {
            $currentTenant = $request['current_tenant'];
        }
        define('CURRENT_TENANT', $currentTenant);
        $event->data['request']['current_tenant'] = $currentTenant;

        TenantHandler::setActiveTenant($currentTenant);

        Configure::write('Session', array(
            'defaults' => 'php',
            'cookie' => $currentTenant,
            ));

        return $event;
    }
}
