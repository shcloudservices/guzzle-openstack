<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * Returns servers detail
 * 
 * @guzzle image doc="Image ID or full URL"
 * @guzzle flavor doc="Flavor ID or full URL"
 * @guzzle name doc="Server name"
 * @guzzle status doc="Server status"
 * @guzzle marker doc="ID of last item in previous list for pagination"
 * @guzzle limit doc="Page size for pagination"
 * @guzzle changes_since doc="Check for changes since datetime in ISO 8601 format"
 *  
 */
class ServerDetails extends AbstractJsonCommand
{
    
    /**
     * Set the image filter
     *
     * @param string $imageRef
     *
     * @return ServerDetails
     */
    public function setImage($imageRef)
    {
        return $this->set('image', $imageRef);
    }

    /**
     * Set the flavor filter
     *
     * @param string $flavorRef
     *
     * @return ServerDetails
     */
    public function setFlavor($flavorRef)
    {
        return $this->set('flavor', $flavorRef);
    }
    
    /**
     * Set the name filter
     *
     * @param string $serverName
     *
     * @return ServerDetails
     */
    public function setName($serverName)
    {
        return $this->request->getQuery()->set('name', $serverName);
    }
    
    /**
     * Set the status filter
     *
     * @param string $serverStatus
     *
     * @return ServerDetails
     */
    public function setStatus($serverStatus)
    {
        return $this->set('status', $serverStatus);
    }
    
    /**
     * Set marker for pagination
     *
     * @param string $markerID
     *
     * @return ServerDetails
     */
    public function setMarker($markerID)
    {
        return $this->set('marker', $markerID);
    }    

    /**
     * Set limit of results per page
     *
     * @param integer $limit
     *
     * @return ServerDetails
     */
    public function setLimit($limit)
    {
        return $this->set('limit', $limit);
    }    
    
    /**
     * Set changes-since filter
     *
     * @param timestamp $changesSince
     *
     * @return ServerDetails
     */
    public function setChangesSince($changesSince)
    {
        return $this->set('changes-since', $changesSince);
    }        
    
    protected function build()
    {
        $this->request = $this->client->get('servers/detail', array("Content-Type" => "application/json"));       
    }
}