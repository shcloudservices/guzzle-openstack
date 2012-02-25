<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\Command\AbstractJsonCommand;

/**
 * List tenants
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
    public function setLimit($limit)
    {
        return $this->set('limit', $limit);
    }

    protected function build()
    {
        $this->request = $this->client->get('tenants');
        
        if($this->hasKey('marker')){
            $this->request->getQuery()->set('marker', $this->get('marker'));
        }

        if($this->hasKey('limit')){
            $this->request->getQuery()->set('limit', $this->get('limit'));
        }        

    }
}