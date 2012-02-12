<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Openstack\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * Requests authentication info for username
 *
 * @guzzle username doc="Username" required="true"
 * @guzzle password doc="Password" required="true"
 * @guzzle tenantName doc="Tenant Name"
 */
class Authenticate extends AbstractJsonCommand
{
    /**
     * Set the username
     *
     * @param string $username
     *
     * @return Authenticate
     */
    public function setUsername($username)
    {
        return $this->set('username', $username);
    }

    /**
     * Set the password
     *
     * @param string $password
     *
     * @return Authenticate
     */
    public function setPassword($password)
    {
        return $this->set('password', $password);
    }

    /**
     * Set the tenantName
     *
     * @param string $tenantName
     *
     * @return Authenticate
     */
    public function setTenantName($tenantName)
    {
        return $this->set('tenantName', $tenantName);
    }    
    
    protected function build()
    {
        $data = array(
            'auth' => array(
                'passwordCredentials' => array(
                    'username' => $this->get('username'),
                    'password' => $this->get('password')
                )
            )
        );
        if($this->hasKey('tenantName')){
            $data['auth']['tenantName'] = $this->get('tenantName');
        }
        $body = json_encode($data);
        $this->request = $this->client->post('tokens', null, $body);        
    }
}