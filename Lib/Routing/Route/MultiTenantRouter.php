<?php


App::uses('CakeRoute', 'Routing/Route');

class MultiTenantRouter extends CakeRoute
{
    /**
     * Class name - Workaround to be able to extend this class without breaking existing features.
     *
     * @var string
     */
    public $name = __CLASS__;

    /**
     * Constructor for a Route.
     *
     * @param string $template Template string with parameter placeholders
     * @param array  $defaults Array of defaults for the route.
     * @param array  $options  Array of parameters and additional options for the Route
     *
     * @return \CakeRoute
     */
    public function __construct($template, $defaults = array(), $options = array())
    {
        if (strpos($template, ':current_tenant') === false && empty($options['disableAutoNamedLang'])) {
            Router::connect(
                $template,
                $defaults + array('current_tenant' => Configure::read('Config.current_tenant')),
                array('routeClass' => $this->name) + $options
            );
            $options += array('__promote' => true);
            $template = '/:current_tenant'.$template;
        }
        $options = array_merge((array) $options, array(
            'current_tenant' => '[a-z]{1,10}',
        ));

        if ($template == '/:current_tenant/') {
            $template = '/:current_tenant';
        }

		parent::__construct($template, $defaults, $options);
    }
}
