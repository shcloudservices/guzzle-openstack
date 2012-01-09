<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\IdentityAuth;

use Guzzle\Common\Inspector;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Service\Client;
use Guzzle\Service\Description\XmlDescriptionBuilder;
use Guzzle\Http\Message\BadResponseException;
use Guzzle\Openstack\Common\OpenstackException;

class IdentityAuthClient extends Client
{
    protected $tokenCache;
    
    /**
     * Factory method to create a new IdentityClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *    scheme - URI scheme: http or https
     *    port - API Port
     *    username - API username
     *    password - API password
     *    api_version - API version
     *    ip - IP Address
     *
     * @return IdentityAuthClient
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
     * IdentityAuthClient constructor
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
    public function getToken($username, $password, $tenantid='', $forceRefresh = false)
    {
        $key = $username . '_' . $password . '_' . $tenantid;
        if ($forceRefresh || !array_key_exists($key, $this->tokenCache)) {
            try {
            $response = $this->getCommand('authenticate', array('username'=>$username, 
                'password'=>$password, 'tenantid'=>$tenantid))->execute()->getResult();
            }
            catch(BadResponseException $e) {
                throw new OpenstackException($e);
            }
            $this->tokenCache[$key] = $response['access']['token']['id'];
        }

        return $this->tokenCache[$key];
    }
}