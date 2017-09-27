<?php

namespace App\Models\Api\Player;
use App\Models\Api\Player;
use App\Models\Api\ApiModel;

class Operator extends ApiModel
{
    protected $data = [];
    protected $name;

    public function __construct(string $name, Player $p)
    {
        $this->data = array_filter($p->toArray(), function($key) use ($name) {
            return strpos($key, $name) !== false;
        }, ARRAY_FILTER_USE_KEY);

        $this->name = $name;
    }

    protected function getStat(string $stat)
    {
        return $this->get("stats.operator.{$this->name}.{$stat}");
    }

    public function getName()
    {
        return $this->getStat('name');
    }

    public function getWon()
    {
        return $this->getStat('won');
    }

    public function getLost()
    {
        return $this->getStat('lost');
    }

    public function getKills()
    {
        return $this->getStat('kills');
    }

    public function getDeaths()
    {
        return $this->getStat('deaths');
    }

    public function getTimePlayed()
    {
        return $this->getStat('timePlayed');
    }

    protected function getStatProgression(string $stat)
    {
        return array_values(array_filter($this->data, function ($key) {
            return strpos($key, 'progressions') !== false
                && strpos($key, $stat) !== false;
        }, ARRAY_FILTER_USE_KEY));
    }

    public function getWonProgression()
    {
        return $this->getStatProgression('won');
    }

    public function getLostProgression()
    {
        return $this->getStatProgression('lost');
    }

    public function getKillsProgression()
    {
        return $this->getStatProgression('kills');
    }

    public function getDeathsProgression()
    {
        return $this->getStatProgression('deaths');
    }

    public function getTimePlayedProgression()
    {
        return $this->getTimePlayedProgression();
    }
}
