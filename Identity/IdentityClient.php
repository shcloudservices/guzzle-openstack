<?php

namespace Guzzle\Openstack\Identity;

use Guzzle\Common\Inspector;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Service\Client;
use Guzzle\Service\Description\XmlDescriptionBuilder;

class IdentityClient extends Client
{    
    protected $username;

    protected $password;


    /**
     * Factory method to create a new IdentityClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *    scheme - URI scheme: http or https
     *    port - API Port
     *    username - API username
     *    password - API password 
     *    api_version - API version
     *    ip - IP Address
     *
     * @return IdentityClient
     *
     */
    public static function factory($config)
    {
        $default = array(
            'base_url' => '{{scheme}}://{{ip}}:{{port}}/v{{version}}/',
            'scheme' => 'https',
            'version' => '2.0',
            'port' => '35357'
        );
        $required = array('username', 'password', 'base_url', 'ip');
        $config = Inspector::prepareConfig($config, $default, $required);

        $client = new self($config->get('base_url'),
                $config->get('username'),
                $config->get('password')
        );
        $client->setConfig($config);

        // Add the XML service description to the client
        // Uncomment the following two lines to use an XML service description
        // $builder = new XmlDescriptionBuilder(__DIR__ . DIRECTORY_SEPARATOR . 'client.xml');
        // $client->setDescription($builder->build());

        return $client;
    }
    
    /**
     * Client constructor
     *
     * @param string $baseUrl Base URL of the web service
     * @param string $username API username
     * @param string $password API password
     */
    public function __construct($baseUrl, $username, $password)
    {
        parent::__construct($baseUrl);
        $this->username = $username;
        $this->password = $password;
    }
}