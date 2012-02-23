<?php

namespace Guzzle\Openstack\Tests\Identity\Command;

/**
 * Check Token command unit test
 */
class CheckTokenTest extends \Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase
{

    public function testCheckToken()
    {
        $command = $this->client->getCommand('CheckToken');
        $command->setToken('token');
        $command->prepare();
      
        //Check method and resource
        $this->assertEquals('http://192.168.4.100:35357/v2.0/tokens/token', $command->getRequest()->getUrl());
        $this->assertEquals('HEAD', $command->getRequest()->getMethod());
                
        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));
                               
    }
}