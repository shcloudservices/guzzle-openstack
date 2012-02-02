<?php

namespace Guzzle\Openstack;

/**
 * @license See the LICENSE file that was distributed with this source code.
 */

/**
 * Openstack Client
 */
class OpenstackClient extends \Guzzle\Service\Client{
    
     protected $computeClient, $identityClient, $serviceCatalog;
     
    /**
     * Factory method to create a new OpenstackClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    auth_url - Authentication service URL
     *    username - API username
     *    password - API password
     *    tenantName - API tenantName
     *
     * @return OpenstackClient
     */
    public static function factory($config)
    {       
        $default = array();
        $required = array('auth_url', 'username', 'password');
        $config = Inspector::prepareConfig($config, $default, $required);

        $client = new self($config->get('base_url'), $config->get('username'), $config->get('password'), $config->get('auth_url'));
        $client->setConfig($config);

        return $client;
    }
    
    /**
     * OpenstackClient constructor
     * 
     * @param string $auth_url URL of the Identity Service
     * @param string $username Username
     * @param string $password Password
     * @param string $tenantName Tenant Name
     */
    public function __construct($auth_url, $username, $password, $tenantName=null)
    {
        parent::__construct($baseUrl);
        $authResp = $client->authentication($username, $password, $tenantName);
        $identityEndpoint = $authResp["identityEndpoint"];
        $computeEndpoint = $authResp["computeEndpoint"];

        return $client;
    }
    
    
    /**
     * Get a IdentityClient
     *
     * @return IdentityClient
     */
    public function getIdentityClient() {
        if ($this->identityClient != null) {
            return $this->identityClient;
        }
        
        
    }

        
}

?>
