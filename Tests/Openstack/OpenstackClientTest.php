<?php

namespace Guzzle\Openstack\Tests\Openstack;

use Guzzle\Openstack\Openstack\OpenstackClient;

/**
 * OpenstackClient unit tests.
 */
class OpenstackClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function setUp()
    {
        $this->client = OpenstackClient::factory(
                array(
                    'auth_url'=>'http://mykeystoneserver.com:5000/v2.0/'
                    ));
    }
    

    public function testAuthenticate()
    {
        $this->setMockResponse($this->client, 'authentication/AuthenticateAuthorized');
        $this->client->authenticate('username', 'password', 'mytenant');
        
        $this->assertTrue(is_array($this->client->getServiceCatalog()));
        
    }
}
?>
