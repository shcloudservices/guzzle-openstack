<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Delete Tenant command unit test
 */
class DeleteTenantTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function testDeleteTenant()
    {
        $authclient = \Guzzle\Openstack\IdentityAuth\IdentityAuthClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100', 'port'=>'35357'));
        $client = \Guzzle\Openstack\Identity\IdentityClient::factory(array('identity' => $authclient, 'username'=>'username', 'password'=>'password'));
        $this->setMockResponse($client->getIdentity(), 'identity_auth/AuthenticateAuthorized');        
        $this->setMockResponse($client, 'identity/DeleteTenant');        
        $command = $client->getCommand('DeleteTenant');
        $command->setId('2');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tenants/2', $command->getRequest()->getUrl());
        $this->assertEquals('DELETE', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
//        $client->execute($command);
//      
//        $result = $command->getResult();
//        $this->assertEquals();
    }
}