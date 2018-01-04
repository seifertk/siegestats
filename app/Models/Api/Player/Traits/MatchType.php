<?php

namespace App\Models\Api\Player\Traits;

// ranked, casual, etc
trait MatchType
{
    abstract protected function getRatio($divident, $divisor);
    abstract protected function getStat(string $stat);
    abstract protected function getStatProgression(string $stat);

    public function getWinLossRatio()
    {
        return $this->getRatio($this->getWon(), $this->getLost());
    }

    public function getKillDeathRatio()
    {
        return $this->getRatio($this->getKills(), $this->getDeaths());
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

    public function getNetWinLossProgression(){
        $won = array_reverse($this->getWonProgression());
        $loss = array_reverse($this->getLostProgression());

        $netWinLoss = array();
        //We set the first day of the period to 0 since we don't have a previous data point
        $netWinLoss[] = 0;

        for($i = 1;$i < count($won); ++$i)
        {
            //subtract the difference of losses from the difference of wins between the day before and the current calculated day
            $netWinLoss[] = ($won[$i] - $won[$i-1]) - ($loss[$i] - $loss[$i-1]);
        }
        return $netWinLoss;
    }
}
