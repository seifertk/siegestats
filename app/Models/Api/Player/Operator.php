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
        return $this->get("stats.operator.{$this->name}.{$stat}");
    }

    public function getName()
    {
        return $this->getStat('name');
    }

    protected function checkKey(string $stat)
    {
        if(array_key_exists("stats.operator.{$this->name}.{$stat}", $this->data))
            return true;
        else
            return false;
    }

    public function getWon()
    {
        if($this->checkKey("won"))
            return $this->getStat('won');
        else
            return 0;
    }
    

    public function getLost()
    {
        if($this->checkKey("lost"))
            return $this->getStat('lost');
        else
            return 0;
    }

    public function getKills()
    {
        if($this->checkKey("kills"))
            return $this->getStat('kills');
        else
            return 0;
    }

    public function getDeaths()
    {
        if($this->checkKey("deaths"))
            return $this->getStat('deaths');
        else
            return 0;
    }

    public function getTimePlayed()
    {
        if($this->checkKey("timePlayed"))
            return $this->toTimeString($this->getStat('timePlayed'));
        else
            return 0;
    }

    public function getWinLossRatio()
    {
        $total = $this->getWon() + $this->getLost();
        if($total > 0)
            return $this->getWon() / ($this->getWon() + $this->getLost());
        else
            return 0;
    }

    public function getKillDeathRatio()
    {
        if($this->getDeaths() > 1)
            return $this->getKills() / $this->getDeaths();
        else
            return $this->getKills();
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
