<?php
namespace Guzzle\Openstack\Compute\Command;
use Guzzle\Openstack\Commons\JsonAbstractCommand;
/**
 * Sends a servers API request get
 *
 * @guzzle token doc="Authentication Token" required="true"
 */
class RebootServer extends JsonAbstractCommand {
     protected function build() {
        $this->request = $this->client->get('/servers', array("Content-Type" => "application/json"));
        $this->request->setHeader('X-Header', $this->get('token'));
    }
}

?>
