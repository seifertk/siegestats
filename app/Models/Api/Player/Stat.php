<?php

namespace App\Models\Api\Player;

use App\Models\Api\Player;
use App\Models\Api\ApiModel;

use App\Models\Api\Player\Bomb;
use App\Models\Api\Player\Casual;
use App\Models\Api\Player\General;
use App\Models\Api\Player\Hostage;
use App\Models\Api\Player\Ranked;
use App\Models\Api\Player\Secure;

abstract class Stat extends ApiModel
{
    const BOMB = 'bomb';
    const SECURE_AREA = 'secure';
    const HOSTAGE = 'hostage';
    const GENERAL = 'general';
    const PLAYER = 'general';
    const CASUAL = 'casual';
    const RANKED = 'ranked';

    protected $name;

    private function __construct(string $type, Player $p)
    {
        $this->name = $type;
        $this->data = array_filter($p->toArray(), function ($key) {
            return strpos($key, "stats") !== false
            && strpos($key, $this->name) !== false;
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function getStat(string $stat)
    {
        return $this->get('stats.' . $this->name . ".{$stat}");
    }

    protected function getStatProgression(string $stat)
    {
        return array_values(array_filter($this->data, function ($key) use ($stat) {
            return strpos($key, 'progressions') !== false
            && strpos($key, $this->name) !== false
            && strpos($key, $stat) !== false;
        }, ARRAY_FILTER_USE_KEY));
    }

        /**
         * Factory method for stat classes
         *
         * @param string $type The class to make, see constants
         * @param Player $p
         * @return Stat
         */
    final static public function make(string $type, Player $p)
    {
        switch($type) {
            case self::BOMB: return new Bomb(self::BOMB, $p);
            case self::SECURE_AREA: return new Secure(self::SECURE_AREA, $p);
            case self::HOSTAGE: return new Hostage(self::HOSTAGE, $p);
            case self::GENERAL: return new General(self::GENERAL, $p);
            case self::PLAYER: return new General(self::GENERAL, $p);
            case self::CASUAL: return new Casual(self::CASUAL, $p);
            case self::RANKED: return new Ranked(self::RANKED, $p);
            default: throw new \InvalidArgumentException();
        }
    }
}
