<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * List Tenants command unit test
 */
class ListTenantsTest extends \Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase
{

    public function testListTenants()
    {
        $this->setMockResponse($this->client, 'identity/ListTenants');        
        $command = $this->client->getCommand('ListTenants');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tenants', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));     
        
        $this->assertTrue(array_key_exists('tenants', $result));
        
    }
}