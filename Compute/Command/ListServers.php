<?php

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Commons\AbstractJsonCommand;

/**
 * Sends a servers API request get
 *
 * @guzzle token doc="Authentication Token"
 */
class ListServers extends AbstractJsonCommand
{
    /**
     * Set the id token
     *
     * @param string $token
     *
     * @return ListServers
     */
    public function setToken($token)
    {
        return $this->set('token', $token);
    }

    protected function build()
    {
        $this->request = $this->client->get('servers', array("Content-Type" => "application/json"));
    }
}