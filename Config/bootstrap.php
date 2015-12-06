
<?php 

App::uses('MultiTenantDispatcher', 'CakeMultiTenant.Lib/Dispatcher');

$currentFilters = Configure::read('Dispatcher.filters');
$multiTenantFilter['multiTenantFilter'] = array(
    'callable' => array(new MultiTenantDispatcher(), 'init'),
    'on' => 'before',
);

$currentFilters = array_merge($currentFilters, $multiTenantFilter);
Configure::write('Dispatcher.filters', $currentFilters);

Configure::write('Session', array(
     'defaults' => 'php',
     'cookie' => Configure::read('Config.current_tenant'),
     )
 );
