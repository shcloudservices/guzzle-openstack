<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

use \Guzzle\Openstack\Identity\IdentityConstants;

/**
 * Update Users command unit test
 */
class UpdateUsersTest extends \Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase
{
    
    public function testUpdateUsers()
    {
        $this->setMockResponse($this->client, 'identity/UpdateUser');        
        $command = $this->client->getCommand('UpdateUser');
        $command->setId('2');
        $command->setName('New Name');
        $command->setPassword('New pass');
        $command->setEmail('newemail@email.com');
        $command->setEnabled(false);
        $command->prepare();
        
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/users/2', $command->getRequest()->getUrl());
        $this->assertEquals('PUT', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('user', $result));
        
    }
    
    public function testIdRequired()
    {
        $command = $this->client->getCommand(IdentityConstants::UPDATE_USER, array());
        $this->setExpectedException('Guzzle\Service\Exception\ValidationException');
        $command->prepare();
    } 
}