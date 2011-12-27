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
        $client = $this->getServiceBuilder()->get('test.identity');
        $command = $client->getCommand('ListTenants');
        $command->prepare();
        
        $this->setMockResponse($client, 'identity/ListTenants');
      
        //Check method and endpoint
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