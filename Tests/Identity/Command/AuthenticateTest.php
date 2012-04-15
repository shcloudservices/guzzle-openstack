<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Authenticate command unit test
 */
class AuthenticateTest extends \Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase
{

    public function testAuthenticate()
    {
        $this->setMockResponse($this->client, 'identity/AuthenticateAuthorized');        
        $command = $this->client->getCommand('Authenticate');
        $command->setUsername('username');
        $command->setPassword('password');
        $command->prepare();
        
        //Test method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tokens', $command->getRequest()->getUrl());        
        $this->assertEquals('POST', $command->getRequest()->getMethod());        

        //Check the body of the command
        $body = $command->getRequest()->getBody()->read(200);
        $this->assertEquals('{"auth":{"passwordCredentials":{"username":"username","password":"password"}}}', $body);
        
        //Test result     
        $this->client->execute($command);       
        
        $result = $command->getResult();

        $this->assertTrue(is_array($result));        
        $this->assertArrayHasKey('access', $result);
        $this->assertArrayHasKey('token', $result['access']);
        $this->assertArrayHasKey('id', $result['access']['token']);
        
    }
}