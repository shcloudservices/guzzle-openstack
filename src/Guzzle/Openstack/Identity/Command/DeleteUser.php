<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\Command\AbstractJsonCommand;

/**
 * Delete an user
 *
 * @guzzle id doc="Id of the user to delete" required="true"
 */
class DeleteUser extends AbstractJsonCommand
{
    /**
     * Set the user id
     *
     * @param string $id
     *
     * @return DeleteUser
     */
    public function setId($id)
    {
        return $this->set('id', $id);
    }
   
    protected function build()
    {       
        $this->request = $this->client->delete('users/'.$this->get('id'));
    }
}