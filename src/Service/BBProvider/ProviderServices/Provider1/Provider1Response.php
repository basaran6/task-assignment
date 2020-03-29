<?php 

namespace App\Service\BBProvider\ProviderServices;

use App\Service\BBProvider\ProviderAPIResponse\IProviderAPIResponse;
use App\Service\BBProvider\ProviderAPIResponse\ProviderAPIResponse;
use App\Service\BBProvider\ProviderExceptions\ProviderAPIInvalidResponse;

class Provider1Response extends ProviderAPIResponse implements IProviderAPIResponse
{
    protected $response;
    protected $providerKey;
    
    public function getContent(): string
    {
        return $this->response->getContent();
    }

    public function getTasks(): array
    {
        $tasks = array();
        $apiResponseArray =  $this->response->toArray();
        foreach($apiResponseArray as $key=>$value)
        {
            $tasks[] = array(
                'id'    =>  $value['id'],
                'level' =>  $value['zorluk'],
                'estimated_duration' => $value['sure'],
                'provider_key' => $this->providerKey
            );
        }
        return $tasks;
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }
}