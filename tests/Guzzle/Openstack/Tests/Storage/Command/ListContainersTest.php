<?php
/**
 * ListContainersTest.php
 *
 * PHP Version 5
 *
 * @category   Guzzle
 * @package    Openstack\Tests\Storage\Command
 * @author     Patrick van Kouteren <p.vankouteren@cloudvps.com>
 * @license    MIT See the LICENSE file that was distributed with this source code.
 * @link       https://www.cloudvps.com
 */

namespace Guzzle\Openstack\Tests\Storage\Command;

/**
 * List Containers command unit test
 */
class ListContainersTest extends \Guzzle\Openstack\Tests\Storage\Common\StorageTestCase
{

    public function testListContainers()
    {
        $this->setMockResponse($this->client, 'storage/ListContainers');
        $command = $this->client->getCommand('ListContainers');
	    $command->setTenantId("tenantid");
        $command->prepare();

        //Check method and resource
        $this->assertEquals('http://192.168.4.100:8080/v1/AUTH_tenantid?format=json', $command->getRequest()->getUrl());
        $this->assertEquals('GET', $command->getRequest()->getMethod());

        //Check for authentication header
        $this->assertTrue($command->getRequest()->hasHeader('X-Auth-Token'));



        $this->client->execute($command);

        $result = $command->getResult();
        $this->assertTrue(is_array($result));

        $this->assertTrue(array_key_exists('containers', $result));

    }

    public function testMarkerParameter() {
        $this->setMockResponse($this->client, 'storage/ListContainers');
        $command = $this->client->getCommand('ListContainers', array("marker" => "2"));
	    $command->setTenantId("tenantid");
        $command->prepare();
        $this->assertEquals('http://192.168.4.100:8080/v1/AUTH_tenantid?format=json&marker=2', $command->getRequest()->getUrl());
    }

	public function testTenantIdRequired()
	    {
	        $command = $this->client->getCommand('ListContainers',  array());
	        $this->setExpectedException('Guzzle\Service\Exception\ValidationException');
	        $command->prepare();
	    }


}
