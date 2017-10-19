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

    public function getOperators()
    {
        $names = [
            "Ash",
            "Bandit",
            "Blackbeard",
            "Blitz",
            "Buck",
            "Capitao",
            "Castle",
            "Caveira",
            "Doc",
            "Echo",
            "Ela",
            "Frost",
            "Fuze",
            "Glaz",
            "Hibana",
            "IQ",
            "Jackal",
            "Jager",
            "Kapkan",
            "Lesion",
            "Mira",
            "Montagne",
            "Mute",
            "Pulse",
            "Rook",
            "Sledge",
            "Smoke",
            "Tachanka",
            "Thatcher",
            "Thermite",
            "Twitch",
            "Valkyrie",
            "Ying"
        ];

        $operators = [];
        foreach($names as $n) {
            $operators[] = new Operator($n, $this);
        }
        return $operators;
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
