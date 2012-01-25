<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Update Tenants command unit test
 */
class UpdateTenantsTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function testUpdateTenant()
    {
        $authclient = \Guzzle\Openstack\Authentication\AuthenticationClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100', 'port'=>'35357'));
        $client = \Guzzle\Openstack\Identity\IdentityClient::factory(array('identity' => $authclient, 'username'=>'username', 'password'=>'password'));
        $this->setMockResponse($client->getIdentity(), 'authentication/AuthenticateAuthorized');        
        $this->setMockResponse($client, 'identity/UpdateTenant');        
        $command = $client->getCommand('UpdateTenant');
        
        $command->setId('2');
        $command->setDescription('New Desc');
        $command->setEnabled(false);
        $command->prepare();
        
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tenants/2', $command->getRequest()->getUrl());
        $this->assertEquals('PUT', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('tenant', $result));
        
    }
}