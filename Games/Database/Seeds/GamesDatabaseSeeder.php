<?php

namespace App\Modules\Games\Database\Seeds;

use Nova\Database\Seeder;
use Nova\Database\ORM\Model;


class GamesDatabaseSeeder extends Seeder
{
    /**
     * Run the Database Seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('App\Modules\Games\Database\Seeds\ImportGameTypes');
    }
}
