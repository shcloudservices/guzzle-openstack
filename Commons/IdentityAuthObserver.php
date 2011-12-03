<?php
namespace Guzzle\Openstack\Commons;
use Guzzle\Common\Event\Observer;
use Guzzle\Common\Event\Subject;
/**
 * Observador que está escuchando el evento before_send para determinar si el token está vencido
 *
 * @author  aromero, amoya
 */
class IdentityAuthObserver implements Observer{
    public function update(Subject $subject, $event, $context = null)
    {
        if($event == 'command.before_send')
        {
            $token = $subject->identiy->getToken($subject->username, $subject->password);
            $subject->setHeader('X-Auth-Token', $token);
            return;
        } 
        
        if ($event == 'request.bad_response') {
            //TODO: Implement request.bad_response
        }
    }
}

?>
