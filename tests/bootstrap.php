<?php

error_reporting(E_ALL | E_STRICT);

// Ensure that composer has installed all dependencies
if (!file_exists(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'composer.lock')) {
    die("Dependencies must be installed using composer:\n\ncomposer.phar install --dev\n\n"
        . "See https://github.com/composer/composer/blob/master/README.md for help with installing composer\n");
}

require_once 'PHPUnit/TextUI/TestRunner.php';

// Register an autoloader for the client being tested
spl_autoload_register(function($class) {
	if (0 === strpos($class, 'Guzzle\Openstack\Tests')) {
		$class = str_replace('Guzzle\Openstack\Tests', '', $class);
		if ('\\' != DIRECTORY_SEPARATOR) {
			$class = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'Guzzle/Openstack/Tests' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
		} else {
			$class = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'Guzzle\Openstack\Tests' . DIRECTORY_SEPARATOR . $class . '.php';
		}
		if (file_exists($class)) {
			require $class;
			return true;
		}
	}
	if (0 === strpos($class, 'Guzzle\Openstack')) {
        $class = str_replace('Guzzle\Openstack', '', $class);
        if ('\\' != DIRECTORY_SEPARATOR) {
            $class = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Guzzle/Openstack' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        } else {
            $class = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Guzzle\Openstack' . DIRECTORY_SEPARATOR . $class . '.php';
        }
        if (file_exists($class)) {
            require $class;
            return true;
        }
    }
    return false;
});

// Include the composer autoloader
$loader = require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Register services with the GuzzleTestCase
Guzzle\Tests\GuzzleTestCase::setMockBasePath(__DIR__ . DIRECTORY_SEPARATOR . 'mock');

Guzzle\Tests\GuzzleTestCase::setServiceBuilder(\Guzzle\Service\Builder\ServiceBuilder::factory(array(
    'test.abstract.os' => array(
        'class' => '',
        'params' => array(
            'username' => 'admin',
            'password' => 'openstack',
            'token' => 'authenticationtoken'
        )
    ),
    'test.identity' => array(
        'extends' => 'test.abstract.os',
        'class' => 'Guzzle.Openstack.Identity.IdentityClient',
        'params' => array(
            'base_url' => 'http://192.168.4.100:35357/v2.0/'
        )
    ),
    'test.compute' => array(
        'extends' => 'test.abstract.os',
        'class' => 'Guzzle.Openstack.Compute.ComputeClient',
        'params' => array(
            'base_url' => 'http://192.168.4.100:8774/v2/',
            'tenant_id' => 'tenantid'
        )
    ),
	'test.storage' => array(
		'extends' => 'test.abstract.os',
		'class' => 'Guzzle.Openstack.Storage.StorageClient',
		'params' => array(
			'base_url' => 'http://192.168.4.100:8080/v1/',
			'tenant_id' => 'tenantid'
		)
	),
    'test.openstack'=> array(
        'extends' => 'test.abstract.os',
        'class' => 'Guzzle.Openstack.Openstack.OpenstackClient'
    )
)));
