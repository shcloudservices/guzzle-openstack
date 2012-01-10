<?php

namespace Guzzle\Openstack\Tests\IdentityAuth;

/**
 * IdentityAuthClient unit tests.
 */
class IdentityAuthClientTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function testGetToken()
    {
        $client = $this->getServiceBuilder()->get('test.identityauth');
        $this->setMockResponse($client, 'identity_auth/AuthenticateUnauthorized'); 
        
        $this->setExpectedException('Guzzle\Openstack\Common\OpenstackException');
        $client->getToken('username','password');        
    }
}
?>
