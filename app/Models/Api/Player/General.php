<?php

namespace App\Models\Api\Player;

use App\Models\Api\Player;
use App\Models\Api\Player\Stat;
use App\Models\Api\Player\Traits\MatchType;

class General extends Stat
{
    use MatchType;

    public function getAssists()
    {
        return $this->getStat('assists');
    }

    public function getBlindKills()
    {
        return $this->getStat('blindKills');
    }

    public function getBulletsFired()
    {
        return $this->getStat('bulletsFired');
    }

    public function getBulletsHit()
    {
        return $this->getStat('bulletsHit');
    }

    public function getDbno()
    {
        return $this->getStat('dbno');
    }

    public function getDbnoAssists()
    {
        return $this->getStat('dbnoAssists');
    }

    public function getGadgetsDestroyed()
    {
        return $this->getStat('gadgetsDestroyed');
    }

    public function getHeadshot()
    {
        return $this->getStat('headshot');
    }

    public function getHostageDefense()
    {
        return $this->getStat('hostageDefense');
    }

    public function getHostageRescue()
    {
        return $this->getStat('hostageRescue');
    }

    public function getMeleeKills()
    {
        return $this->getStat('meleeKills');
    }

    public function getPenetrationKills()
    {
        return $this->getStat('penetrationKills');
    }

    public function getRappelBreaches()
    {
        return $this->getStat('rappelBreaches');
    }

    public function getRevives()
    {
        return $this->getStat('revives');
    }

    public function getRevivesDenied()
    {
        return $this->getStat('revivesDenied');
    }

    public function getServerAggression()
    {
        return $this->getStat('serverAggression');
    }

    public function getServerDefender()
    {
        return $this->getStat('serverDefender');
    }

    public function getServersHacked()
    {
        return $this->getStat('serversHacked');
    }

    public function getSuicides()
    {
        return $this->getStat('suicides');
    }

    public function getTimePlayed()
    {
        return $this->getStat('timePlayed');
    }

    public function getWins()
    {
        return $this->getStat('won');
    }

    public function getLosses()
    {
        return $this->getStat('lost');
    }

    public function getWinLossRatio()
    {
        return number_format($this->getWins() / $this->getLosses(),2, '.', '');
    }

    public function getKillDeathRatio()
    {
        return number_format($this->getKills() / $this->getDeaths(), 2, '.', '');
    }

    protected function getStat(string $stat)
    {
        return $this->get('stats.general.' . $stat);
    }

    public function getAssistsProgression()
    {
        return $this->getStatProgression('assists');
    }

    public function getBlindKillsProgression()
    {
        return $this->getStatProgression('blindKills');
    }

    public function getBulletsFiredProgression()
    {
        return $this->getStatProgression('bulletsFired');
    }

    public function getBulletsHitProgression()
    {
        return $this->getStatProgression('bulletsHit');
    }

    public function getDbnoProgression()
    {
        return $this->getStatProgression('dbno');
    }

    public function getDbnoAssistsProgression()
    {
        return $this->getStatProgression('dbnoAssists');
    }

    public function getGadgetsDestroyedProgression()
    {
        return $this->getStatProgression('gadgetsDestroyed');
    }

    public function getHeadshotProgression()
    {
        return $this->getStatProgression('headshot');
    }

    public function getHostageDefenseProgression()
    {
        return $this->getStatProgression('hostageDefense');
    }

    public function getHostageRescueProgression()
    {
        return $this->getStatProgression('hostageRescue');
    }

    public function getMeleeKillsProgression()
    {
        return $this->getStatProgression('meleeKills');
    }

    public function getPenetrationKillsProgression()
    {
        return $this->getStatProgression('penetrationKills');
    }

    public function getRappelBreachesProgression()
    {
        return $this->getStatProgression('rappelBreaches');
    }

    public function getRevivesProgression()
    {
        return $this->getStatProgression('revives');
    }

    public function getRevivesDeniedProgression()
    {
        return $this->getStatProgression('revivesDenied');
    }

    public function getServerAggressionProgression()
    {
        return $this->getStatProgression('serverAggression');
    }

    public function getServerDefenderProgression()
    {
        return $this->getStatProgression('serverDefender');
    }

    public function getServersHackedProgression()
    {
        return $this->getStatProgression('serversHacked');
    }

    public function getSuicidesProgression()
    {
        return $this->getStatProgression('suicides');
    }    
}
