<?php
/**
 * DeleteContainer.php
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

use Guzzle\Openstack\Common\Command\AbstractJsonCommand;
use Guzzle\Common\Exception\UnexpectedValueException;

/**
 * Delete a container
 *
 * http://docs.openstack.org/api/openstack-object-storage/1.0/content/delete-container.html
 *
 * @guzzle name doc="Name of the new container" required="true"
 * @guzzle tenantId doc="Tenant id of the new user" required="true"
 */
class DeleteContainer extends AbstractJsonCommand
{

	/**
	 * Maximum number of bytes of the container name according to the manual.
	 * http://docs.openstack.org/trunk/openstack-object-storage/developer/content/create-container.html
	 */
	const MAX_NAME_BYTES = 256;

	/**
	 * Set the user name
	 *
	 * @param string $name
	 *
	 * @return DeleteContainer
	 *
	 * @throws \Guzzle\Common\Exception\UnexpectedValueException
	 */
	public function setName($name)
	{
		// Slashes are removed
		$name = str_replace('/', '', $name);
		$bytes = mb_strlen($name, 'latin1');
		if ($bytes <= self::MAX_NAME_BYTES) {
			return $this->set('name', $name);
		} else {
			throw new UnexpectedValueException(
				"Container name may be max " . self::MAX_NAME_BYTES . " bytes!");
		}
	}

	/**
	 * Set the tenant id
	 *
	 * @param int $tenantId
	 *
	 * @return DeleteContainer
	 */
	public function setTenantId($tenantId)
	{
		return $this->set('tenantId', $tenantId);
	}

	protected function build()
	{
		$this->request = $this->client->delete(
			'AUTH_' . $this->get('tenantId') . '/' . $this->get('name')
		);
	}

}
