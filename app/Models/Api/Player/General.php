<?php

namespace App\Models\Api\Player;

use App\Models\Api\Player;
use App\Models\Api\ApiModel;

class General extends ApiModel
{
    const NAME = 'general';
    
    public function __construct(Player $p)
    {
        $this->data = array_filter($p->toArray(), function ($key) {
            return strpos($key, "stats" !== false)
            && strpos($key, 'general') !== false;
        }, ARRAY_FILTER_USE_KEY);
    }

    private function getStat(string $stat)
    {
        return $this->get('stats.general')
    }
}
