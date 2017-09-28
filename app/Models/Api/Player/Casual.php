<?php

namespace App\Models\Api\Player;

use App\Models\Api\Player;
use App\Models\Api\Player\Stat;
use App\Models\Api\Player\Traits\MatchType;

class Casual extends Stat
{
    use MatchType;
}
