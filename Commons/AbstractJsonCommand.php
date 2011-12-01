<?php

namespace Guzzle\Openstack\Commons;

use Guzzle\Service\Command\AbstractCommand;

/**
 * Abstract Command with process, getResult methods implemented encoding json
 *
 * @author aromero
 */
abstract class AbstractJsonCommand extends AbstractCommand
{
    protected function process()
    {
        $response = $this->getResponse();
        $jsonresponse = $response->getBody();
        $this->result = json_decode($jsonresponse, true);
    }

    /**
     * {@inheritdoc}
     * @return Array
     */
    public function getResult()
    {
        return parent::getResult();
    }
}