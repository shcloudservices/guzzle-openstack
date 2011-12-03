<?php
namespace Guzzle\Openstack\Common;

use Guzzle\Service\Client;

/**
 * Openstack AbstractClient
 *
 * @author amoya
 */
class AbstractClient extends Client
{
    protected $username, $password, $identity, $authtoken;
    
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function getIdentity() {
        return $this->identity;
    }    
    
    public function getAuthtoken() {
        return $this->authtoken;
    }

    public function setAuthtoken($authtoken) {
        $this->authtoken = $authtoken;
    }
    
}

?>
