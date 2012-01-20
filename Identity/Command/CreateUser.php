<?php

/**
 * @license See the LICENSE file that was distributed with this source code.
 */
namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;
/**
 * Command to create user
 * @guzzle email doc="Email of the new user" required="true"
 * @guzzle username doc="Name of the new user"
 * @guzzle password doc="Password of the new user"
 * @guzzle tenant doc="Tenant of the new user"
 *
 */
class CreateUser extends AbstractJsonCommand {
    /**
     * Set the user name
     *
     * @param string $username
     *
     * @return CreateUser
     */
    public function setUsername($username)
    {
        return $this->set('username', $username);
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
    
    protected function build()
    {       
        $data = array(
            "user" => array(
                "username"=> $this->get('username'),
                "email" => $this->get('email'),
                "password" => $this->get('password'),
                "tenant" => $this->get('tenant'),
            )
        );
        $body = json_encode($data);        
        $this->request = $this->client->post('user', null, $body);
    }
}

?>
