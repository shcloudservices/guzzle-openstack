<?php

namespace Guzzle\Openstack\Tests\Authentication;

/**
 * AuthenticationClient unit tests.
 */
class AuthenticationClientTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function testGetToken()
    {
        $client = $this->getServiceBuilder()->get('test.authentication');
        $this->setMockResponse($client, 'authentication/AuthenticateUnauthorized'); 
        
        //Check exception when unauthorized
        $this->setExpectedException('Guzzle\Openstack\Common\OpenstackException');
        $client->getToken('username','password');
        
        //Check success 
        $this->setMockResponse($client, 'authentication/AuthenticateAuthorized');
        $token = $client->getToken('username','password');
        $this->assertEquals('admintoken', $token);
        
        //Check autorefresh token
        $this->setMockResponse($client, array('authentication/AuthenticationUnauthorized','authentication/AuthenticateAuthorized')); 
        $token = $client->getToken('username','password');
        $this->assertEquals('admintoken', $token);

        //Check exception if double unauthorized
        $this->setMockResponse($client, array('authentication/AuthenticationUnauthorized','authentication/AuthenticationUnauthorized')); 
        $this->setExpectedException('Guzzle\Openstack\Common\OpenstackException');
        $client->getToken('username','password');        
    }
}
?>
