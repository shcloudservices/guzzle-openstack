<?php
namespace Guzzle\Openstack\Common;

use Guzzle\Common\Event\Observer;
use Guzzle\Common\Event\Subject;

/**
 * Observer to manage authentication for Openstack Clients
 *
 * @author  aromero, amoya
 */
class IdentityAuthObserver implements Observer{
    public function update(Subject $subject, $event, $context = null)
    {       
        if ($event == 'request.create') {
            $username = $subject->getUsername();
            $password = $subject->getPassword();
            $token = $subject->getIdentity()->getToken($username, $password);
            $context->setHeader('X-Auth-Token', $token);            
        }
    }
}

?>
