<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Common\Command\PaginatedCommand;

/**
 * List servers details
 * 
 * @guzzle id doc="Id of the tenant"
 * @guzzle marker doc="Marker for pagination"
 * @guzzle limit doc="Limit for pagination"
 * @guzzle changes-since doc="Time/date stamp for when the server last changed status"
 * @guzzle image doc="Name of the image in URL format"
 * @guzzle flavor doc="Name of the flavor in URL format"
 * @guzzle name doc="Name of the server"
 * @guzzle status doc="Value of the status of the server so that you can filter "
 */
class ListServersDetails extends PaginatedCommand
{
    /**
     * Set the tenant id
     *
     * @param string $id
     *
     * @return ListServersDetails
     */
    public function setId($id)
    {
        return $this->set('id', $id);
    }
    
    /**
     * Set time/date stamp for when the server last changed status
     *
     * @param string $changesSince 
     *
     * @return ListServersDetails
     */
    public function setChangesSince ($changesSince)
    {
        return $this->set('changes-since', $changesSince);
    }
    
    /**
     * Set name of the image in URL format
     *
     * @param string $image 
     *
     * @return ListServersDetails
     */
    public function setImage ($image)
    {
        return $this->set('image', $image);
    }
    
    /**
     * Set name of the flavor in URL format
     *
     * @param string $flavor 
     *
     * @return ListServersDetails
     */
    public function setFlavor ($flavor)
    {
        return $this->set('flavor', $flavor);
    }
    
    /**
     * Set name of the server
     *
     * @param string $name 
     *
     * @return ListServersDetails
     */
    public function setName($name)
    {
        return $this->set('name', $name);
    }
    
    /**
     * Set value of the status of the server so that you can filter 
     *
     * @param string $status 
     *
     * @return ListServersDetails
     */
    public function setStatus($status)
    {
        return $this->set('status', $status);
    }
    protected function build()
    {
        $this->request = $this->client->get($this->get('id').'/servers/detail'); 
        if($this->hasKey('changes-since')){
            $this->request->getQuery()->set('changes-since', $this->get('changes-since'));
        }
        if($this->hasKey('image')){
            $this->request->getQuery()->set('image', $this->get('image'));
        }
        if($this->hasKey('flavor')){
            $this->request->getQuery()->set('flavor', $this->get('flavor'));
        }
        if($this->hasKey('name')){
            $this->request->getQuery()->set('name', $this->get('name'));
        }
         if($this->hasKey('status')){
            $this->request->getQuery()->set('status', $this->get('status'));
        }
        parent::build();
    }
}