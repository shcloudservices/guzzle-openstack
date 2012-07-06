<?php

namespace Guzzle\Openstack\Openstack;

use \Guzzle\Service\Inspector;
use Guzzle\Openstack\Identity\IdentityClient;
use Guzzle\Openstack\Compute\ComputeClient;
use Guzzle\Openstack\Common\OpenstackException;

/**
 * @license See the LICENSE file that was distributed with this source code.
 */

/**
 * Openstack Client
 */
class OpenstackClient extends \Guzzle\Service\Client
{

	protected $auth_url, $username, $password, $tenantName, $region, $token;
	protected $computeClient, $identityClient, $serviceCatalog;

	/**
	 * Factory method to create a new OpenstackClient
	 *
	 * @static
	 *
	 * @param array|Collection $config Configuration data. Array keys:
	 *                                 auth_url - Authentication service URL
	 *                                 username - API username
	 *                                 password - API password
	 *                                 tenantName - API tenantName
	 *
	 * @return \Guzzle\Common\FromConfigInterface|OpenstackClient|\Guzzle\Service\Client
	 */
	public static function factory($config = array())
	{
		$default = array(
			'compute_type'  => 'compute',
			'identity_type' => 'identity',
			'storage_type'  => 'storage',
			'region'        => 'RegionOne'
		);
		$required = array('auth_url');
		$config = Inspector::prepareConfig($config, $default, $required);

		$client = new self($config->get('auth_url'), $config->get(
			'username'
		), $config->get('password'), $config->get('tenantName'));
		$client->setConfig($config);

		return $client;
	}

	/**
	 * OpenstackClient constructor
	 *
	 * @param string $auth_url URL of the Identity Service
	 */
	public function __construct($auth_url, $username, $password, $tenantName = '')
	{
		parent::__construct($auth_url);
		$this->auth_url = $auth_url;
		$this->serviceCatalog = array();
		$this->identityClient = IdentityClient::factory(
			array(
				'base_url' => $this->auth_url
			)
		);
	}

	/**
	 * Authentication method
	 *
	 * @param string $username   Username
	 * @param string $password   Password
	 * @param string $tenantName Tenant Name
	 */
	public function authenticate($username, $password, $tenantName)
	{
		$command = $this->identityClient->getCommand('Authenticate');
		$command->setUsername($username)->setPassword($password)->setTenantname(
			$tenantName
		);
		try {
			$authResult = $command->execute()->getResult;
			$this->username = $username;
			$this->password = $password;
			$this->tenantName = $tenantName;

			//Copy Service Catalog
			$this->serviceCatalog = $authResult['access']['serviceCatalog'];

			//Get token
			$this->token = $authResult['access']['token'];

			//Default Region
			$this->region = 'RegionOne';
		} catch (OpenstackException $e) {

		}
	}

	public function getServiceCatalog()
	{
		return $this->serviceCatalog;
	}

	/**
	 * Get endpoints for the service type for all regions
	 *
	 * @param string $serviceType
	 *
	 * @return array
	 */
	public function getEndpoints($serviceType)
	{
		if (is_null($this->token)) {
			throw new OpenstackException('Unauthenticated');
		}
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
	 *
	 * @return string
	 */
	public function getEndpoint($serviceType, $region, $endpointType = 'public')
	{
		$serviceEndpoints = $this->getEndpoints($serviceType);
		foreach ($serviceEndpoints as $endpointsRegion => $endpoints) {
			if ($endpointsRegion == $region) {
				return $endpoints[$endpointType . 'URL'];
			}
		}
	}

	public function getIdentityClient()
	{
		if (!get_class($this->identityClient) == 'IdentityClient') {
			$this->identityClient = IdentityClient::factory(
				array(
					'username'   => $this->username,
					'password'   => $this->password,
					'tenantName' => $this->tenantName,
					'base_url'   => $this->getEndpoint(
						'identity', $this->region, $endpointType
					)
				)
			);
		}
		return $this->identityClient;
	}

	/**
	 * Returns an authentication token for the specified username / tenant
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $tenantid
	 * @param string $forceRefresh
	 *
	 * @return string
	 */
	public function getToken(
		$username, $password, $tenantName = '', $forceRefresh = false)
	{
//        $key = $this->createKey($username, $password, $tenantName);
//        if($forceRefresh || !array_key_exists($key, $this->tokenCache)) {
//            $result =  $this->executeAuthCommand($username, $password, $tenantName);
//            $this->tokenCache[$key] = $result['access']['token']['id'];
//        }        
//        return $this->tokenCache[$key];
	}

}

?>
