<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Common\Command\PaginatedCommand;

/**
 * List flavors command
 * 
 * @guzzle minDisk doc="Minimum disk space filter"
 * @guzzle minRam doc="Minimum ram filter"
 * @guzzle marker doc="Marker for pagination"
 * @guzzle limit doc="Limit for pagination" 
 */
class ListFlavors extends PaginatedCommand
{
    
    /**
     * Set the minDisk filter
     *
     * @param string $minDiskInGB
     *
     * @return ListFlavors
     */
    public function setMinDisk($minDiskInGB)
    {
        return $this->set('minDisk', $minDiskInGB);
    }

    /**
     * Set the minRam filter
     *
     * @param string $minRamInMB
     *
     * @return ListFlavors
     */
    public function setMinRam($minRamInMB)
    {
        return $this->set('minRam', $minRamInMB);
    }
    
    protected function build()
    {
        $this->request = $this->client->get($this->client->getTenantId().'/flavors');

        if($this->hasKey('minDisk')){
            $this->request->getQuery()->set('minDisk', $this->get('minDisk'));
        }
        
        if($this->hasKey('minRam')){
            $this->request->getQuery()->set('minRam', $this->get('minRam'));
        }
        
        parent::build();
    }
}

?>
