<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\Command\AbstractJsonCommand;

/**
 * Update user
 *
 * @guzzle id doc="User ID" required="true"
 * @guzzle name doc="New name for the user"
 * @guzzle password doc="New password"
 * @guzzle tenant doc="New tenant for the user"
 * @guzzle enabled doc="New status of the user"
 */
class UpdateUser extends AbstractJsonCommand
{

    /**
     * Set the tenant ID
     *
     * @param string $id
     *
     * @return UpdateUser
     */
    public function setId($id)
    {
        return $this->set('id', $id);
    }        
    
    /**
     * Set the user name
     *
     * @param string $name
     *
     * @return UpdateUser
     */
    public function setName($name)
    {
        return $this->set('name', $name);
    }
    
    /**
     * Set the user email
     *
     * @param string $email
     *
     * @return UpdateUser
     */
    public function setEmail($email)
    {
        return $this->set('email', $email);
    }
    
    /**
     * Set the user password
     *
     * @param string $password
     *
     * @return UpdateUser
     */
    public function setPassword($password)
    {
        return $this->set('password', $password);
    }
    
    /**
     * Set the user tenant
     *
     * @param string $tenant
     *
     * @return UpdateUser
     */
    public function setTenant($tenant)
    {
        return $this->set('tenant', $tenant);
    }
    
    /**
     * Set the user status
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
            "user" => array(
                "id"=> $this->get('id'),
            )
        );
        
        if($this->hasKey('name')){
            $data['user']['name'] = $this->get('username');
        }
        if($this->hasKey('email')){
            $data['user']['email'] = $this->get('email');
        }
        if($this->hasKey('password')){
            $data['user']['password'] = $this->get('password');
        }
        if($this->hasKey('tenant')){
            $data['user']['tenant'] = $this->get('tenant');
        }
        if($this->hasKey('enabled')){
            $data['user']['enabled'] = $this->get('enabled');
        }
        
        $body = json_encode($data);        
        $this->request = $this->client->put('users/'.$this->get('id'), null, $body);
    }
}