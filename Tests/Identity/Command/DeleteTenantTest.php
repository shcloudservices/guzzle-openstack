<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Delete Tenant command unit test
 */
class DeleteTenantTest extends \Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase
{

    public function testDeleteTenant()
    {
        $this->setMockResponse($this->client, 'identity/DeleteTenant');        
        $command = $this->client->getCommand('DeleteTenant');
        $command->setId('2');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tenants/2', $command->getRequest()->getUrl());
        $this->assertEquals('DELETE', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));

    }
}