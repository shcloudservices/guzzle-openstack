<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Compute\Command;

use Guzzle\Openstack\Common\Command\AbstractJsonCommand;

/**
 * Sends a servers API request post
 *
 * @guzzle name doc="Server Name" required="true"
 * @guzzle imageRef doc="Image Reference" required="true"
 * @guzzle flavorRef doc="Flavor Reference" required="true"
 * @guzzle metadata doc="Path"
 * @guzzle personality doc="Contents"
 */
class CreateServer extends AbstractJsonCommand
{
    /**
     * Set the servername
     *
     * @param string $name
     *
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
     *
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
     *
     * @return CreateServer
     */
    public function setFlavorRef($flavorRef)
    {
        return $this->set('flavorRef', $flavorRef);
    }

    /**
     * Set the metadata - OPCIONAL
     *
     * @param string $metadata
     *
     * @return CreateServer
     */
    public function setMetadata($metadata)
    {
        return $this->set('metadata', $metadata);
    }

    /**
     * Set the personality - OPCIONAL (Array)
     *
     * @param string $personality
     *
     * @return CreateServer
     */
    public function setPersonality($path)
    {
        return $this->set('path', $path);
    }

    protected function build()
    {
        $data = array(
            "server" => array(
                "name"=> $this->get('name'),
                "imageRef" => $this->get('imageRef'),
                "flavorRef" => $this->get('flavorRef')
                )
            );
        
        if($this->hasKey('metadata')){
            $data['server']['metadata'] = $this->get('metadata');
        }
        
        if($this->hasKey('personality')){
            foreach ($this->get('personality') as $value){
                array_push($data['server']['personality'], $value);
            }
            
        }
        $body = json_encode($data);
        $this->request = $this->client->post($this->client->getTenantId().'/servers', null, $body);
    
        
    }
}