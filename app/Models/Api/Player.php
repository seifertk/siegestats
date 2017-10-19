<?php

namespace App\Models\Api;

use App\Models\Api\Player\Operator;
use App\Models\Api\ApiModel;
use App\Models\Api\Player\Stat;

class Player extends ApiModel
{
    public function __construct(string $json) 
    {
        $this->data = array_dot(json_decode($json, true));
    }

    public function getId()
    {
        return $this->get('id');
    }

    public function getName()
    {
        return $this->get('name');
    }

    public function getPlatform()
    {
        return $this->get('platform');
    }

    public function getLevel()
    {
        return $this->get('level');
    }

    public function getLastPlayed()
    {
        return $this->get('lastPlayed.last_played');
    }

    public function getStats(string $scope)
    {
        return Stat::make($scope, $this);
    }

    public function getOperator(string $operator)
    {
        return new Operator($operator, $this);
    }

    public function getRank(int $season = null)
    {
        if ($season != null) {
            return $this->getCurrentRank();
        }
        // return ranks for each region
        $ncsa = $this->get("seasonRanks.${season}.ncsa.rank");
        $emea = $this->get("seasonRanks.${season}.emea.rank");
        $apac = $this->get("seasonRanks.${season}.apac.rank");

        return compact($ncsa, $emea, $apac);
    }

    public function getCurrentRank()
    {
        $ncsa = $this->get("rank.ncsa.rank");
        $emea = $this->get("rank.emea.rank");
        $apac = $this->get("rank.apac.rank");        

        return compact($ncsa, $emea, $apac);
    }

    public function getCompare()
    {
        $general = Stat::make("general", $this);
        $ranked = Stat::make("ranked", $this);
        $casual = Stat::make("casual", $this);
        $bomb = Stat::make("bomb", $this);
        $hostage = Stat::make("hostage", $this);
        $secure = Stat::make("secure", $this);
        
        //general stats
        $name = $this->getName();
        $level = $this->getLevel();
        $timePlayed = $this->getDuration($general->getTimePlayed());
        $wlRatio = $general->getWinLossRatio();
        $kdRatio = $general->getKillDeathRatio();
        $matchesPlayed = $general->getPlayed();

        //casual stats
        $casualKills = $casual->getKills();
        $casualDeaths = $casual->getDeaths();
        $casualWLRatio = $casual->getWinLossRatio();
        $casualKDRatio = $casual->getKillDeathRatio();
        $casualTimePlayed = $this->getDuration($casual->getTimePlayed());

        //ranked stats
        $rankedKills = $ranked->getKills();
        $rankedDeaths = $ranked->getDeaths();
        $rankedWLRatio = $ranked->getWinLossRatio();
        $rankedKDRatio = $ranked->getKillDeathRatio();
        $rankedTimePlayed = $this->getDuration($ranked->getTimePlayed());

        //misc stats
        $bulletsFired = $general->getBulletsFired();
        $bulletsHit = $general->getBulletsHit();
        $gadgetsDestroyed = $general->getGadgetsDestroyed();
        $headshot = $general->getHeadshot();
        $meleeKills = $general->getMeleeKills();
        $suicides = $general->getSuicides();
        $blindKills = $general->getBlindKills();
        $penetrationKills = $general->getPenetrationKills();

        $array = array($name, $level, $timePlayed, $wlRatio, $kdRatio, $matchesPlayed, 
            $casualKills, $casualDeaths, $casualWLRatio, $casualKDRatio, $casualTimePlayed, 
            $rankedKills, $rankedDeaths, $rankedWLRatio, $rankedKDRatio, $rankedTimePlayed,
            $bulletsFired, $bulletsHit, $gadgetsDestroyed, $headshot, $meleeKills, $suicides, $blindKills, $penetrationKills);

        return compact("name", "level", "timePlayed", "wlRatio", "kdRatio", "matchesPlayed", 
            "casualKills", "casualDeaths", "casualWLRatio", "casualKDRatio", "casualTimePlayed", 
            "rankedKills", "rankedDeaths", "rankedWLRatio", "rankedKDRatio", "rankedTimePlayed", 
            "bulletsFired", "bulletsHit", "gadgetsDestroyed", "headshot", "meleeKills", "suicides", "blindKills", "penetrationKills",
            $array);
    }

    /*
    * Converts seconds to HH:MM format
    *
    * @param int $time
    * @return string (H:MM)
    */
    public function getDuration(int $time)
    {
        $hours = floor($time / 3600);
        $minutes = round(fmod($time / 60, 60.0),0);
        return $hours ."h " .$minutes ."m";
    }

}
