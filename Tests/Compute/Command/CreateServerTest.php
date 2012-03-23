<?php

namespace Guzzle\Openstack\Tests\Compute\Command;

use Guzzle\Openstack\Tests\Compute\Common\ComputeTestCase;
use Guzzle\Openstack\Compute\ComputeConstants;

/**
 * Create Server command unit test
 * 
 */

class CreateServerTest extends ComputeTestCase {
    
    public function testCreateServer()
    {
        $this->setMockResponse($this->client, 'compute/CreateServer');
        $command = $this->client->getCommand(ComputeConstants::CREATE_SERVER);
        /*
         * name doc="Server Name" required="true"
 * @guzzle imageRef doc="Image Reference" required="true"
 * @guzzle flavorRef doc="Flavor Reference" required="true"
 * @guzzle metadata doc="Path" required="false"
 * @guzzle personality
         */
        $command->setName('ServerTest');
        $command->setImageRef('ImageRef001');
        $command->setFlavorRef('FlavorRef001');
        $command->setMetadata(array('My Server Name' => 'Apache1'));        
        $command->setPersonality(array('path' => '/etc/path.txt', 
            'contents' => 'Contenido'));
        $command->prepare();
      
        //PA
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:8774/v2/tenantid/flavors?minDisk=minDiskInGB&minRam=minRamInMB&marker=markerID&limit=int', $command->getRequest()->getUrl());
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
