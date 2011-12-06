<?php

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * Sends a servers API request get
 *
 */
class ListServers extends AbstractJsonCommand
{
    protected function build()
    {
        $this->request = $this->client->get('servers', array("Content-Type" => "application/json"));
        $this->request->setHeader('X-Auth-Token', $this->client->getAuthtoken());
    }
}