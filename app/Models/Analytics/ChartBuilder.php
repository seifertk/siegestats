<?php

namespace App\Models\Analytics;
use App\Models\Analytics\AnalyticsBuilder;
use App\Models\Api\Player;
use App\Models\Api\Player\Stat;
use Carbon\Carbon;
use App\Models\Analytics\Charts\LineChart;

class ChartBuilder
{
    private $analytics;

    public function __construct(AnalyticsBuilder $a)
    {
        $this->analytics = $a;
    }

    /**
     * Returns a LineChart of stats per-day
     *
     * @param Player $player
     * @param string $title
     * @param string $progFn stat method that returns the stat progression array
     * @param string $totalFn stat method that returns the total, today, stat
     * @return LineChart
     */
    private function statPerDayLineChart(Player $player, string $title, string $progFn, string $totalFn) : LineChart
    {
        $casual = array_reverse($player->getStats(Stat::CASUAL)->{$progFn}());
        $ranked = array_reverse($player->getStats(Stat::RANKED)->{$progFn}());

        $casualTotal = $player->getStats(Stat::CASUAL)->{$totalFn}();
        $rankedTotal = $player->getStats(Stat::RANKED)->{$totalFn}();

        // get the number of kills achieved in each day
        $casual = array_map(function ($dayTotal) use ($casualTotal) {
            return $casualTotal - $dayTotal;
        }, $casual);

        $ranked = array_map(function ($dayTotal) use ($rankedTotal) {
            return $rankedTotal - $dayTotal;
        }, $ranked);

        $dates = array_reverse(array_map(function ($number) {
            return Carbon::now()->subdays($number)->format('Y-m-d'); 
        }, range(0, count($casual))));
        
        $datasets = [
            [
                'label' => 'Ranked',
                'data' => $ranked,
                'fill' => false,
                'borderColor' => '#F00'
            ],
            [
                'label' => 'Casual',
                'data' => $casual,
                'fill' => false,
                'borderColor' => '#00F'
            ],
        ];
        return (new LineChart)->labels($dates)->title($title)->datasets($datasets);
    }

    private function progressionLineChart(Player $player, string $title, string $fnName) : LineChart
    {
        // get the progressions in order form today -> 30 days ago
        $casual = array_reverse($player->getStats(Stat::CASUAL)->{$fnName}());
        $ranked = array_reverse($player->getStats(Stat::RANKED)->{$fnName}());

        // get the dates associated with each progression, counting back from
        // today
        $dates = array_reverse(array_map(function ($number) {
            return Carbon::now()->subdays($number)->format('Y-m-d'); 
        }, range(0, count($casual))));    
        
        $datasets = [
            [
                'label' => 'Ranked',
                'data' => $ranked,
                'fill' => false,
                'borderColor' => '#F00'
            ],
            [
                'label' => 'Casual',
                'data' => $casual,
                'fill' => false,
                'borderColor' => '#00F'
            ],
        ];      
        
        return (new LineChart)->labels($dates)->title($title)->datasets($datasets);
    }

    private function progressionWinLossLineChart(Player $player, string $title, string $fnName) : LineChart
    {
        $ranked = $player->getStats(Stat::RANKED)->{$fnName}();

        $dates = array_reverse(array_map(function ($number) {
            return Carbon::now()->subdays($number)->format('Y-m-d'); 
        }, range(0, count($ranked))));

        $datasets = [
            [
                'label' => 'Ranked',
                'data' => $ranked,
                'fill' => false,
                'borderColor' => '#F00'
            ],
        ];     

        return (new LineChart)->labels($dates)->title($title)->datasets($datasets);
    }

    public function netWinLossProgressionLineChart(Player $player) : LineChart
    {
        return $this->progressionWinLossLineChart($player, 'Net Win/Loss 30 Days', 'getNetWinLossProgression');
    }

    public function winProgressionLineChart(Player $player) : LineChart
    {
        return $this->progressionLineChart($player, 'Wins Last 30 Days', 'getWonProgression');
    }

    public function killProgressionLineChart(Player $player) : LineChart
    {
        return $this->progressionLineChart($player, 'Kills Last 30 Days', 'getKillsProgression');
    }

    public function killsPerDayLineChart(Player $player) : LineChart
    {
        return $this->statPerDayLineChart($player, 'Daily Kills', 'getKillsProgression', 'getKills');
    }

    public function winsPerDayLineChart(Player $player) : LineChart
    {
        return $this->statPerDayLineChart($player, 'Daily Wins', 'getWonProgression', 'getWon');
    }    
}