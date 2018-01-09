<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Api\R6db;
use App\Models\Api\Player;
use App\Models\Analytics\AnalyticsBuilder;
use App\Models\Analytics\ChartBuilder;
use Auth;
use Session;
use Illuminate\Support\Facades\Cache;

class PlayerController extends Controller 
{
    private $chartBuilder;
    const CACHE_TIME = 15;

    public function __construct(ChartBuilder $cb)
    {
        $this->chartBuilder = $cb;
    }

    /**
     * Searches for players by name and platform and 
     * shows player(s) that match criteria
     *
     * @param   Request  $request
     * @return  view    \player\ (index.blade or profile.blade)
     */
    public function search(Request $request)
    {
        $name = $request->input('name');
        $platform = $request->input('platform');

        // give a URL with a query string for QOL
        if ($request->isMethod(Request::METHOD_POST)) {
            return redirect()->route('search', compact('name', 'platform'));
        }

        $results = json_decode(R6db::getPlayers($name, $platform));

        if(count($results) > 1) {
            return view('player.index', ['players' => $results]);
        } elseif (count($results) == 0) {
            Session::flash('message', 'No players found with the name – ' . $name);
            return redirect()->route('index');
        }

        $id = $results[0]->id;
        return redirect()->route('profile', ['id' => $id]);
    }

    private function getCharts(Player $player)
    {
        return Cache::remember($player->getId() . "-charts", static::CACHE_TIME, function () use ($player) {
            return  [
                'killsPerDayLineChart' => $this->chartBuilder->killsPerDayLineChart($player),
                'winsPerDayLineChart' => $this->chartBuilder->winsPerDayLineChart($player),
                'killProgressionLineChart' => $this->chartBuilder->killProgressionLineChart($player),
                'winProgressionLineChart' => $this->chartBuilder->winProgressionLineChart($player),
                'netWinLossProgressionLineChart' => $this->chartBuilder->netWinLossProgressionLineChart($player),
                'kdRatioProgressionLineChart' => $this->chartBuilder->kdPerDayLineChart($player),
                'operatorsKdProgressionLineCharts' => $this->chartBuilder->operatorsKdPerDayLineCharts($player),
                'operatorsWlProgressionLineCharts' => $this->chartBuilder->operatorsWinLossProgressionLineCharts($player),
            ];
        });
    }

    /**
     * Searches for player using user id and shows related player data 
     *
     * @param   string  $id
     * @return  view    \player\profile.blade.php
     */
    public function show(Request $request, $id = null)
    {
        $id = $id ?? ($request->has('id') ? $request->get('id') : null);
        $user = Auth::user();

        if ($id) {
            $player = new Player(R6db::getPlayer($id));
            $charts = $this->getCharts($player);
            return view('player.profile', compact('player', 'user', 'charts'));
        }
        
        return redirect()->back()->withError('No linked profile found');
    }

    /**
     * Shows all operators and their stats for a user.
     * (Will need to use user id in future)
     *
     * @param   string  $id
     * @return  view    \player\operatorstats.blade.php
     */
    public function operatorStats()
    {
        $user = Auth::user();
        if($user->uplay_id != null)
        {
            $arr = json_decode(R6db::getPlayer($user->uplay_id),TRUE)['stats']['operator'];
            ksort($arr);
            return view('player.operatorstats', compact('arr'));
        }
        else
        {
            Session::flash('message', 'No linked profile for user – ' . $user->email);
            return redirect()->route('index');
        }
    }

    /**
    * Compares the currently logged in users profile against anothers players and shows comparision
    * 
    * @param Request $request
    * @return view \player\compare.blade.php
    */
    public function comparePlayers(Request $request)
    {
        //Create player object based on logged in user and user comparing against
        $player1 = new Player(R6db::getPlayer(Auth::user()->uplay_id));
        $player2 = new Player(R6db::getPlayer($request->get('player_id')));

        //data and labels provided from AnalyticsBuilder, required for chart generation
        list($casualData, $rankedData, $labels) = AnalyticsBuilder::comparePlayersAnalytics($player1, $player2);
        
        $players = array($player1, $player2);
        $compareData = array();

        //Store the player data in $compareData
        for($i =0; $i < 2;++$i)
        {
            $compareData[] = $players[$i]->getCompare();
        }

        return view('player.compare', compact('compareData', 'casualData', 'rankedData', 'labels'));
    }
}
