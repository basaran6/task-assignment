<?php 

namespace App\Service\BBAssignment;

use App\Service\BBAssignment\AssignTask\AssignTask;
use App\Service\BBAssignment\AssignTask\IAssignTask;

class HungarianAssignTask extends AssignTask implements IAssignTask
{
    public function assign() : bool
    {
        // TODO: Eklenecek ( Farklı algoritmalar eklenebilir..  Şu an sadece custom çalışıyor.)
        return false;
    }
}