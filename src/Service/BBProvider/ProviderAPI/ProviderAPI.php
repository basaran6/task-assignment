<?php 

namespace App\Service\BBProvider\ProviderAPI;

use Symfony\Component\HttpClient\HttpClient;

abstract class ProviderAPI
{
    /**
     * Provider db name
     */
    protected $key;
    /**
     * Provider adını döner.
     */
    protected $name;
    /**
     * API'nın urlini belirtir.
     */
    protected $serviceUrl;
    
    /**
     * APIden sonuç alır.
     */
    public function getResponse()
    {
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $this->serviceUrl);
        return $response;
    }
}