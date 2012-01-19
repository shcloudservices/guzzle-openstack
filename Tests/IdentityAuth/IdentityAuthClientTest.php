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
        
        //Check success 
        $this->setMockResponse($client, 'identity_auth/AuthenticateAuthorized');
        $token = $client->getToken('username','password');
        $this->assertEquals('admintoken', $token);
        
        //Check autorefresh token
        $this->setMockResponse($client, array('identity_auth/AuthenticateUnauthorized','identity_auth/AuthenticateAuthorized')); 
        $token = $client->getToken('username','password');
        $this->assertEquals('admintoken', $token);
        
    }
}
?>
