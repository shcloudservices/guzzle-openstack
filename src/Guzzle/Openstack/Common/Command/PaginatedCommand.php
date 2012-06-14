<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Common\Command;

use Guzzle\Openstack\Common\Command\AbstractJsonCommand;

/**
 * Commons functions of pagination in the commands
 *
 * @guzzle marker doc="Marker for pagination"
 * @guzzle limit doc="Limit for pagination"
 */
class PaginatedCommand extends AbstractJsonCommand{

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
        if($this->hasKey('marker')){
            $this->request->getQuery()->set('marker', $this->get('marker'));
        }

        if($this->hasKey('limit')){
            $this->request->getQuery()->set('limit', $this->get('limit'));
        }
    }
}

?>
