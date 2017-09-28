<?php

namespace App\Models\Api\Player;

use App\Models\Api\Player;
use App\Models\Api\Player\Stat;
use App\Models\Api\Player\Traits\MatchType;

class Ranked extends Stat
{
    use MatchType;
}
