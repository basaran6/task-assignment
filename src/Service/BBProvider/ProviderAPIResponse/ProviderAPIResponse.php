<?php 

namespace App\Service\BBProvider\ProviderAPIResponse;

use App\Service\BBProvider\ProviderExceptions\ProviderAPIInvalidResponse;

abstract class ProviderAPIResponse
{
    /**
     * Tasklar için dbde saklanacak özel key.
     */
    protected $providerKey;
    
    /**
     * apiden dönen cevap
     */
    protected $response;


    public function __construct($response , $providerKey)
    {
        $this->response = $response;
        if($this->response->getStatusCode() != 200) { throw new ProviderAPIInvalidResponse('Providerdan başarısız sonuç döndü.');}
        $this->providerKey = $providerKey;
    }
}