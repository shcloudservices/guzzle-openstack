<?php

/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Common\Command\AbstractJsonCommand;

/**
 * Get server details command
 *
 * @guzzle Id doc="Id of the server" required=true
 */
class ServerDetails extends AbstractJsonCommand
{

    /**
     * Sets the server id
     * @param type $id
     * @return type ServerDetails
     */
    public function setId($id)
    {
        return $this->set('serverId', $id);
    }
    
    protected function build()
    {
        $this->request = $this->client->get($this->client->getTenantId().'/servers/'.$this->get('serverId'));        
    }    
    
}

?>
