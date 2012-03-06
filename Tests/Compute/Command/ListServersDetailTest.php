<?php

namespace Guzzle\Openstack\Tests\Compute\Command;

/**
 * List Tenants command unit test
 */
class ListServersDetailTest extends \Guzzle\Openstack\Tests\Compute\Common\ComputeTestCase
{
   
    public function testListServersDetails()
    {
        $this->setMockResponse($this->client, 'compute/ListServersDetail');
        $command = $this->client->getCommand('ListServersDetail');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:8774/v1.1/tenantid/servers/detail', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('servers', $result));
        
    }
    
    public function testMarkerParameter() {
        $this->setMockResponse($this->client, 'compute/ListServersDetail');
        $command = $this->client->getCommand('ListServersDetail', array("marker" => "2"));
        $command->prepare();
        $this->assertEquals('http://192.168.4.100:8774/v1.1/tenantid/servers/detail?marker=2', $command->getRequest()->getUrl());

    }
    
    
}