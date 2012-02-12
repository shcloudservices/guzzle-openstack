<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * Delete a tenant
 *
 * @guzzle id doc="Id of the tenant to delete" required="true"
 */
class DeleteTenant extends AbstractJsonCommand
{
    /**
     * Set the tenant id
     *
     * @param string $id
     *
     * @return DeleteTenant
     */
    public function setId($id)
    {
        return $this->set('id', $id);
    }
   
    protected function build()
    {       
        $this->request = $this->client->delete('tenants/'.$this->get('id'));
    }
}