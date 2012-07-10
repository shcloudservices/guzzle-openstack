<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\Command\AbstractJsonCommand;

/**
 * Requests 200 if valid token
 *
 * @guzzle token doc="Token to check" required="true"
 * @guzzle belongsTo doc="Tenant id to check" 
 */
class CheckToken extends AbstractJsonCommand
{
    /**
     * Set the token
     *
     * @param string $token
     *
     * @return CheckToken
     */
    public function setToken($token)
    {
        return $this->set('token', $token);
    }

    /**
     * Set belongsTo
     *
     * @param string $belongsTo
     *
     * @return CheckToken
     */
    public function setBelongsTo($belongsTo)
    {
        return $this->set('belongsTo', $belongsTo);
    }
 
    protected function build()
    {
        $this->request = $this->client->head('tokens/'.$this->get('token'));        
        
        if($this->hasKey('belongsTo') && !is_null($this->get('belongsTo'))){
            $this->request->getQuery()->set('belongsTo', $this->get('belongsTo'));
        }        
        
    }
}