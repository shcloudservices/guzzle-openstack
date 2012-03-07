<?php

namespace Guzzle\Openstack\Tests\Compute\Command;

/**
 * List Servers command unit test
 */
class ListServersTest extends \Guzzle\Openstack\Tests\Compute\Common\ComputeTestCase
{
   
    public function testListServers()
    {
        $this->setMockResponse($this->client, 'compute/ListServers');
        $command = $this->client->getCommand(\Guzzle\Openstack\Compute\ComputeConstants::LIST_SERVERS);
        $command->setImage('imageRef');
        $command->setFlavor('flavorRef');
        $command->setName('serverName');
        $command->setStatus('serverStatus');
        $command->setChangesSince('dateTime');
        $command->setMarker('markerID');
        $command->setLimit('int');
        
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:8774/v1.1/tenantid/servers?image=imageRef&flavor=flavorRef&name=serverName&status=serverStatus&changes-since=dateTime&marker=markerID&limit=int', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('servers', $result));
        
    }   
    
}