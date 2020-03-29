<?php 

namespace App\Service\BBProvider\ProviderAPIResponse;

interface IProviderAPIResponse
{
    /**
     * apiden taskları ilgili cepten alıp geri döndürür.
     */
    public function getTasks() : array;
    /**
     * apiden dönen cevabının içeriğini döner.
     */
    public function getContent() : string;
    /**
     * apiden dönen cevabın durum kodunu döner.
     */
    public function getStatusCode();
}