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
        if($event == 'command.create')
        {
            $token = $subject->getIdentity()->getToken($subject->getUsername(), $subject->getPassword());
            $subject->setAuthtoken($token);
            return;
        } 
        
        if ($event == 'request.bad_response') {
            //TODO: Implement request.bad_response
        }
    }
}

?>
