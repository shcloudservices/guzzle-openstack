<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\Command\Paginator;

/**
 * List users
 *
 * @inheritdoc
 */
class ListUsers extends Paginator
{
    protected function build()
    {
        parent::build();
        
        $this->request = $this->client->get('users', array("X-Auth-Token" => $this->client->getIdentity()->getToken($this->client->getUsername(), $this->client->getPassword())));
    }
}