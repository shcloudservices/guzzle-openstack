<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * List Endpoints command unit test
 */
class ListEndpointsTest extends \Guzzle\Tests\GuzzleTestCase {
    public function testListEndpoints()
    {
        $authclient = \Guzzle\Openstack\Authentication\AuthenticationClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100'));
        $client = \Guzzle\Openstack\Identity\IdentityClient::factory(array('identity' => $authclient, 'username'=>'username', 'password'=>'password'));
        $this->setMockResponse($client->getIdentity(), array('authentication/AuthenticateAuthorized'));  
        $this->setMockResponse($client, 'identity/ListEndpoints');        
        $command = $client->getCommand('ListEndpoints');
        $command->setTokenId("admintoken");
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:5000/v2.0/tokens/admintoken/endpoints', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
        
        $client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));     
        
        $this->assertTrue(array_key_exists('endpoints', $result));
        
    }
}

?>
