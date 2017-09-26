<?php

namespace App\Models\Api\Player;

use App\Models\Api\Player;
use App\Models\Api\ApiModel;

class Casual extends ApiModel
{
    public function __construct(Player $p)
    {
        $this->data = array_filter($p->toArray(), function ($key) {
            return strpos($key, "stats" !== false)
            && strpos($key, 'casual') !== false;
        }, ARRAY_FILTER_USE_KEY);
    }
}
