<?php

namespace App\Models\Analytics;

use App\Models\Api\Player\Stat;

class AnalyticsBuilder
{
    
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
     * Function used to generate net win/loss data for the logged in user for the past 30 days 
     * that is needed for chart generation
     * 
     * @param Player $player
     * @return array
     */
    public static function rankedProgressionAnalytics($player)
    {
        $ranked = Stat::make("ranked", $player);
        
        $won = array_reverse($ranked->getWonProgression());
        $lost = array_reverse($ranked->getLostProgression());

        $netWinLoss = array();
        $labels = array();
        //We set the first day of the period to 0 since we don't have a previous data point
        $netWinLoss[] = 0;

        for($i = 1;$i < count($won); ++$i)
        {
            //subtract the difference of losses from the difference of wins between the day before and the current calculated day
            $netWinLoss[] = ($won[$i] - $won[$i-1]) - ($lost[$i] - $lost[$i-1]);
            $labels[] = $i;
        }
        return array($netWinLoss, $labels);
    }
}