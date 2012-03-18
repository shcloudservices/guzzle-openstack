Guzzle Openstack API Clients for PHP
======================================

[![Build Status](https://secure.travis-ci.org/shcloudservices/guzzle-openstack.png?branch=master)](http://travis-ci.org/shcloudservices/guzzle-openstack)

Interact with Openstack Cloud using the Guzzle framework for
building RESTful web service clients in PHP.

This is a work in progress, in it's current state is still unusable. 

## Brief explanation of the clients

*IdentityClient* - Client for Identity Service (Keystone)

*ComputeClient* - Client for Compute Service (Nova)

*StorageClient* - Client for Storage Service (Swift) <- Development hasn't started yet.

*OpenstackClient* - One client to rule them all! 

## Testing

Copy phpunit.xml.dist to phpunit.xml.  Enter the full path to your Guzzle installation in the GUZZLE server parameter of the phpunit.xml file.

### More information

- See https://github.com/guzzle/guzzle for more information about Guzzle, a PHP framework for building RESTful webservice clients.Guzzle Openstack Client
