<?php

namespace App\Models\Api\Player\Traits;

// bomb, secure, hostage, etc
trait ModeType
{
    abstract protected function getStat(string $stat);
    abstract protected function getStatProgression(string $stat);
    
    public function getBestScore()
    {
        return $this->getStat('bestScore');
    }

    public function getLost()
    {
        return $this->getStat('lost');
    }

    public function getPlayed()
    {
        return $this->getStat('played');
    }

    public function getWon()
    {
        return $this->getStat('won');
    }

    public function getBestScoreProgression()
    {
        return $this->getStatProgression('bestScore');
    }

    public function getLostProgression()
    {
        return $this->getStatProgression('lost');
    }

    public function getPlayedProgression()
    {
        return $this->getStatProgression('played');
    }

    public function getWonProgression()
    {
        return $this->getStatProgression('won');
    }    
}
