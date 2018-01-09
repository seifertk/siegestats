<?php

namespace App\Models\Analytics;
use App\Models\Analytics\AnalyticsBuilder;
use App\Models\Api\Player;
use App\Models\Api\Player\Stat;
use App\Models\Api\ApiModel;
use App\Models\Api\Player\Operator;
use Carbon\Carbon;
use App\Models\Analytics\Charts\LineChart;

class ChartBuilder
{
    private $analytics;
    const COLOR_RANKED = "#F00";
    const COLOR_CASUAL = "#00F";

    public function __construct(AnalyticsBuilder $a)
    {
        $this->analytics = $a;
    }

    /**
     * Returns a LineChart of stats per-day
     *
     * @param ApiModel $model
     * @param string $title
     * @param string $progFn stat method that returns the stat progression array
     * @param string $totalFn stat method that returns the total, today, stat
     * @return LineChart
     */
    private function statPerDayLineChart(ApiModel $model, string $title, string $progFn, string $totalFn) : LineChart
    {
        $casual = array_reverse($model->getStats(Stat::CASUAL)->{$progFn}());
        $ranked = array_reverse($model->getStats(Stat::RANKED)->{$progFn}());

        $casualTotal = $model->getStats(Stat::CASUAL)->{$totalFn}();
        $rankedTotal = $model->getStats(Stat::RANKED)->{$totalFn}();

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
                'borderColor' => self::COLOR_RANKED,
            ],
            [
                'label' => 'Casual',
                'data' => $casual,
                'fill' => false,
                'borderColor' => self::COLOR_CASUAL,
            ],
        ];
        return (new LineChart)->labels($dates)->title($title)->datasets($datasets);
    }

    private function getProgressionDates(array $progressionArray) : array
    {
        return array_reverse(array_map(function ($number) {
            return Carbon::now()->subdays($number)->format('Y-m-d'); 
        }, range(0, count($progressionArray))));
    }

    private function progressionLineChart(ApiModel $model, string $title, string $fnName) : LineChart
    {
        // get the progressions in order form today -> 30 days ago
        $casual = array_reverse($model->getStats(Stat::CASUAL)->{$fnName}());
        $ranked = array_reverse($model->getStats(Stat::RANKED)->{$fnName}());

        // get the dates associated with each progression, counting back from
        // today
        $dates = $this->getProgressionDates($casual); 
        
        $datasets = [
            [
                'label' => 'Ranked',
                'data' => $ranked,
                'fill' => false,
                'borderColor' => self::COLOR_RANKED,
            ],
            [
                'label' => 'Casual',
                'data' => $casual,
                'fill' => false,
                'borderColor' => self::COLOR_CASUAL,
            ],
        ];      
        
        return (new LineChart)->labels($dates)->title($title)->datasets($datasets);
    }

    private function operatorProgressionLineChart(Operator $operator, string $title, string $fnName) : LineChart
    {
        $stat = array_reverse($operator->{$fnName}());
        $dates = $this->getProgressionDates($stat);
        $datasets = [
            [
                'label' => $operator->getName(),
                'data' => $stat,
                'fill' => false,
                'borderColor' => self::COLOR_RANKED,
            ],
        ];

        return (new LineChart)->labels($dates)->title($title)->datasets($datasets);
    }

    private function progressionWinLossLineChart(ApiModel $model, string $title, string $fnName) : LineChart
    {
        $ranked = $model->getStats(Stat::RANKED)->{$fnName}();

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

    public function kdPerDayLineChart(Player $player) : LineChart
    {
        return $this->progressionLineChart($player, 'Daily K/D', 'getKillDeathRatioProgression');
    }

    public function operatorsKdPerDayLineCharts(Player $player) : array
    {
        return array_map(function (Operator $o) {
            return $this->operatorProgressionLineChart($o, 'Daily K/D', 'getKillDeathRatioProgression');
        }, $player->getOperators());
    }

    public function operatorsWinLossProgressionLineCharts(Player $player) : array
    {
        return array_map(function (Operator $o) {
            return $this->operatorProgressionLineChart($o, 'Daily W/L', 'getWinLossRatioProgression');
        }, $player->getOperators());        
    }
}
