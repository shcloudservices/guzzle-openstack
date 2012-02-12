<?php
namespace Guzzle\Openstack\Tests\Compute\Command;
/**
 * List Servers command unit test
 */
class ListServersTest extends \Guzzle\Tests\GuzzleTestCase {
    public function testListServers()
    {
       /* $authclient = \Guzzle\Openstack\Authentication\AuthenticationClient::factory(array('username' => 'username', 'password' => 'password', 'ip' => '192.168.4.100'));
        $client = \Guzzle\Openstack\Compute\ComputeClient::factory(array('identity' => $authclient, 'username'=>'username', 'password'=>'password'));
        $this->setMockResponse($client->getIdentity(), array('authentication/AuthenticateAuthorized'));  
        $this->setMockResponse($client, 'compute/ListServers');        
        $command = $client->getCommand('ListUsers');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:5000/v2.0/users', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                        
        $client->execute($command);
      
        $result = $command->getResult();
        $this->assertTrue(is_array($result));
        
        $this->assertTrue(array_key_exists('users', $result));
        */
    }
}

?>
