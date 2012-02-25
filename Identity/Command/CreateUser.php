<?php

/**
 * @license See the LICENSE file that was distributed with this source code.
 */
namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\Command\AbstractJsonCommand;

/**
 * Command to create a user
 * @guzzle email doc="Email of the new user" required="true"
 * @guzzle name doc="Name of the new user" required="true"
 * @guzzle password doc="Password of the new user" required="true"
 * @guzzle tenant doc="Tenant of the new user"
 * @guzzle enabled doc="Enabled state of new user"
 */
class CreateUser extends AbstractJsonCommand {

    /**
     * Set the user name
     *
     * @param string $name
     *
     * @return CreateUser
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
     * @return CreateUser
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
     * @return CreateUser
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
     * @return CreateUser
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
     * @return CreateTenant
     */
    public function setEnabled($enabled)
    {
        return $this->set('enabled', $enabled);
    }        
    
    protected function build()
    {       
        $data = array(
            "user" => array(
                "name"=> $this->get('username'),
                "email" => $this->get('email'),
                "password" => $this->get('password')
            )
        );
        
        if($this->hasKey('tenant')){
            $data['user']['tenant'] = $this->get('tenant');
        }
        if($this->hasKey('enabled')){
            $data['user']['enabled'] = $this->get('enabled');
        }

        $body = json_encode($data);        
        $this->request = $this->client->post('users', null, $body);
    }
}

?>
