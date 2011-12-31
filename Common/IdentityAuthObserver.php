<?php
namespace Guzzle\Openstack\Common;

use Guzzle\Common\Event\Observer;
use Guzzle\Common\Event\Subject;

/**
 * Observer to manage authentication for Openstack Clients
 *
 * @author  Andreina Romero, Adrian Moya
 */
class IdentityAuthObserver implements Observer{
    public function update(Subject $subject, $event, $context = null)
    {       
        $username = $subject->getUsername();
        $password = $subject->getPassword();
        if ($event == 'request.create') {
            $token = $subject->getIdentity()->getToken($username, $password);
            $context->setHeader('X-Auth-Token', $token);
        }
        
        elseif($event == 'request.failure') {
            if ($context->getCode() == 401) {
                $token = $subject->getIdentity()->getToken($username, $password, true);
            }
        }
    }
}

?>
