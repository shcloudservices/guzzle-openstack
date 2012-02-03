<?php

namespace Guzzle\Openstack\Openstack;

use \Guzzle\Service\Inspector;

/**
 * @license See the LICENSE file that was distributed with this source code.
 */

/**
 * Openstack Client
 */
class OpenstackClient extends \Guzzle\Service\Client{
    
     protected $username, $password, $tenantName, $token;
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
        $required = array('auth_url');
        $config = Inspector::prepareConfig($config, $default, $required);

        $client = new self($config->get('auth_url'));
        $client->setConfig($config);

        return $client;
    }
    
    /**
     * OpenstackClient constructor
     * 
     * @param string $auth_url URL of the Identity Service
     */
    public function __construct($auth_url)
    {
        parent::__construct($auth_url);
    }
    
    
    /**
     * Authentication method
     * 
     * @param string $username Username
     * @param string $password Password
     * @param string $tenantName Tenant Name
     */
    public function authenticate($username, $password, $tenantName)
    {
        try {
            $command = $this->getCommand('Authenticate', array('username'=>$username, 
                'password'=>$password, 'tenantName'=>$tenantName));
            $authResult = $command->execute()->getResult();
        } catch(BadResponseException $e){
            throw new OpenstackException($e);
        }
        
        $this->username = $username;
        $this->password = $password;
        $this->tenantName = $tenantName;
        
        //Copy Service Catalog
        $this->serviceCatalog = $authResult['access']['serviceCatalog'];
        
        //Get token
        $this->token = $authResult['access']['token'];
        
    }
    
    public function getServiceCatalog()
    {
        return $this->serviceCatalog;
    }
    
    public function getToken()
    {
        return $this->token;
    }
}

?>
