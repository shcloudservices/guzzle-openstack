<?php
/**
 * CreateContainer.php
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
use Guzzle\Openstack\Storage\Exception\BadMetadataException;
use Guzzle\Common\Exception\UnexpectedValueException;

/**
 * Command to create a container
 *
 * @guzzle name doc="Name of the new container" required="true"
 * @guzzle tenantId doc="Tenant id of the new user" required="true"
 */
class CreateContainer extends AbstractJsonCommand
{
	/**
	 * The Metadata headers for the new container
	 *
	 * @var array
	 */
	private $metadataHeaders = array();

	/**
	 * Maximum number of metadata headers according to the manual.
	 * http://docs.openstack.org/trunk/openstack-object-storage/developer/content/create-container.html
	 */
	const MAX_METADATA_HEADERS = 90;

	/**
	 * Maximum number of characters of the metadata header key according to the manual.
	 * http://docs.openstack.org/trunk/openstack-object-storage/developer/content/create-container.html
	 */
	const MAX_METADATA_KEY = 128;

	/**
	 * Maximum number of characters of the metadata header value according to the manual.
	 * http://docs.openstack.org/trunk/openstack-object-storage/developer/content/create-container.html
	 */
	const MAX_METADATA_VALUE = 256;

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
	 * @return CreateContainer
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
	 * @return CreateUser
	 */
	public function setTenantId($tenantId)
	{
		return $this->set('tenantId', $tenantId);
	}

	/**
	 * Sets a metadata header for the container which will be created.
	 *
	 * @param string $key The metadata header
	 * @param string $value
	 *
	 * @throws Guzzle\Openstack\Storage\Exception\BadMetadataException
	 */
	public function setMetadata($key, $value)
	{
		// The key and value should be encoded.
		$key = urlencode($key);
		$value = urlencode($value);

		if (count($this->metadataHeaders) < self::MAX_METADATA_HEADERS) {
			if (strlen($key) <= self::MAX_METADATA_KEY) {
				if (strlen($value) <= self::MAX_METADATA_VALUE) {
					$this->metadataHeaders['X-Container-Meta-' . $key] = $value;
				} else {
					throw new BadMetadataException(
						"Only " . self::MAX_METADATA_VALUE
						. " characters allowed for the metadata header value!");
				}
			} else {
				throw new BadMetadataException(
					"Only " . self::MAX_METADATA_KEY
					. " characters allowed for the metadata header key!");
			}
		} else {
			throw new BadMetadataException(
				"Only " . self::MAX_METADATA_HEADERS . " metadata headers allowed!");
		}
	}

	protected function build()
	{
		$this->request = $this->client->put(
			'AUTH_' . $this->get('tenantId') . '/' . $this->get('name')
		);
		// get meta data headers
		foreach ($this->metadataHeaders as $header => $value) {
			$this->request->addHeader($header, $value);
		}
	}
}
