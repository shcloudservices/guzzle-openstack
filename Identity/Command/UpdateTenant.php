<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * Update tenant
 *
 * @guzzle id doc="Tenant ID" required="true"
 * @guzzle description doc="New description of the tenant" required="true"
 * @guzzle enabled doc="New status of the tenant"
 */
class UpdateTenant extends AbstractJsonCommand
{

    /**
     * Set the tenant ID
     *
     * @param string $id
     *
     * @return UpdateTenant
     */
    public function setId($id)
    {
        return $this->set('id', $id);
    }        
    
    /**
     * Set the tenant description
     *
     * @param string $description
     *
     * @return UpdateTenant
     */
    public function setDescription($description)
    {
        return $this->set('description', $description);
    }
    
    /**
     * Set the tenant status
     *
     * @param boolean $enabled
     *
     * @return UpdateTenant
     */
    public function setEnabled($enabled)
    {
        return $this->set('enabled', $enabled);
    }    
    
    protected function build()
    {       
        $data = array(
            "tenant" => array(
                "id" => $this->get('id'),
                "description" => $this->get('description')
            )
        );
        
        if($this->hasKey('enabled')){
            $data['tenant']['enabled'] = $this->get('enabled');
        }
        
        $body = json_encode($data);        
        $this->request = $this->client->put('tenants/'.$this->get('id'), null, $body);
    }
}