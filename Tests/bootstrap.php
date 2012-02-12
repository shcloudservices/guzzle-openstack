<?php

error_reporting(E_ALL | E_STRICT);

// Ensure that composer has installed all dependencies
if (!file_exists(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'composer.lock')) {
    die("Dependencies must be installed using composer:\n\ncomposer.phar install --install-suggests\n\n"
        . "See https://github.com/composer/composer/blob/master/README.md for help with installing composer\n");
}

require_once 'PHPUnit/TextUI/TestRunner.php';

// Register an autoloader for the client being tested
spl_autoload_register(function($class) {
    if (0 === strpos($class, 'Guzzle\Openstack')) {
        $class = str_replace('Guzzle\Openstack', '', $class);
        if ('\\' != DIRECTORY_SEPARATOR) {
            $class = dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        } else {
            $class = dirname(__DIR__) . DIRECTORY_SEPARATOR . $class . '.php';
        }
        if (file_exists($class)) {
            require $class;
        }
    }
});

// Include the composer autoloader
$loader = require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . '.composer' . DIRECTORY_SEPARATOR . 'autoload.php';

// Register services with the GuzzleTestCase
Guzzle\Tests\GuzzleTestCase::setMockBasePath(__DIR__ . DIRECTORY_SEPARATOR . 'mock');

// Create a service builder to use in the unit tests
Guzzle\Tests\GuzzleTestCase::setServiceBuilder(\Guzzle\Service\ServiceBuilder::factory(array(
    'test.abstract.os' => array(
        'class' => '',
        'params' => array(
            'username' => 'admin',
            'password' => 'openstack',
            'auth_url' => 'http://mykeystoneserver:5000/v2.0/',
            'ip' => '192.168.4.100'
        )
    ),
    'test.authentication' => array(
        'extends' => 'test.abstract.os',
        'class' => 'Guzzle.Openstack.Authentication.AuthenticationClient'
    ),
    'test.identity' => array(
        'class' => 'Guzzle.Openstack.Identity.IdentityClient',
        'params' => array(
            'identity'=> 'test.Authentication'
        )
    ),
    'test.compute' => array(
        'extends' => 'test.abstract.os',
        'class' => 'Guzzle.Openstack.Compute.ComputeClient'
    ),
    'test.openstack'=> array(
        'extends' => 'test.abstract.os',
        'class' => 'Guzzle.Openstack.Openstack.OpenstackClient'
    )
)));
