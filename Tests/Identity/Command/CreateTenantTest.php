<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Create Tenants command unit test
 */
class CreateTenantsTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function setUp()
    {
        $authclient = \Guzzle\Openstack\Authentication\AuthenticationClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100', 'port'=>'35357'));
        $this->client = \Guzzle\Openstack\Identity\IdentityClient::factory(array('identity' => $authclient, 'username'=>'username', 'password'=>'password'));        
        $this->setMockResponse($this->client->getIdentity(), 'authentication/AuthenticateAuthorized');                
    }
    
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