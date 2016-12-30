<?php

namespace App\Modules\Games\Models;

use Nova\Database\ORM\Model;


class Game extends Model
{
    public function type()
    {
        return $this->hasOne('App\Modules\Games\Models\GameType', 'id', 'type_id');
    }

    public function platform()
    {
        return $this->hasOne('App\Modules\Games\Models\GamePlatform', 'id', 'platform_id');
    }
}
