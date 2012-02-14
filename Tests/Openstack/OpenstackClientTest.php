<?php

namespace Guzzle\Openstack\Tests\Openstack;

use Guzzle\Openstack\Openstack\OpenstackClient;
use Guzzle\Openstack\Common\OpenstackException;

/**
 * OpenstackClient unit tests.
 */
class OpenstackClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function setUp()
    {
        $this->client = OpenstackClient::factory(
                array(
                    'auth_url'=>'http://mykeystoneserver.com:5000/v2.0/',
                    'username'=>'username',
                    'password'=>'password',
                    'tenantName'=>'tenantName'
                    ));        
    }
    

    public function testAuthenticate()
    {       
        $this->assertTrue(is_array($this->client->getServiceCatalog()));        
    }
       
    public function testGetEndpoints()
    {
        //Wrong servicetype
        $endpoints = $this->client->getEndpoints('whatever');
        $this->assertTrue(is_array($endpoints));
        $this->assertEqual(0, count($endpoints));
        
        //With a servicetype
        $endpoints = $this->client->getEndpoints('compute');
        $this->assertEqual(3, count($endpoints));
    }
    
    
}
?>
