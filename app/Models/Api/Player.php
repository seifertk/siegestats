<?php

namespace App\Models\Api;

use App\Models\Api\Player\Operator;
use App\Models\Api\ApiModel;
use App\Models\Api\Player\Stat;
use Carbon\Carbon;

class Player extends ApiModel
{
    protected $stats = [];

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
        // the time last played is the present time minus the value in 
        // lastplayed.ranked/casual
        $recent = max($this->get('lastPlayed.casual'), $this->get('lastPlayed.ranked'));
        return Carbon::createFromTimestamp(Carbon::now()->timestamp - $recent);
    }

    public function getMatchTypes()
    {
        return array_map(function ($match) {
            return $this->getStats($match);
        }, Stat::matchTypes());
    }

    public function getModeTypes()
    {
        return array_map(function($type) {
            return $this->getStats($type);
        }, Stat::modeTypes());
    }

    public function getStats(string $scope)
    {
        // cache the stats for later retrieval
        if (!array_key_exists($scope, $this->stats)) {
            $this->stats[$scope] = Stat::make($scope, $this);
        }

        return $this->stats[$scope];
    }

    public function getOperator(string $operator)
    {
        return new Operator($operator, $this);
    }

    public function getCreatedAt()
    {
        return Carbon::parse($this->get('created_at'));
    }

    public function getRank(int $season = null)
    {
        if ($season === null) {
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
        
        $name = $this->getName();
        $level = $this->getLevel();
        $timePlayed = $this->getDuration($general->getTimePlayed());
        $wlRatio = $general->getWinLossRatio();
        $kdRatio = $general->getKillDeathRatio();

        $rankedKills = $ranked->getKills();
        $rankedDeaths = $ranked->getDeaths();

        $array = array($name, $level, $timePlayed, $wlRatio, $kdRatio, $rankedKills, $rankedDeaths);

        return compact("name", "level", "timePlayed", "wlRatio", "kdRatio", "rankedKills", "rankedDeaths", $array);

    }

    public function getDuration(int $time)
    {
        $hours = floor($time / 3600);
        $minutes = round(fmod($time / 60, 60.0),0);
        return $hours ."h " .$minutes ."m";
    }

}
