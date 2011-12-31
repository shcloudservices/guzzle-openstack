<?php

namespace Guzzle\Openstack\IdentityAuth\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * Requests a new token for username
 *
 * @guzzle username doc="Username" required="true"
 * @guzzle password doc="Password" required="true"
 * @guzzle tenantid doc="Tenant Id"
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
     * Set the tenant_id
     *
     * @param string $tenantId
     *
     * @return Authenticate
     */
    public function setTenantid($tenantId)
    {
        return $this->set('tenantid', $tenantId);
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
        if($this->hasKey('tenantid')){
            $data['auth']['tenantId'] = $this->get('tenantid');
        }
        $body = json_encode($data);
        $this->request = $this->client->post('tokens', null, $body);        
    }
}