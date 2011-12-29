<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * List Tenants command unit test
 * @author Adrian Moya
 */
class ListTenantsTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function testListTenants()
    {
        $authclient = \Guzzle\Openstack\IdentityAuth\IdentityAuthClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100'));
        $client = \Guzzle\Openstack\Identity\IdentityClient::factory(array('identity' => $authclient));
        $command = $client->getCommand('ListTenants');
        $command->prepare();
        
        $this->setMockResponse($client, 'identity/ListTenants');
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:5000/v2.0/tenants', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        print_r($result);
//        
//        $this->assertArrayHasKey('access', $result);
//        $this->assertArrayHasKey('token', $result['access']);
//        $this->assertArrayHasKey('id', $result['access']['token']);
        
    }
}