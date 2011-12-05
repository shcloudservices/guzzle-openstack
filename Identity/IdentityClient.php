<?php

namespace Guzzle\Openstack\Identity;

use Guzzle\Common\Inspector;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Service\Client;
use Guzzle\Service\Description\XmlDescriptionBuilder;

class IdentityClient extends Client
{
    protected $tokenCache;
    
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
     */
    public static function factory($config)
    {
        $default = array(
            'base_url' => '{{scheme}}://{{ip}}:{{port}}/v{{version}}/',
            'scheme' => 'https',
            'version' => '2.0',
            'port' => '35357'
        );
        $required = array('base_url', 'ip');
        $config = Inspector::prepareConfig($config, $default, $required);

        $client = new self($config->get('base_url'));
        $client->setConfig($config);

        return $client;
    }

    /**
     * IdentityClient constructor
     *
     * @param string $baseUrl Base URL of the web service
     */
    public function __construct($baseUrl)
    {
        parent::__construct($baseUrl);
    }
    
    /**
     * Returns a token for the specified username
     * @param string $username 
     * @param string $password
     * @param string $forceRefresh
     * @return string 
     */
    public function getToken($username, $password, $forceRefresh = false)
    {
        $key = $username . '_' . $password;
        if ($forceRefresh || !$this->tokenCache[$key]) {
            $response = $this->getCommand('authenticate', array('username'=>$username, 
                'password'=>$password))->execute()->getResult();
            $this->tokenCache[$key] = $response['access']['token']['id'];
        }

        return $this->tokenCache[$key];
    }
}