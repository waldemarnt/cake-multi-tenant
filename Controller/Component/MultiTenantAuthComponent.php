<?php

App::uses('AuthComponent', 'Controller/Component');

class MultiTenantAuthComponent extends AuthComponent
{
    public function initialize(Controller $controller)
    {
        parent::initialize($controller);
        $currentTenant = Configure::read('Config.current_tenant');
        $this->loginRedirect['current_tenant'] = $currentTenant;
        $this->loginAction['current_tenant'] = $currentTenant;
        $this->logoutRedirect['current_tenant'] = $currentTenant;
    }
}
