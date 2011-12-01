<?php
namespace Guzzle\Openstack\Commons;

/**
 * Observador que está escuchando el evento before_send para determinar si el token está vencido
 *
 * @author  aromero
 */
class IdentityAuthObserver implements Observer{
    public function update(Subject $subject, $event, $context = null)
    {
        if ($event == 'request.before_send') {
            
            
        }
    }
}

?>
