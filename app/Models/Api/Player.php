<?php

namespace App\Models\Api;

use App\Models\Api\Player\Operator;
use App\Models\Api\ApiModel;
use App\Models\Api\Player\Ranked;

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
        switch ($scope) {
            case 'ranked': return new Ranked($scope, $this);
            case 'casual': return new Casual($scope, $this);
        }
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



}
