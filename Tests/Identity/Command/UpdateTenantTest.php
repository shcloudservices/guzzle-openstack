<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Update Tenants command unit test
 */
class UpdateTenantsTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function setUp()
    {
        $authclient = \Guzzle\Openstack\Authentication\AuthenticationClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100', 'port'=>'35357'));
        $this->client = \Guzzle\Openstack\Identity\IdentityClient::factory(array('identity' => $authclient, 'username'=>'username', 'password'=>'password'));        
        $this->setMockResponse($this->client->getIdentity(), 'authentication/AuthenticateAuthorized');                
    }
    
    public function testUpdateTenant()
    {
        $this->setMockResponse($this->client, 'identity/UpdateTenant');        
        $command = $this->client->getCommand('UpdateTenant');
        $command->setId('2');
        $command->setDescription('New Desc');
        $command->setEnabled(false);
        $command->prepare();
        
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tenants/2', $command->getRequest()->getUrl());
        $this->assertEquals('PUT', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('tenant', $result));
        
    }
    
    public function testIdRequired()
    {
        $command = $this->client->getCommand('UpdateTenant', array());
        $this->setExpectedException('InvalidArgumentException');
        $command->prepare();
    }
}