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

    public function getLCaseName()
    {
        return $this->name;
    }

    protected function getStat(string $stat)
    {
        $key = "stats.operator.{$this->name}.{$stat}";

        // when operators are not played, they can lack data
        if (array_key_exists($key, $this->data))  {
            return $this->get($key);
        }

        return null;
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

    public function getWinLossRatio()
    {
        return $this->getRatio($this->getWon(), $this->getLost());
    }

    public function getKillDeathRatio()
    {
        return $this->getRatio($this->getKills(), $this->getDeaths());
    }

    protected function getStatProgression(string $stat)
    {
        return array_values(array_filter($this->data, function ($key) use ($stat) {
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
        return $this->getStatProgression('timePlayed');
    }
    
    private function getRatioProgression(array $lhs, array $rhs)
    {
        return array_map(function ($a, $b) {
            return $b > 0 ? (float)$a / (float)$b : 0;
        }, $lhs, $rhs);        
    }

    public function getKillDeathRatioProgression()
    {
        return $this->getRatioProgression($this->getKillsProgression(), $this->getDeathsProgression());
    }

    public function getWinLossRatioProgression()
    {
        return $this->getRatioProgression($this->getWonProgression(), $this->getLostProgression());
    }
}
