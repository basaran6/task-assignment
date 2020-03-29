<?php 

namespace App\Service\BBProvider\ProviderServices;

use App\Service\BBProvider\ProviderAPI\ProviderAPI;

class Provider2  extends ProviderAPI
{
    protected $key = 'provider_2';
    protected $name = 'Provider 2';
    protected $serviceUrl = 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7';
    
    public function getResponse() : Provider2Response
    {
        return new Provider2Response(parent::getResponse(), $this->key);
    }
}