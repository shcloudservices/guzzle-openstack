<?php

/**
 * CreateContainerTest.php
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
class CreateContainerTest extends
	\Guzzle\Openstack\Tests\Storage\Common\StorageTestCase
{

	public function testCreateContainer()
	{
		$this->setMockResponse($this->client, 'storage/CreateContainer');
		$command = $this->client->getCommand('CreateContainer');
		$command->setTenantId('tenant2');
		$command->setName('container1');
		$command->prepare();

		//Check method and resource
		$this->assertEquals(
			'http://192.168.4.100:8080/v1/AUTH_tenant2/container1',
			$command->getRequest()->getUrl()
		);
		$this->assertEquals('PUT', $command->getRequest()->getMethod());

		//Check for authentication header
		$this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));

		$this->client->execute($command);
		// There's no actual result, so we have to look at the response code and
		// check the body is empty.
		$result = $command->getResponse();

		$this->assertEquals(201, $result->getStatusCode());
		$this->assertEquals(0, $result->getContentLength());
	}

	public function testCreateContainerWithMeta()
	{
		$this->setMockResponse($this->client, 'storage/CreateContainer');
		$command = $this->client->getCommand('CreateContainer');
		$command->setTenantId('Bla');
		$command->setName('container1');
		$command->setMetaData('Foo', 'Bar');
		$this->client->execute($command);
		// There's no actual result, so we have to look at the response code and
		// check the body is empty.
		$result = $command->getResponse();

		$this->assertEquals(201, $result->getStatusCode());
		$this->assertEquals(0, $result->getContentLength());
	}

	/**
	 * @expectedException Guzzle\Openstack\Storage\Exception\BadMetadataException
	 */
	public function testTooManyHeaders()
	{
		$command = $this->client->getCommand('CreateContainer');
		$command->setTenantId('Bla');
		$command->setName('containér1');
		for ($i = 0; $i <= $command::MAX_METADATA_HEADERS; $i += 1) {
			$command->setMetaData('header' . $i, 'Bar');
		}
	}

	/**
	 * @expectedException Guzzle\Openstack\Storage\Exception\BadMetadataException
	 */
	public function testMetadataKeyTooLong()
	{
		$command = $this->client->getCommand('CreateContainer');
		$command->setTenantId('Bla');
		$command->setName('container1');
		$command->setMetaData(
			str_repeat('a', $command::MAX_METADATA_KEY + 1), 'Bar'
		);
	}

	/**
	 * @expectedException Guzzle\Openstack\Storage\Exception\BadMetadataException
	 */
	public function testMetadataValueTooLong()
	{
		$command = $this->client->getCommand('CreateContainer');
		$command->setTenantId('Bla');
		$command->setName('container1');
		$command->setMetaData(
					'Foo', str_repeat('a', $command::MAX_METADATA_VALUE + 1)
				);
	}

	public function testNameRequired()
	{
		$command = $this->client->getCommand(
			'CreateContainer', array('tenantId' => 'tenant2')
		);
		$this->setExpectedException('Guzzle\Service\Exception\ValidationException');
		$command->prepare();
	}

	public function testTenantIdRequired()
	{
		$command = $this->client->getCommand(
			'CreateContainer', array('name' => 'container1')
		);
		$this->setExpectedException('Guzzle\Service\Exception\ValidationException');
		$command->prepare();
	}
}