<?php

namespace Guzzle\Openstack\Tests\Compute\Common;

class ComputeTestCase extends \Guzzle\Tests\GuzzleTestCase{

    public function setUp() {
        $this->client = $this->getServiceBuilder()->get('test.compute');
    }

}

?>
