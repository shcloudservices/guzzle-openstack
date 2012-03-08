<?php

namespace Guzzle\Openstack\Tests\Compute\Command;

/**
 * List Servers Detail command unit test
 */
class ListServersDetailTest extends \Guzzle\Openstack\Tests\Compute\Common\ComputeTestCase
{
   
    public function testListServersDetails()
    {
        $this->setMockResponse($this->client, 'compute/ListServersDetail');
        $command = $this->client->getCommand('ListServersDetail');
        $command->setImage('imageRef');
        $command->setFlavor('flavorRef');
        $command->setName('serverName');
        $command->setStatus('serverStatus');
        $command->setChangesSince('dateTime');
        $command->setMarker('markerID');
        $command->setLimit('int');
        
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:8774/v2/tenantid/servers/detail?image=imageRef&flavor=flavorRef&name=serverName&status=serverStatus&changes-since=dateTime&marker=markerID&limit=int', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('servers', $result));
        
    }
    
}