<?php

namespace Guzzle\Openstack\Tests\Compute\Command;

use Guzzle\Openstack\Tests\Compute\Common\ComputeTestCase;
use Guzzle\Openstack\Compute\ComputeConstants;

/**
 * ListImages Tests
 */
class ListImagesTest extends ComputeTestCase
{
    
    public function testListImages()
    {
        $this->setMockResponse($this->client, 'compute/ListServersDetail');
        $command = $this->client->getCommand(ComputeConstants::LIST_IMAGES);
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:8774/v1.1/tenantid/images', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        //$this->assertTrue(array_key_exists('servers', $result));
        
    }
}

?>
