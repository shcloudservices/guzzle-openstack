<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Common\Command\PaginatedCommand;

/**
 * List images command
 * 
 * @guzzle server doc="Server filter"
 * @guzzle name doc="Name filter"
 * @guzzle status doc="Status filter"
 * @guzzle changessince doc="Changes since filter"
 * @guzzle type doc="Type filter"
 */
class ListImages extends PaginatedCommand
{
    
    /**
     * Set the server filter
     *
     * @param string $serverRef
     *
     * @return ListImages
     */
    public function setFlavor($serverRef)
    {
        return $this->set('server', $serverRef);
    }

    /**
     * Set the name filter
     *
     * @param string $imageName
     *
     * @return ListImages
     */
    public function setName($imageName)
    {
        return $this->set('name', $imageName);
    }

    /**
     * Set the status filter
     *
     * @param string $imageStatus
     *
     * @return ListImages
     */
    public function setStatus($imageStatus)
    {
        return $this->set('status', $imageStatus);
    }
    
    /**
     * Set the changes-since filter
     *
     * @param string $dateTime
     *
     * @return ListImages
     */
    public function setChangesSince($dateTime)
    {
        return $this->set('changes-since', $dateTime);
    }
    
    /** Set the type filter
     *
     * @param string $type
     *
     * @return ListImages
     */
    public function setType($type)
    {
        return $this->set('type', $type);
    }
    
    protected function build()
    {
        $this->request = $this->client->get($this->client->getTenantId().'/images');

        if($this->hasKey('server')){
            $this->request->getQuery()->set('server', $this->get('server'));
        }
        
        if($this->hasKey('name')){
            $this->request->getQuery()->set('name', $this->get('name'));
        }
        
        if($this->hasKey('status')){
            $this->request->getQuery()->set('status', $this->get('status'));
        }
        
        if($this->hasKey('changes-since')){
            $this->request->getQuery()->set('changes-since', $this->get('changes-since'));
        }
        
        if($this->hasKey('type')){
            $this->request->getQuery()->set('type', $this->get('type'));
        }
        
        parent::build();
    }
}

?>
