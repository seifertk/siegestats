<?php

namespace App\Models\Analytics;

use App\Models\Api\Player\Stat;
use App\Models\Api\Player;
use App\Models\Api\Player\Operator;

class AnalyticsBuilder
{
    /**
     * Returns all abailable operators in the game.
     *
     * @return array
     */
    private function getOperators() : array
    {
        return config('operators');
    }
    
    /**
    * Function used to generate comparision data between 2 players that is needed for chart creation
    *
    * @param Player $player1
    * @param Player $player2
    * @return array
    */
    public static function comparePlayersAnalytics($player1, $player2)
    {
        //create the casual/ranked objects for each player
        $casualPlayer1 = Stat::make("casual", $player1);
        $casualPlayer2 = Stat::make("casual", $player2);

        $rankedPlayer1 = Stat::make("ranked", $player1);
        $rankedPlayer2 = Stat::make("ranked", $player2);

        //create the data arrays for each player for both casual and ranked
        $arrayPlayer1Casual = array($casualPlayer1->getKills(), $casualPlayer1->getDeaths(), $casualPlayer1->getWon(), $casualPlayer1->getLost(), $casualPlayer1->getPlayed());
        $arrayPlayer2Casual = array($casualPlayer2->getKills(), $casualPlayer2->getDeaths(), $casualPlayer2->getWon(), $casualPlayer2->getLost(), $casualPlayer2->getPlayed());

        $arrayPlayer1Ranked = array($rankedPlayer1->getKills(), $rankedPlayer1->getDeaths(), $rankedPlayer1->getWon(), $rankedPlayer1->getLost(), $rankedPlayer1->getPlayed());
        $arrayPlayer2Ranked = array($rankedPlayer2->getKills(), $rankedPlayer2->getDeaths(), $rankedPlayer2->getWon(), $rankedPlayer2->getLost(), $rankedPlayer2->getPlayed());

        //store the players names
        $arrayPlayerNames = array($player1->getName(), $player2->getName());
        
        //aggregate casual and ranked data and create labels required for charts
        $casualData = array($arrayPlayer1Casual, $arrayPlayer2Casual, $arrayPlayerNames);
        $rankedData = array($arrayPlayer1Ranked, $arrayPlayer2Ranked, $arrayPlayerNames);
        $labels = array("Kills", "Deaths", "Wins", "Losses", "Matches Played");
        
        return array($casualData, $rankedData, $labels);
    }

    /**
     * Returns an array of all operator stat objects for the passed player.
     *
     * @param Player $player
     * @return array Array of operators
     */
    private function getPlayerOperators(Player $player) : array
    {
        return array_map(function (string $operator) use ($player) {
            return $player->getOperator($operator);
        }, $this->getOperators());
    }

    /**
     * Get an array of operators sorted by the delta of a progression stat.
     *
     * @param Player $player
     * @param string $fnCall A method name that returns a progressive stat array
     * @return array Operators sorted by the progression stat delta
     */
    private function getOperatorProgression(Player $player, string $fnCall) : array
    {
        // get all of the player operators
        $operators = $this->getPlayerOperators($player);

        // sort them by the delta of the fnCall array
        // for example, passing 'timePlayed' will sort the operators by the delta
        // of timePlayed over the last 30 days
        usort($operators, function(Operator $lhs, Operator $rhs) use ($fnCall) {
            $lprog = $lhs->{$fnCall}();
            $rprog = $rhs->{$fnCall}();
            $ldiff = end($lprog) - reset($lprog);
            $rdiff = end($rprog) - reset($rprog);
            return $ldiff <=> $rdiff;          
        });

        return $operators;
    }

    public function operatorTimePlayedProgression(Player $player) : array
    {
        return $this->getOperatorProgression($player, 'getTimePlayedProgression');
    }

    public function operatorKillProgression(Player $player) : array
    {
        return $this->getOperatorProgression($player, 'getKillsProgression');
    }

    public function operatorDeathProgression(Player $player) : array
    {
        return $this->getOperatorProgression($player, 'getDeathsProgression');
    }    

    public function operatorWinProgression(Player $player) : array
    {
        return $this->getOperatorProgression($player, 'getWonProgression');
    }

    public function operatorLossProgression(Player $player) : array
    {
        return $this->getOperatorProgression($player, 'getLostProgression');
    }    
}