<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Compute;

use Guzzle\Service\Inspector;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Openstack\Common\AbstractClient;
use Guzzle\Service\Description\XmlDescriptionBuilder;
use Guzzle\Openstack\Common\AuthenticationObserver;

class ComputeClient extends AbstractClient
{
    protected $baseUrl, $tenantId;

    /**
     * Factory method to create a new ComputeClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *    token - Authentication token
     *    tenant_id Tenant id
     *
     * @return ComputeClient
     */
    public static function factory($config = array())
    {
        $default = array();
        $required = array('base_url','token', 'tenant_id');
        $config = Inspector::prepareConfig($config, $default, $required);        
        $client = new self($config->get('base_url'), $config->get('token'), $config->get('tenant_id'));
        $client->setConfig($config);
        $client->getEventDispatcher()->addSubscriber(new AuthenticationObserver());
        return $client;
    }

    /**
     * ComputeClient constructor
     *
     * @param string $baseUrl Base URL for Nova
     * @param AuthenticationClient $identity AuthenticationClient for authentication
     * @param string $token Authentication token
     * 
     */
    public function __construct($baseUrl, $token, $tenantId)
    {
        parent::__construct($baseUrl);
        $this->setToken($token);
        $this->setTenantId($tenantId);
    }
    
    public function setTenantId($tenantId) 
    {
        $this->tenantId = $tenantId;
    }

    public function getTenantId()
    {
        return $this->tenantId;
    }
    
}