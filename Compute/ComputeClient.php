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
    protected $baseUrl;

    /**
     * Factory method to create a new ComputeClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *    token - Authentication token
     *
     * @return ComputeClient
     */
    public static function factory($config)
    {
        $default = array();
        $required = array('base_url','token');
        $config = Inspector::prepareConfig($config, $default, $required);        
        $client = new self($config->get('base_url'), $config->get('token'));
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
    public function __construct($baseUrl, $token)
    {
        parent::__construct($baseUrl);
        $this->setToken($token);
    }
  
    
}