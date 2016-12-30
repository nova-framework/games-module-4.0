<?php
namespace App\Modules\Games\Controllers;

use App\Core\Controller;
use App\Modules\Games\Models\Game;
use App\Modules\Games\Models\GamePlatform;
use App\Modules\Games\Models\GameType;
use Input;

class Games extends Controller
{
    public function index()
    {
        //init query
        $query = Game::orderBy('title');

        if (Input::exists('submit')) {

            //get form data
            $input = Input::all();

            $title = '%'.$input['title'].'%';
            $type_id = $input['type_id'];
            $platform_id = $input['platform_id'];

            //do conditions
            if ($input['title'] !='') {
                $query->where('title', 'like', $title);
            }

            if ($input['type_id'] !='') {
                $query->where('type_id', $type_id);
            }

            if ($input['platform_id'] !='') {
                $query->where('platform_id', $platform_id);
            }

        }

        //execute and pass to final variable
        $games = $query->paginate(25);

        $platforms = GamePlatform::all();
        $types = GameType::all();
        return $this->getView()
            ->shares('title', 'Manage Games')
            ->with('games', $games)
            ->with('platforms', $platforms)
            ->with('types', $types);
    }
}
