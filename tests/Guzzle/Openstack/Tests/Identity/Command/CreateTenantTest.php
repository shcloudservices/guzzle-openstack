<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Create Tenants command unit test
 */
class CreateTenantsTest extends \Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase

{
  
    public function testCreateTenant()
    {
        $this->setMockResponse($this->client, 'identity/CreateTenant');        
        $command = $this->client->getCommand('CreateTenant');
        $command->setName('Tenantname');
        $command->setDescription('A description');
        $command->setEnabled(true);
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tenants', $command->getRequest()->getUrl());
        $this->assertEquals('POST', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('tenant', $result));
        
    }
    
    public function testNameRequired()
    {
        $command = $this->client->getCommand('CreateTenant',  array());
        $this->setExpectedException('InvalidArgumentException');
        $command->prepare();
    } 
}