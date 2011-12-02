<?php
namespace Guzzle\Openstack\Commons;
use Guzzle\Common\Event\Observer;
use Guzzle\Common\Event\Subject;
/**
 * Observador que está escuchando el evento before_send para determinar si el token está vencido
 *
 * @author  aromero
 */
class IdentityAuthObserver implements Observer{
    public function update(Subject $subject, $event, $context = null)
    {
        if ($event == 'request.bad_response') {
            //Se debe verificar si el bad_response es el 401
            echo "Holaaaaaa";
            echo $subject->getResponse();
           
            
        }
    }
}

?>
