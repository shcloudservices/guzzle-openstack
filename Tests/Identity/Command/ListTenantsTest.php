<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * List Tenants command unit test
 */
class ListTenantsTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function testListTenants()
    {
        $authclient = \Guzzle\Openstack\IdentityAuth\IdentityAuthClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100'));
        $client = \Guzzle\Openstack\Identity\IdentityClient::factory(array('identity' => $authclient, 'username'=>'username', 'password'=>'password'));
        $this->setMockResponse($client->getIdentity(), 'identity_auth/AuthenticateAuthorized');        
        $this->setMockResponse($client, 'identity/ListTenants');        
        $command = $client->getCommand('ListTenants');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:5000/v2.0/tenants', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        //$this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('tenants', $result));
        
    }
}