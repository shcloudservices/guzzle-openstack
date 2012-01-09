<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Common;

use Guzzle\Service\Client;

/**
 * Openstack AbstractClient
 *
 * @author Adrian Moya
 */
class AbstractClient extends Client
{
    protected $username, $password, $identity, $lastCommand;
    
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function getIdentity() {
        return $this->identity;
    }
    
    /**
     * Set last command
     * @param type $command 
     */
    public function setLastCommand($command) {
        $this->lastCommand = $command;
    }
    
    /**
     * Get last command
     * @return type 
     */
    public function getLastCommand() {
        return $this->lastCommand; 
    }
    
}

?>
