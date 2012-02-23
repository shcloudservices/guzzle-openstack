<?php

namespace Guzzle\Openstack\Tests\Identity\Common;

class IdentityTestCase extends \Guzzle\Tests\GuzzleTestCase{

    public function setUp() {
        $this->client = \Guzzle\Openstack\Identity\IdentityClient::factory(array('base_url' => 'http://192.168.4.100:35357/v2.0'));
    }

}

?>
