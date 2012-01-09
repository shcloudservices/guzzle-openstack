<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Compute;

use Guzzle\Common\Inspector;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Openstack\Common\AbstractClient;
use Guzzle\Service\Description\XmlDescriptionBuilder;
use Guzzle\Openstack\Common\IdentityAuthObserver;

class ComputeClient extends AbstractClient
{
    protected $baseUrl;

     /**
     * Factory method to create a new ComputeClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *    identity - Client Identity
     *
     * @return ComputeClient
     */
    public static function factory($config)
    {
        $default  = array(
            'base_url' => '{{scheme}}://{{ip}}:{{port}}/v{{version}}/wtf/',
            'scheme' => 'https',
            'version' => '2',
            'port' => '8774'
        );
        $required = array('base_url','ip','identity','username','password');
        $config = Inspector::prepareConfig($config, $default, $required);
        $client = new self($config->get('base_url'), $config->get('identity'),$config->get('username'),$config->get('password'));
        $client->setConfig($config);
        $client->getEventManager()->attach(new IdentityAuthObserver(), 0);
        
        return $client;
    }

    /**
     * Client constructor
     *
     * @param string $baseUrl Base URL of the web service
     * @param IdentityAuthClient $identity IdentityAuthClient for authentication
     * @param string $username Username
     * @param string $password Password
     * 
     */
    public function __construct($baseUrl, $identity, $username, $password)
    {
        parent::__construct($baseUrl);
        $this->identity = $identity;
        $this->username = $username;
        $this->password = $password;
    }
}