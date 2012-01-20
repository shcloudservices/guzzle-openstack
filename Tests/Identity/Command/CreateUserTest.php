<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Create User command unit test
 */
class CreateUserTest extends \Guzzle\Tests\GuzzleTestCase
{

    public function setUp()
    {
        $authclient = \Guzzle\Openstack\IdentityAuth\IdentityAuthClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100', 'port'=>'35357'));
        $this->client = \Guzzle\Openstack\Identity\IdentityClient::factory(array('identity' => $authclient, 'username'=>'username', 'password'=>'password'));        
        $this->setMockResponse($this->client->getIdentity(), 'identity_auth/AuthenticateAuthorized');                
    }
    
    public function testCreateUser()
    {
        $this->setMockResponse($this->client, 'identity/CreateUser');        
        $command = $this->client->getCommand('CreateUser');
        $command->setName('myusername');
        $command->setPassword('mypassword');
        $command->setEmail('myemail@email.com');
        $command->setTenant('2');
        $command->setEnabled(true);
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/user', $command->getRequest()->getUrl());
        $this->assertEquals('POST', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('user', $result));
        
    }
    
    public function testNameRequired()
    {
        $command = $this->client->getCommand('CreateUser', array('password' => 'mypassword', 'email' => 'myemail@email.com'));
        $this->setExpectedException('InvalidArgumentException');
        $command->prepare();
    }        
    
    public function testPasswordRequired()
    {
        $command = $this->client->getCommand('CreateUser', array('name' => 'myusername', 'email' => 'myemail@email.com'));
        $this->setExpectedException('InvalidArgumentException');
        $command->prepare();        
    }
    
    public function testEmailRequired()
    {
        $command = $this->client->getCommand('CreateUser', array('name' => 'myusername', 'password' => 'mypassword'));
        $this->setExpectedException('InvalidArgumentException');
        $command->prepare();        
    }    
}