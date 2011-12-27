<?php
namespace Guzzle\Openstack\Common;

use Guzzle\Service\Client;

/**
 * Openstack AbstractClient
 *
 * @author Adrian Moya
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
    
}

?>
