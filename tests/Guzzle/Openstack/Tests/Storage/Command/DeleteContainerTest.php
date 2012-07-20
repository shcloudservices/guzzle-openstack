<?php
/**
 * DeleteContainerTest.php
 *
 * PHP Version 5
 *
 * @category   Guzzle
 * @package    Openstack\Tests\Storage\Command
 * @author     Patrick van Kouteren <p.vankouteren@cloudvps.com>
 * @license    MIT See the LICENSE file that was distributed with this source code.
 * @link       https://www.cloudvps.com
 *
 */

namespace Guzzle\Openstack\Tests\Storage\Command;

/**
 * Create Container command unit test
 */
class DeleteContainerTest extends
	\Guzzle\Openstack\Tests\Storage\Common\StorageTestCase
{

	public function testDeleteContainer()
	{
		$this->setMockResponse($this->client, 'storage/DeleteContainer');
		$command = $this->client->getCommand('DeleteContainer');
		$command->setTenantId('tenant2');
		$command->setName('container1');
		$command->prepare();

		//Check method and resource
		$this->assertEquals(
			'http://192.168.4.100:8080/v1/AUTH_tenant2/container1',
			$command->getRequest()->getUrl()
		);
		$this->assertEquals('DELETE', $command->getRequest()->getMethod());

		//Check for authentication header
		$this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));

		$this->client->execute($command);
		// There's no actual result, so we have to look at the response code and
		// check the body is empty.
		$result = $command->getResponse();

		$this->assertEquals(204, $result->getStatusCode());
		$this->assertEquals(0, $result->getContentLength());
	}

}