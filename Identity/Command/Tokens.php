<?php

namespace Guzzle\Openstack\Identity\Command;

use Guzzle\Openstack\Commons\AbstractJsonCommand;

/**
 * Sends a token API request
 *
 * @guzzle username doc="Username" required="true"
 * @guzzle password doc="Password" required="true"
 */
class Tokens extends AbstractJsonCommand
{
    /**
     * Set the username
     *
     * @param string $username
     *
     * @return Tokens
     */
    public function setUsername($username)
    {
        return $this->set('username', $username);
    }

    /**
     * Set the password
     *
     * @param string $password
     *
     * @return Tokens
     */
    public function setPassword($password)
    {
        return $this->set('password', $password);
    }

    protected function build()
    {
        $data = array(
            "auth" => array(
                "passwordCredentials" => array(
                    "username" => $this->get('username'),
                    "password" => $this->get('password')
                )
            )
        );
        $body = json_encode($data);
        $this->request = $this->client->post('tokens', array("Content-Type" => "application/json"), $body);
    }
}