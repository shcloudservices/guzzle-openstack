<?php

namespace Guzzle\Openstack\Tests\Identity\Common;

class IdentityTestCase extends \Guzzle\Tests\GuzzleTestCase{

    public function setUp() {
        $this->client = $this->getServiceBuilder()->get('test.identity');
    }

}

?>
