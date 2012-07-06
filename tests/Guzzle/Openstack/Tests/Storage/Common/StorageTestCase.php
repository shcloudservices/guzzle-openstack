<?php
/**
 * StorageTestCase.php
 *
 * PHP Version 5
 *
 * @category   Guzzle
 * @package    Openstack\Tests\Storage
 * @author     Patrick van Kouteren <p.vankouteren@cloudvps.com>
 * @license    MIT See the LICENSE file that was distributed with this source code.
 * @link       https://www.cloudvps.com
 */

namespace Guzzle\Openstack\Tests\Storage\Common;

class StorageTestCase extends \Guzzle\Tests\GuzzleTestCase
{

	public function setUp()
	{
		$this->client = $this->getServiceBuilder()->get('test.storage');
	}

}

?>
