<?php 

namespace  App\Service\BBProvider\ProviderServices;

use App\Service\BBProvider\ProviderExceptions\ProviderAPIInvalidResponse;

final class TaskProvider 
{
    /**
     * TODO: base folder verilerek altına provider tanımlandığında auto discovery aktif hale getirilebilir.
     */
    private $autoDiscovery = false;

    private $providers = [
        Provider1::class,
        Provider2::class
    ];

    /** Providerleri döner. */
    public function getProviders() : array
    {
        $providers = $this->providers;
        if($this->autoDiscovery) {
            //TODO - array merge
        }
        return $providers;
    }

    /**
     * Providerlardaki taskları alır.
     */
    public function getAllTasks()
    {
        $tasks = array();
        foreach($this->getProviders() as $provider)
        {
            try{
                $providerInstance = new $provider;
                $providerResponse = $providerInstance->getResponse();
                $tasks = array_merge($tasks, $providerResponse->getTasks());
            }catch(ProviderAPIInvalidResponse $exception){
                dd($exception);
                // TODO: notification yollanabilir "$providerInstance->name  providerinda hata ile karşılaşışdı. Hata detayı: $exception->getMessage()"
            }
        }
        return $tasks;
    }
}