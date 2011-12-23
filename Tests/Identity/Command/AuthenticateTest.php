<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Authenticate command unit test
 * @author Adrian Moya
 */
class AuthenticateTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function testAuthenticate()
    {
        $command = new \Guzzle\Openstack\Identity\Command\Authenticate();
        $client = $this->getServiceBuilder()->get('test.identity');
        $command->setUsername('username');
        $command->setPassword('password');
        $this->setMockResponse($client, 'identity/AuthenticateAuthorized');
        
        $client->execute($command);
        
        $this->assertEquals('http://192.168.4.100:5000/v2.0/tokens', $command->getRequest()->getUrl());
    }
}