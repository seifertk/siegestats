<?php

namespace App\Models\Api\Player;

use App\Models\Api\Player;
use App\Models\Api\ApiModel;

abstract class Stat extends ApiModel
{
    protected $name;

    public function __construct(string $type, Player $p)
    {
        $this->name = $type;
        $this->data = array_filter($p->toArray(), function ($key) {
            return strpos($key, "stats") !== false
            && strpos($key, $this->name) !== false;
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function getStat(string $stat)
    {
        return $this->get('stats.' . $this->name . ".{$stat}");
    }

    protected function getStatProgression(string $stat)
    {
        return array_values(array_filter($this->data, function ($key) {
            return strpos($key, 'progressions' !== false
            && strpos($key, $this->name) !== false
            && strpos($key, $stat) !== false);
        }, ARRAY_FILTER_USE_KEY));
    }
}
