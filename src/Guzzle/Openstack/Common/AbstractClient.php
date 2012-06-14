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
    protected $token;
    
    public function setToken($token){
        $this->token = $token;
    }
    
    public function getToken(){
        return $this->token;
    }       
}

?>
