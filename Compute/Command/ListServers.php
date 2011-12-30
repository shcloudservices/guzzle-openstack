<?php

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * Returns a list of available servers
 */
class ListServers extends AbstractJsonCommand
{
    protected function build()
    {
        $this->request = $this->client->get('servers', array("Content-Type" => "application/json"));
    }
}