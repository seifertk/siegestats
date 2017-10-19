<?php

namespace App\Models\Api\Player\Traits;

// ranked, casual, etc
trait MatchType
{
    public function getWinLossRatio()
    {
        return number_format($this->getWon() / $this->getLost(),2, '.', '');
    }

    public function getKillDeathRatio()
    {
        return number_format($this->getKills() / $this->getDeaths(), 2, '.', '');
    }

    public function getDeaths()
    {
        return $this->getStat('deaths');
    }

    public function getKills()
    {
        return $this->getStat('kills');
    }

    public function getLost()
    {
        return $this->getStat('lost');
    }

    public function getPlayed()
    {
        return $this->getStat('played');
    }

    public function getTimePlayed()
    {
        return $this->getStat('timePlayed');
    }

    public function getWon()
    {
        return $this->getStat('won');
    }

    public function getDeathsProgression()
    {
        return $this->getStatProgression('deaths');
    }

    public function getKillsProgression()
    {
        return $this->getStatProgression('kills');
    }

    public function getLostProgression()
    {
        return $this->getStatProgression('lost');
    }

    public function getPlayedProgression()
    {
        return $this->getStatProgression('played');
    }

    public function getTimePlayedProgression()
    {
        return $this->getStatProgression('timePlayed');
    }

    public function getWonProgression()
    {
        return $this->getStatProgression('won');
    }      
}
