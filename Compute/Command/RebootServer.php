<?php

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Commons\AbstractJsonCommand;

/**
 * Sends a servers API request get
 *
 * @guzzle token doc="Authentication Token" required="true"
 */
class RebootServer extends AbstractJsonCommand
{
     protected function build()
     {
        $this->request = $this->client->get('servers', array("Content-Type" => "application/json"));
        $this->request->setHeader('X-Header', $this->get('token'));
    }
}