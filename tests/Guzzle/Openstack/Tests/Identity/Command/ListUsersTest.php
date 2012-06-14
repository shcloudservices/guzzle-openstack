<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * List Tenants command unit test
 */
class ListUsersTest extends \Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase
{
   
    public function testListUsers()
    {
        $this->setMockResponse($this->client, 'identity/ListUsers');
        $command = $this->client->getCommand('ListUsers');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/users', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('users', $result));
        
    }
    
    public function testMarkerParameter() {
        $this->setMockResponse($this->client, 'identity/ListUsers');
        $command = $this->client->getCommand('ListUsers', array("marker" => "2"));
        $command->prepare();
        $this->assertEquals('http://192.168.4.100:35357/v2.0/users?marker=2', $command->getRequest()->getUrl());

    }
    
    
}