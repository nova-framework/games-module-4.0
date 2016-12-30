<?php

namespace App\Modules\Games\Database\Seeds;

use Nova\Database\Seeder;
use Nova\Database\ORM\Model;
use App\Modules\Games\Models\GameType;


class ImportGameTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GameType::create(['title' => 'Physical']);
        GameType::create(['title' => 'Digital']);
    }
}
