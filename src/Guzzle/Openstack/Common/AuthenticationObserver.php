<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Common;

use Guzzle\Common\Event;

/**
 * Observer to manage authentication for Openstack Clients
 */
class AuthenticationObserver implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'client.create_request' => 'onRequestCreate',
            //'command.before_send' => 'onCommandBeforeSend',
            'client.command.create' => 'onClientCommandCreate'
        );
    }

    /**
     * Add authentication token as a header for requests
     *
     * @param Event $event
     */
    public function onRequestCreate(Event $event)
    {
        $client = $event['client'];
        $token = $client->getToken();
        
        $event['request']->setHeader('X-Auth-Token', $token);
    }

    /**
     * Check the client authentication token for all commands except authentication
     * 
     * @param Event $event 
     */
    public function onClientCommandCreate(\Guzzle\Common\Event $event)
    {
        $command = $event['command'];
        if(get_class($command) != 'Guzzle\Openstack\Identity\Command\Authenticate'){
            if($event['client']->getToken() == null){
                throw new OpenstackException('Unauthenticated');
            }
        }
    }
    
}