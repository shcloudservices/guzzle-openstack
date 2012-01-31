<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Authentication;

use Guzzle\Service\Inspector;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Service\Client;
use Guzzle\Service\Description\XmlDescriptionBuilder;
use Guzzle\Http\Message\BadResponseException;
use Guzzle\Openstack\Common\OpenstackException;

class AuthenticationClient extends Client
{
    
    /**
     * Factory method to create a new IdentityClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *    scheme - URI scheme: http or https
     *    port - API Port
     *    username - API username
     *    password - API password
     *    version - API version
     *    ip - IP Address
     *
     * @return AuthenticationClient
     */
    public static function factory($config)
    {
        $default = array(
            'base_url' => '{{scheme}}://{{ip}}:{{port}}/v{{version}}/',
            'scheme' => 'http',
            'version' => '2.0',
            'port' => '5000'
        );
        $required = array('base_url', 'ip');
        $config = Inspector::prepareConfig($config, $default, $required);

        $client = new self($config->get('base_url'));
        $client->setConfig($config);

        return $client;
    }

    /**
     * AuthenticationClient constructor
     *
     * @param string $baseUrl Base URL of the web service
     */
    public function __construct($baseUrl)
    {
        parent::__construct($baseUrl);
        $this->tokenCache = array();
    }
    
    /**
     * Returns an authentication token for the specified username / tenant
     * @param string $username 
     * @param string $password
     * @param string $tenantid
     * @param string $forceRefresh
     * @return string 
     */
    public function getToken($username, $password, $tenantName='', $forceRefresh = false)
    {
        $key = $this->createKey($username, $password, $tenantName);
        if($forceRefresh || !array_key_exists($key, $this->tokenCache)) {
            $result =  $this->executeAuthCommand($username, $password, $tenantName);
            $this->tokenCache[$key] = $result['access']['token']['id'];
        }        
        return $this->tokenCache[$key];
    }
    
    /**
     * Execute tokens command to bring authentication information's
     * @param string $username 
     * @param string $password
     * @param string $tenantName
     * @param string $forceRefresh
     * @return string 
     */
    public function authentication($username, $password, $tenantName='')
    {
        $result = $this->executeAuthCommand($username, $password, $tenantName);
        $this->initToken($result);
       /*Corregir acceso, y creo que esto es necesario capturarlo sólo la primera
        vez*/
        return array("identityEndpoint" => $result['access']['serviceCatalog']['endpoints'],
            "computeEndpoint" => $result['access']['serviceCatalog']['endpoints']);
    }
    
    private function executeAuthCommand($username, $password, $tenantName) {
        try {
            $command = $this->getCommand('Authenticate', array('username'=>$username, 
                'password'=>$password, 'tenantName'=>$tenantName));
            $result = $command->execute()->getResult();
        }
        catch(BadResponseException $e) {
            throw new OpenstackException($e);
        }
        return $result;
    }
    
    private function createKey($username, $password, $tenantName) {
        return $username . '_' . $password . '_' . $tenantName;
    }
    
    private function initToken($response)
    {
        $key = createKey($username, $password, $tenantName);
        $this->tokenCache[$key] = $result['access']['token']['id'];
    }
}