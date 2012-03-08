<?php

namespace Guzzle\Openstack\Tests\Compute\Command;

use Guzzle\Openstack\Tests\Compute\Common\ComputeTestCase;
use Guzzle\Openstack\Compute\ComputeConstants;

/**
 * ListFlavorsDetail Tests
 */
class ListFlavorsDetailTest extends ComputeTestCase
{
    
    public function testListFlavorsDetail()
    {
        $this->setMockResponse($this->client, 'compute/ListFlavorsDetail');
        $command = $this->client->getCommand(ComputeConstants::LIST_FLAVORS_DETAIL);
        $command->setMinDisk('minDiskInGB');
        $command->setMinRam('minRamInMB');
        $command->setMarker('markerID');
        $command->setLimit('int');        
        
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:8774/v2/tenantid/flavors/detail?minDisk=minDiskInGB&minRam=minRamInMB&marker=markerID&limit=int', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                
        //Check parameters

        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('flavors', $result));
        
    }
}

?>
