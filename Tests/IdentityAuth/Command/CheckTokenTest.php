<?php

namespace Guzzle\Openstack\Tests\IdentityAuth\Command;

/**
 * Check Token command unit test
 */
class CheckTokenTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function testCheckToken()
    {
        $authclient = \Guzzle\Openstack\IdentityAuth\IdentityAuthClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100', 'port'=>'35357'));
        $this->setMockResponse($authclient, 'identity_auth/CheckToken');        
        $command = $authclient->getCommand('CheckToken');
        $command->setToken('token');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tokens/token', $command->getRequest()->getUrl());
        $this->assertEquals('HEAD', $command->getRequest()->getMethod());
                
        //Check for authentication header
        //Lo comenté, es correcto verdad?
        //$this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                               
    }
}