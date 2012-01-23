<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * Create a new tenant
 *
 * @guzzle name doc="Name of the new tenant" required="true"
 * @guzzle description doc="Description of the new tenant"
 * @guzzle enabled doc="Enabled status of the new tenant"
 */
class CreateTenant extends AbstractJsonCommand
{
    /**
     * Set the tenant name
     *
     * @param string $name
     *
     * @return CreateTenant
     */
    public function setName($name)
    {
        return $this->set('name', $name);
    }

    /**
     * Set the tenant description
     *
     * @param string $description
     *
     * @return CreateTenant
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
     * @return CreateTenant
     */
    public function setEnabled($enabled)
    {
        return $this->set('enabled', $enabled);
    }    
    
    protected function build()
    {       
        $data = array(
            "tenant" => array(
                "name"=> $this->get('name')                
            )
        );
        if($this->hasKey('description')){
            $data['tenant']['description'] = $this->get('description');
        }
        if($this->hasKey('enabled')){
            $data['tenant']['enabled'] = $this->get('enabled');
        }

        $body = json_encode($data);        
        $this->request = $this->client->post('tenants', null, $body);
    }
}