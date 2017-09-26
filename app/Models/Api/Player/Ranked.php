<?php

namespace App\Models\Api\Player;

use App\Models\Api\Player;
use App\Models\Api\Player\Stat;

class Ranked extends Stat
{
    public function getDeaths()
    {
        return $this->getStat('deaths');
    }
    
    public function getDeathsProgression()
    {
        return $this->getStatProgression('deaths');
    }
}
