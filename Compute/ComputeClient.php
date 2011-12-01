<?php

namespace Guzzle\Openstack\Compute;

use Guzzle\Common\Inspector;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Service\Client;
use Guzzle\Service\Description\XmlDescriptionBuilder;

class ComputeClient extends Client

{
    protected $baseUrl, $identity;
    /**
     * Factory method to create a new ComputeClient
     *
     * @param array|Collection $config Configuration data. Array keys:
     *    base_url - Base URL of web service
     *    identity - Client Identity
     *
     * @return ComputeClient
     *
     * @TODO update factory method and docblock for parameters
     */
    public static function factory($config)
    {
        $default  = array(
            'base_url' => '{{scheme}}://{{ip}}:{{port}}/v{{version}}/',
            'scheme' => 'https',
            'version' => '1.0',
            'port' => '8774'
        );
        $required = array('base_url','ip');
        $config = Inspector::prepareConfig($config, $default, $required);
        $client = new self($config->get('base_url'), $config->get('identity'));
        $client->setConfig($config);

        // Add the XML service description to the client
        // Uncomment the following two lines to use an XML service description
        // $builder = new XmlDescriptionBuilder(__DIR__ . DIRECTORY_SEPARATOR . 'client.xml');
        // $client->setDescription($builder->build());
        return $client;
    }
    
    /**
     * Client constructor
     *
     * @param string $baseUrl Base URL of the web service
     * @param IdentityClient Client Identity
     */
    public function __construct($baseUrl, $nIdentity)
    {
        parent::__construct($baseUrl);
        $identity = $nIdentity;
    }
}