<?php 

namespace App\Service\BBAssignment\AssignTask;

interface IAssignTask
{
    /**
     * atama işlemini yapan fonksiyon
     */
    public function assign() : bool;
}