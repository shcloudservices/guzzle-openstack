<?php

/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\AbstractJsonCommand;

/**
 * List endpoints associated with a specific token.
 * @guzzle tokenId doc="Token"
 */
class ListEndpoints extends AbstractJsonCommand {
    /**
     * Set the tokenId
     *
     * @param string $tokenId
     *
     * @return ListEndpoints
     */
    public function setTokenId($tokenId)
    {
        return $this->set('tokenId', $tokenId);
    }
    
    protected function build()
    {
        $this->request = $this->client->get('tokens/'.$this->get('tokenId').'/endpoints', array("X-Auth-Token" => $this->client->getIdentity()->getToken($this->client->getUsername(), $this->client->getPassword())));
    }
    
}

?>
