# Multi tenant CakePHP (2.x) Plugin

The *Multi Tenant* plugin allows an application to be separated in several applications having own routes, sharing the same code and different databases (or the same).

##Installing


##Configuration

###bootstrap.php configuration

Just call the plugin **below the Dispatch** configuration in your boostrap, enable routes and boostrap.

```sh
    CakePlugin::load('MultiTenant', array('routes' => true, 'bootstrap' => true));
```
###core.php configuration
In the core file you will need add the several properties.
Current tenant (or default).

```php
    Configure::write('Config.current_tenant', 'example');
```
Note: current tenant will be the active tenant, you can use this information to know which tenant is active.

Tenant configuration will be an array using the tenant name as a index and **connection_name** will be the name of database connection that the tenant will use.
```php
    Configure::write('Config.multi_tenant_config', [
            'example' => [
                'name' => 'Example Tenant',
                'connection_name' => 'my_custom_db_connection'
            ],
            'waldemar' => [
                'name' => 'Waldemar',
                'connection_name' => 'my_other_db_connection'
            ]
        ]
    );
```
###database.php configuration
In the database file you just need add the configuration for each tenant like this:

```php
	public $my_custom_db_connection = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '172.17.0.3',
		'login' => 'root',
		'password' => 'root',
		'database' => 'db_one',
		'prefix' => '',
		//'encoding' => 'utf8',
	);

	public $my_other_db_connection = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '172.17.0.3',
		'login' => 'root',
		'password' => 'root',
		'database' => 'db_two',
		'prefix' => '',
		//'encoding' => 'utf8',
	);
```

### AppModel.php configuration
Just extend your AppModel from MultiTenantAppModel, the MultiTenantAppModel that handles the database switch when the model will be created.
```php
    App::uses('MultiTenantAppModel', 'MultiTenant.Model');

    class AppModel extends MultiTenantAppModel {
    
    }
```
###AppController.php
In the AppController you will need configure two stuffs, **Html Helper** and **AuthComponent** (if you need auth :D).
Html helper configuration:
```php
    
    public $helpers = array(
        'Html' => array('className' => 'MultiTenant.MultiTenantHtml'),
    );
```
AuthComponent configuration:
```php
    public $components = array(
        'Auth' => [
			'className' => 'MultiTenant.MultiTenantAuth'
    );
```
Note: you can add loginAction and LoginRedirect configurations in the Auth component there's no change in the original behavior of the component.

### Version
0.*


