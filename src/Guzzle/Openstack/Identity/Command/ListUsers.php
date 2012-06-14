<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Common\Command\PaginatedCommand;

/**
 * List users
 *
 * @guzzle marker doc="Marker for pagination"
 * @guzzle limit doc="Limit for pagination"
 */
class ListUsers extends PaginatedCommand
{
    protected function build()
    {
        $this->request = $this->client->get('users');        
        parent::build();
    }
}