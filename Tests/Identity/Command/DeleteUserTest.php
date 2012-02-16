<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Delete User command unit test
 */
class DeleteUserTest extends \Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase
{
    
    public function testDeleteUser()
    {
        $this->setMockResponse($this->client, 'identity/DeleteUser');        
        $command = $this->client->getCommand('DeleteUser');
        $command->setId('2');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/users/2', $command->getRequest()->getUrl());
        $this->assertEquals('DELETE', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
    }
}