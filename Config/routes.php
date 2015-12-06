<?php

App::uses('MultiTenantRouter','CakeMultiTenant.Lib/Routing/Route');


$plugins = CakePlugin::loaded();
$pluginMatchs = array_map(array('Inflector', 'underscore'), $plugins);

foreach ($pluginMatchs as $key => $pluginMatch) {
	Router::connect(
		"/:current_tenant/admin/{$pluginMatch}/:controller",
		array(
				'prefix' => 'admin',
				'admin' => true,
				'plugin' => $pluginMatch
			),
		array(
			'current_tenant' => '[a-z]{1,10}',
			'routeClass' => 'MultiTenantRouter'
			)
		);

	Router::connect(
		"/:current_tenant/admin/{$pluginMatch}/:controller/:action/*",
		array(
				'prefix' => 'admin',
				'admin' => true,
				'plugin' => $pluginMatch
			),
		array(
			'current_tenant' => '[a-z]{1,10}',
			'routeClass' => 'MultiTenantRouter'
			)
		);

	Router::connect(
		"/:current_tenant/{$pluginMatch}/:controller",
		array(
				'plugin' => $pluginMatch
			),
		array(
			'current_tenant' => '[a-z]{1,10}',
			'routeClass' => 'MultiTenantRouter'
			)
		);

	Router::connect(
		"/:current_tenant/{$pluginMatch}/:controller/:action/*",
		array(
				'plugin' => $pluginMatch
			),
		array(
			'current_tenant' => '[a-z]{1,10}',
			'routeClass' => 'MultiTenantRouter'
			)
		);
}


Router::connect(
	"/:current_tenant/admin/:controller/:action/*",
	array(
		'prefix' => 'admin',
		'admin' => true,
		),
	array(
		'current_tenant' => '[a-z]{1,10}',
		'routeClass' => 'MultiTenantRouter'
		)
	);

Router::connect(
    '/:current_tenant/login',
    [
        'controller' => 'users',
        'action' => 'login',
        'admin' => true,
        'plugin' => false,
    ],
	array(
		'current_tenant' => '[a-z]{1,10}',
		'routeClass' => 'MultiTenantRouter'
		)
);

Router::connect(
    '/:current_tenant/logout',
    [
        'controller' => 'users',
        'action' => 'logout',
        'admin' => true,
        'plugin' => 'users',
    ],
	array(
		'current_tenant' => '[a-z]{1,10}',
		'routeClass' => 'MultiTenantRouter'
		)
);
Router::connect(
	"/:current_tenant/admin/:controller",
	array(
		'prefix' => 'admin',
		'admin' => true,
		'plugin'=>false
		),
	array(
		'current_tenant' => '[a-z]{1,10}',
		'routeClass' => 'MultiTenantRouter'
		)
	);

Router::connect(
	"/:current_tenant/admin/:controller/:action/*",
	array(
		'prefix' => 'admin',
		'admin' => true
		),
	array(
		'current_tenant' => '[a-z]{1,10}',
		'routeClass' => 'MultiTenantRouter'
		)
	);


Router::connect(
	'/:current_tenant/pages/*',
	array(
		'controller' => 'pages',
		'action' => 'display'
		),
	array(
		'current_tenant' => '[a-z]{1,3}',
		'routeClass' => 'MultiTenantRouter'
		)
	);

Router::connect(
    '/:current_tenant/',
    array(
        'controller' => 'products',
        'action' => 'index',
        'admin' => true,
	array(
		'current_tenant' => '[a-z]{1,10}',
		'routeClass' => 'MultiTenantRouter'
		)
    )
);

Router::redirect(
    '/',
    array(
    	'controller' => 'products',
    	'action' => 'index',
    	'admin' => true
    )
);
