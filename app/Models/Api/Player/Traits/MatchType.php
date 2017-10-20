<?php

namespace App\Models\Api\Player\Traits;

// ranked, casual, etc
trait MatchType
{
    private function _getRatio($dividend, $divisor)
    {
        if (!is_numeric($dividend) || !is_numeric($divisor) || $divisor === 0) {
            return number_format(0, 2, '.', '');
        }
        return number_format($dividend / $divisor, 2, '.', '');
    }

    public function getWinLossRatio()
    {
        return $this->_getRatio($this->getWon(), $this->getLost());
    }

    public function getKillDeathRatio()
    {
        return $this->_getRatio($this->getKills(), $this->getDeaths());
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
