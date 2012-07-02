<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Common\Command;

use Guzzle\Service\Command\AbstractCommand;
use Guzzle\Service\Description\ApiCommand;

/**
 * Abstract Command implementing JSON Calls & returning arrays
 */
abstract class AbstractJsonCommand extends AbstractCommand
{

    public function prepare()
    {
        parent::prepare();
        return $this->getRequest()->setHeader('Content-Type' ,'application/json');
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