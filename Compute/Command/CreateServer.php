<?php

namespace Guzzle\Openstack\Compute\Command;
use Guzzle\Openstack\Commons\JsonAbstractCommand;

/**
 * Sends a servers API request post
 *
 * @guzzle name doc="Server Name" required="true"
 * @guzzle imageRef doc="Image Reference" required="true"
 * @guzzle flavorRef doc="Flavor Reference" required="true"
 * @guzzle metadata doc="Metadata" required="false"
 * @guzzle path doc="Path" required="false"
 * @guzzle contents doc="Contents" required="false"
 * @guzzle token doc="Authentication Token" 
 */

class CreateServer extends JsonAbstractCommand{
    /**
     * Set the servername
     *
     * @param string $name 
     C
     * @return CreateServer
     */
    public function setName($name)
    {
        return $this->set('name', $name);
    }    
    
    /**
     * Set the image reference
     *
     * @param string $imageRef
     C
     * @return CreateServer
     */
    public function setImageRef($imageRef)
    {
        return $this->set('imageRef', $imageRef);
    } 
    
    /**
     * Set the flavor reference
     *
     * @param string $flavorRef 
     C
     * @return CreateServer
     */
    public function setFlavorRef($flavorRef)
    {
        return $this->set('flavorRef', $flavorRef);
    } 
    
    /**
     * Set the metadata
     *
     * @param string $metadata 
     C
     * @return CreateServer
     */
    public function setMetadata($metadata)
    {
        return $this->set('metadata', $metadata);
    } 
    
    /**
     * Set the path
     *
     * @param string $path 
     C
     * @return CreateServer
     */
    public function setPath($path)
    {
        return $this->set('path', $path);
    } 
    
    /**
     * Set the content 
     *
     * @param string $content
     C
     * @return CreateServer
     */
    public function setContent($content)
    {
        return $this->set('content', $content);
    } 
    
    protected function build() {
        $data = array(
            "server" => array(
                "name"=> $this->get('name'),
                "imageRef" => $this->get('imageRef'),
                "flavorRef" => $this->get('flavorRef'),
                "metadata" => $this->get('metadata'),
                "personality" =>array(
                    "path" => $this->get('path'),
                    "contents" => $this->get('contents')
                )));
        $body = json_encode($data);
        $this->request = $this->client->post('/servers', array("Content-Type" => "application/json"), $body);
        $this->request->setHeader('X-Auth-Token', $this->get('token'));
    }
    
}

?>
