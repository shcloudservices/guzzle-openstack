<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Check Token command unit test
 */
class CheckTokenTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function testCheckToken()
    {
        $authclient = \Guzzle\Openstack\Authentication\AuthenticationClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100', 'port' => '35357'));
        $client = \Guzzle\Openstack\Identity\IdentityClient::factory(array('identity' => $authclient, 'username'=>'username', 'password'=>'password'));
        $this->setMockResponse($client->getIdentity(), array('authentication/AuthenticateAuthorized'));  
        $command = $client->getCommand('CheckToken');
        $command->setToken('token');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tokens/token', $command->getRequest()->getUrl());
        $this->assertEquals('HEAD', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                               
    }
}