<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity;

use Guzzle\Service\Inspector;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Service\Client;
use Guzzle\Service\Description\XmlDescriptionBuilder;
use Guzzle\Openstack\Common\AuthenticationObserver;
use Guzzle\Openstack\Common\AbstractClient;

class IdentityClient extends AbstractClient
{
   
    /**
     * Factory method to create a new IdentityClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    username - API username
     *    password - API password
     *    identity - AuthenticationClient for authentication
     *    tenantid - Tenant Id
     *
     * @return IdentityClient
     */
    public static function factory($config)
    {
        $default = array();
        $required = array('identity', 'username', 'password');
        $config = Inspector::prepareConfig($config, $default, $required);        
        $client = new self($config->get('identity'),$config->get('username'),$config->get('password'),$config->get('tenantid'));
        $client->setConfig($config);
        $client->getEventDispatcher()->addSubscriber(new AuthenticationObserver());
        return $client;
    }

    /**
     * IdentityClient constructor
     *
     * @param AuthenticationClient $identity AuthenticationClient for authentication
     * @param string $username Username
     * @param string $password Password
     * @param string $tenant Tenant ID (for scoped access)
     */
    public function __construct($identity, $username, $password, $tenantid='')
    {
        parent::__construct($identity->getBaseurl());
        $this->identity = $identity;
        $this->username = $username;
        $this->password = $password;
        $this->tenantid = $tenantid;
    }
    
}