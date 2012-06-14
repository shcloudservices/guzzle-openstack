<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * List Endpoints command unit test
 */
class ListEndpointsTest extends \Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase
{
    public function testListEndpoints()
    {
        $this->setMockResponse($this->client, 'identity/ListEndpoints');        
        $command = $this->client->getCommand('ListEndpoints');
        $command->setTokenId("admintoken");
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tokens/admintoken/endpoints', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));     
        
        $this->assertTrue(array_key_exists('endpoints', $result));
        
    }
}

?>
