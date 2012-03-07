<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Common\Command\AbstractJsonCommand;

/**
 * Returns a list of available servers
 * @guzzle image doc="Image Reference"
 * @guzzle limit doc="Limit for pagination"
 */
class ListServers extends AbstractJsonCommand
{
    protected function build()
    {
        $this->request = $this->client->get('servers');        
    }
}