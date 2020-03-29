<?php 

namespace App\Service\BBProvider\ProviderServices;

use App\Service\BBProvider\ProviderAPIResponse\IProviderAPIResponse;
use App\Service\BBProvider\ProviderAPIResponse\ProviderAPIResponse;

class Provider2Response extends ProviderAPIResponse implements IProviderAPIResponse
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
        foreach($apiResponseArray as $value){
            $key = key($value);
            $tasks[] = array(
                'id'    =>  $key,
                'level' =>  $value[$key]['level'],
                'estimated_duration' => $value[$key]['estimated_duration'],
                'provider_name'  =>  $this->providerKey
            );
        }
        return $tasks;
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }
}