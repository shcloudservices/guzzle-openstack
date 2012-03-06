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
    public function setChangesSince($type)
    {
        return $this->set('type', $type);
    }
    
    protected function build()
    {
        $this->request = $this->client->get($this->client->getTenantId().'images');
        parent::build();
    }
}

?>
