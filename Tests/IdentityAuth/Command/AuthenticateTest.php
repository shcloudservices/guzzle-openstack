<?php

namespace Guzzle\Openstack\Tests\IdentityAuth\Command;

/**
 * Authenticate command unit test
 * @author Adrian Moya
 */
class AuthenticateTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function testAuthenticate()
    {
        $client = $this->getServiceBuilder()->get('test.identityauth');
        $this->setMockResponse($client, 'identity_auth/AuthenticateAuthorized');        
        $command = $client->getCommand('Authenticate');
        $command->setUsername('username');
        $command->setPassword('password');
        $command->prepare();
        
        //Test method and resource
        $this->assertEquals('http://192.168.4.100:5000/v2.0/tokens', $command->getRequest()->getUrl());        
        $this->assertEquals('POST', $command->getRequest()->getMethod());        

        //Test result
             
        $client->execute($command);       
        
        $result = $command->getResult();

        $this->assertTrue(is_array($result));        
        $this->assertArrayHasKey('access', $result);
        $this->assertArrayHasKey('token', $result['access']);
        $this->assertArrayHasKey('id', $result['access']['token']);
        
    }
}