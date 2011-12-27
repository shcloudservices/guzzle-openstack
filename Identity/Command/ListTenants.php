<?php

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * Requests a new token for username
 *
 * @guzzle marker doc="Marker for pagination"
 * @guzzle limit doc="Limit for pagination"
 */
class ListTenants extends AbstractJsonCommand
{
    /**
     * Set the marker for pagination
     *
     * @param string $marker
     *
     * @return ListTenants
     */
    public function setMarker($marker)
    {
        return $this->set('marker', $marker);
    }

    /**
     * Set the limit for pagination
     *
     * @param integer $limit
     *
     * @return ListTenants
     */
    public function setLmit($limit)
    {
        return $this->set('limit', $limit);
    }

    protected function build()
    {
        if($this->hasKey('marker')){
            $this->request->getQuery()->set('marker', $this->get('marker'));
        }

        if($this->hasKey('limit')){
            $this->request->getQuery()->set('limit', $this->get('limit'));
        }
        
        $this->request = $this->client->get('tenants', array("Content-Type" => "application/json"));
    }
}