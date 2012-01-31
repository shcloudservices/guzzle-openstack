<?php

use Guzzle\Service\Inspector;
use Guzzle\Openstack\Authentication\AuthenticationClient;

/**
 * @license See the LICENSE file that was distributed with this source code.
 */

/**
 * Openstack Client
 */
class OpenstackClient {
    
     protected $computeEndpoint, $identityEndpoint, $computeClient, $identityClient;
    /**
     * Factory method to create a new OpenstackClient
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
     * @return OpenstackClient
     */
    public static function factory($config)
    {
        $username = $config->get('username');
        $password = $config->get('password');
        $tenantName = $config->get('tenantName');
        $authclient = AuthenticationClient::factory(array
            ('username' => $username, 
            'password' => $password, 
            'ip' => $config->get('ip'), 
            'port' => $config->get('port'),
            'tenantName' => $tenantName));
        
        $authResp = $client->authentication($username, $password, $tenantName);
        $identityEndpoint = $authResp["identityEndpoint"];
        $computeEndpoint = $authResp["computeEndpoint"];

        return $client;
        
        
        //Llamar a $authClient->getCredentials
        //Construir a IdentityClient y ComputeClient con los endpoints adecuados
        //Guardarlas en las variables de instancias 
        //Retornar las variables de instancia en get
    }
    
    /**
     * Get a IdentityClient
     *
     * @return IdentityClient
     */
    public function getIdentityClient() {
        if ($identityClient != null) {
            return $identityClient;
        }
        
        
    }

        
}

?>
