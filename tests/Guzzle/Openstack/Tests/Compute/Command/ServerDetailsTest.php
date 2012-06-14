<?php

namespace Guzzle\Openstack\Tests\Compute\Command;

/**
 * Server details command unit test
 */
class ServerDetailsTest extends \Guzzle\Openstack\Tests\Compute\Common\ComputeTestCase
{
   
    public function testServerDetails()
    {
        $this->setMockResponse($this->client, 'compute/ServerDetails');
        
        
        $command = $this->client->getCommand(\Guzzle\Openstack\Compute\ComputeConstants::SERVER_DETAILS);
        $command->setId('serverId');
        
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:8774/v2/tenantid/servers/serverId', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('server', $result));
        
    }   
    
}