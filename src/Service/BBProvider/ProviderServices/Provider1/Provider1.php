<?php 

namespace App\Service\BBProvider\ProviderServices;

use App\Service\BBProvider\ProviderAPI\ProviderAPI;

class Provider1  extends ProviderAPI
{
    protected $key = 'provider_1';
    protected $name = 'Provider1';
    protected $serviceUrl = 'http://www.mocky.io/v2/5d47f24c330000623fa3ebfa';
    
    public function getResponse() : Provider1Response
    {
        return new Provider1Response(parent::getResponse(), $this->key);
    }
}