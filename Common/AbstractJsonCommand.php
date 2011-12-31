<?php

namespace Guzzle\Openstack\Common;

use Guzzle\Service\Command\AbstractCommand;
use Guzzle\Service\Description\ApiCommand;

/**
 * Abstract Command with process, getResult methods implemented encoding json
 *
 * @author aromero
 */
abstract class AbstractJsonCommand extends AbstractCommand
{

    public function prepare()
    {
        parent::prepare();
        $this->getRequest()->setHeader('Content-Type' ,'application/json');
    }
    
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