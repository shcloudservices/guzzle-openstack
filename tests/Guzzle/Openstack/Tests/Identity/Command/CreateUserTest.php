<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Create User command unit test
 */
class CreateUserTest extends \Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase
{
   
    public function testCreateUser()
    {
        $this->setMockResponse($this->client, 'identity/CreateUser');        
        $command = $this->client->getCommand('CreateUser');
        $command->setName('myusername');
        $command->setPassword('mypassword');
        $command->setEmail('myemail@email.com');
        $command->setTenantId('2');
        $command->setEnabled(true);
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/users', $command->getRequest()->getUrl());
        $this->assertEquals('POST', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));

        //Check the body of the command
        $body = $command->getRequest()->getBody()->read(200);
        $this->assertEquals('{"user":{"name":"myusername","email":"myemail@email.com","password":"mypassword","tenantId":"2","enabled":true}}', $body);
        
        $this->client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('user', $result));
        
    }
    
    public function testNameRequired()
    {
        $command = $this->client->getCommand('CreateUser', array('password' => 'mypassword', 'email' => 'myemail@email.com', 'tenantId' => '2'));
        $this->setExpectedException('Guzzle\Service\Exception\ValidationException');
        $command->prepare();
    }        
    
    public function testPasswordRequired()
    {
        $command = $this->client->getCommand('CreateUser', array('name' => 'myusername', 'email' => 'myemail@email.com',  'tenantId' => '2'));
        $this->setExpectedException('Guzzle\Service\Exception\ValidationException');
        $command->prepare();        
    }
    
    public function testEmailRequired()
    {
        $command = $this->client->getCommand('CreateUser', array('name' => 'myusername', 'password' => 'mypassword',  'tenantId' => '2'));
        $this->setExpectedException('Guzzle\Service\Exception\ValidationException');
        $command->prepare();        
    } 
    public function testTenantIdRequired()
    {
        $command = $this->client->getCommand('CreateUser', array('name' => 'myusername', 'password' => 'mypassword', 'email' => 'myemail@email.com'));
        $this->setExpectedException('Guzzle\Service\Exception\ValidationException');
        $command->prepare();        
    }
}