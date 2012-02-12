<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Common;

use Guzzle\Service\Client;

/**
 * Openstack AbstractClient
 */
class AbstractClient extends Client
{
    protected $username, $password, $identity, $tenantid;
    
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function getTenantId() {
        return $this->tenantid;
    }
    
    public function getIdentity() {
        return $this->identity;
    }
       
}

?>
