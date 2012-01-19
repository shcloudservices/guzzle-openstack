<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Common;

use Guzzle\Common\Event;

/**
 * Observer to manage authentication for Openstack Clients
 */
class IdentityAuthObserver implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'client.create_request' => 'onRequestCreate',
            'command.before_send' => 'onCommandBeforeSend',
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
        $token = $client->getIdentity()->getToken($client->getUsername(), $client->getPassword(), $client->getTenantId());
        $event['request']->setHeader('X-Auth-Token', $token);

        $event['request']->setOnComplete(function($request, $response, $default) {

            // Automatically retry if not authorized
            if ($response->getStatusCode() == 401 && !$request->getParams()->get('auth_retry')) {
                $client = $request->getParams()->get('command')->getClient();
                $token = $client->getIdentity()->getToken($client->getUsername(), $client->getPassword(), $client->getTenantId(), true);
                $cloned = clone $request;
                $cloned->getParams()->set('auth_retry', 1);
                $cloned->setHeader('X-Auth-Token', $token);
                return $cloned->send();
            }
            //Call default onComplete method
            call_user_func($default, $request, $response);
        });
    }

    /**
     * Associate the command with the request when it is created
     *
     * @param Event $event
     */
    public function onCommandBeforeSend(Event $event)
    {
        $command = $event['command'];
        $command->getRequest()->getParams()->set('command', $command);
    }
}