<?php

/*
 * Openstack exception
 */
namespace Guzzle\Openstack\Common;

use Guzzle\Common\GuzzleException;
/**
 * Openstack exception
 *
 * @author aromero
 */
class OpenstackException extends \Exception implements GuzzleException
{
    /**
     * Openstack constructor
     *
     * @param string $message Message of the exception
     */
    public function __construct($message) 
    {
        parent::__construct($message);
    }
}

?>
