<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * List users
 *
 * @guzzle marker doc="Marker for pagination"
 * @guzzle limit doc="Limit for pagination"
 */
class ListUsers extends AbstractJsonCommand
{
    /**
     * Set the marker for pagination
     *
     * @param string $marker
     *
     * @return ListUsers
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
     * @return ListUsers
     */
    public function setLimit($limit)
    {
        return $this->set('limit', $limit);
    }

    protected function build()
    {
        $this->request = $this->client->get('users', array("X-Auth-Token" => $this->client->getIdentity()->getToken($this->client->getUsername(), $this->client->getPassword())));        
        
        if($this->hasKey('marker')){
            $this->request->getQuery()->set('marker', $this->get('marker'));
        }

        if($this->hasKey('limit')){
            $this->request->getQuery()->set('limit', $this->get('limit'));
        }
        
    }
}