<?php
/**
 * ListContainers.php
 *
 * PHP Version 5
 *
 * @category   Guzzle
 * @package    Openstack\Storage\Command
 * @author     Patrick van Kouteren <p.vankouteren@cloudvps.com>
 * @license    MIT See the LICENSE file that was distributed with this source code.
 * @link       https://www.cloudvps.com
 */

namespace Guzzle\Openstack\Storage\Command;

use Guzzle\Openstack\Common\Command\PaginatedCommand;

/**
 * List containers
 *
 * @guzzle tenantId doc="Tenant ID" required="true"
 * @guzzle marker doc="Marker for pagination"
 * @guzzle limit doc="Limit for pagination"
 */
class ListContainers extends PaginatedCommand
{

	/**
	 * Set the tenant id
	 *
	 * @param string $tenantId
	 *
	 * @return ListContainers
	 */
	public function setTenantId($tenantId)
	{
		return $this->set('tenantId', $tenantId);
	}

	protected function build()
	{
		$this->request =
			$this->client->get('AUTH_' . $this->get('tenantId') . '?format=json');
		parent::build();
	}
}