<?php

namespace Guzzle\Openstack\Tests\Identity;

use Guzzle\Openstack\Tests\Identity\Common\IdentityTestCase;
use Guzzle\Openstack\Identity\IdentityConstants;

/**
 * Test for IdentityClient
 *
 */
class IdentityClientTest extends IdentityTestCase {

    public function testAuthenticationObserver()
    {
        //Removing the authentication token
        $this->client->setToken(null);
        
        //The authentication command doesn't need a token
        $command = $this->client->getCommand(IdentityConstants::AUTHENTICATE);
        
        //Other commands need authentication token
        $this->setExpectedException('Guzzle\Openstack\Common\OpenstackException');
        $command = $this->client->getCommand(IdentityConstants::CHECK_TOKEN);
        
    }
}

?>
