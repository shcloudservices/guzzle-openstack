<?php

namespace Guzzle\Openstack\Openstack;

use \Guzzle\Service\Inspector;
use Guzzle\Openstack\Identity\IdentityClient;
use Guzzle\Openstack\Compute\ComputeClient;

/**
 * @license See the LICENSE file that was distributed with this source code.
 */

/**
 * Openstack Client
 */
class OpenstackClient extends \Guzzle\Service\Client {

    protected $username, $password, $tenantName, $region, $token;
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
    public static function factory($config) {
        $default = array(
            'compute_type' => 'compute',
            'identity_type' => 'identity',
            'storage_type' => 'storage',
            'region' => 'RegionOne'
        );
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
    public function __construct($auth_url) {
        parent::__construct($auth_url);
    }

    /**
     * Authentication method
     * 
     * @param string $username Username
     * @param string $password Password
     * @param string $tenantName Tenant Name
     */
    public function authenticate($username, $password, $tenantName) {
        try {
            $command = $this->getCommand('Authenticate', array('username' => $username,
                'password' => $password, 'tenantName' => $tenantName));
            $authResult = $command->execute()->getResult();
        } catch (BadResponseException $e) {
            throw new OpenstackException($e);
        }

        $this->username = $username;
        $this->password = $password;
        $this->tenantName = $tenantName;

        //Copy Service Catalog
        $this->serviceCatalog = $authResult['access']['serviceCatalog'];

        //Get token
        $this->token = $authResult['access']['token'];
        
        //Default Region
        $this->region = 'RegionOne';
    }

    public function getServiceCatalog() {
        return $this->serviceCatalog;
    }

    public function getToken() {
        return $this->token;
    }

    /**
     * Get endpoints for the service type for all regions
     * 
     * @param string $serviceType
     * @return array 
     */
    private function getEndpoints($serviceType) {
        $serviceEndpoints = array();
        foreach ($this->serviceCatalog as $value) {
            if ($value['type'] == $serviceType) {
                $serviceEndpoints = $value['endpoints'];
            }
        }
        return $serviceEndpoints;
    }

    /**
     * Get an endpoint for a specific service and region
     * 
     * @param string $serviceType
     * @param string $region
     * @param string $endpointType
     * @return string
     */
    private function getEndpoint($serviceType, $region, $endpointType='public') {
        $serviceEndpoints = $this->getEndpoints($serviceType);
        foreach ($serviceEndpoints as $endpointsRegion => $endpoints) {
            if ($endpointsRegion == $region) {
                return $endpoints[$endpointType . 'URL'];
            }
        }
    }

    public function getIdentityClient() {
        if (!get_class($this->identityClient) == 'IdentityClient') {
            $this->identityClient = IdentityClient::factory(array(
                        'username' => $this->username,
                        'password' => $this->password,
                        'tenantName' => $this->tenantName,
                        'base_url' => $this->getEndpoint('identity', $this->region, $endpointType)
                    ));
        }
        return $this->identityClient;
    }

}

?>
