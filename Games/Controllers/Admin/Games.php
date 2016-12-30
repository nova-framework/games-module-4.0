<?php
namespace App\Modules\Games\Controllers\Admin;

use App\Core\BackendController;
use App\Modules\Games\Models\Game;
use App\Modules\Games\Models\GamePlatform;
use App\Modules\Games\Models\GameType;
use Input;
use Redirect;
use Validator;

class Games extends BackendController
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

    public function create()
    {
        $platforms = GamePlatform::all();
        $types = GameType::all();
        return $this->getView()
            ->shares('title', 'Create Game')
            ->with('platforms', $platforms)
            ->with('types', $types);
    }

    public function store()
    {
        $input = Input::all();

        $validate = $this->validate($input);

        if ($validate->passes()) {

            //save
            $game              = new Game();
            $game->title       = $input['title'];
            $game->platform_id = $input['platform_id'];
            $game->type_id     = $input['type_id'];
            $game->save();

            return Redirect::to('admin/games')->withStatus('Game Created');
        }

        return Redirect::back()->withStatus($validate->errors(), 'danger')->withInput();

    }

    public function edit($id)
    {
        $game = Game::find($id);

        if ($game === null) {
            return Redirect::to('admin/games')->withStatus('Game not found', 'danger');
        }

        $platforms = GamePlatform::all();
        $types = GameType::all();
        return $this->getView()
            ->shares('title', 'Edit Game')
            ->with('platforms', $platforms)
            ->with('types', $types)
            ->with('game', $game);
    }

    public function update($id)
    {
        $game = Game::find($id);

        if ($game === null) {
            return Redirect::to('admin/games')->withStatus('Game not found', 'danger');
        }

        $input = Input::all();

        $validate = $this->validate($input);

        if ($validate->passes()) {

            //save
            $game->title       = $input['title'];
            $game->platform_id = $input['platform_id'];
            $game->type_id     = $input['type_id'];
            $game->save();

            return Redirect::to('admin/games')->withStatus('Game Updated');
        }

        return Redirect::back()->withStatus($validate->errors(), 'danger')->withInput();
    }

    public function destroy($id)
    {
        $game = Game::find($id);

        if ($game === null) {
            return Redirect::to('admin/games')->withStatus('Game not found', 'danger');
        }

        $game->delete();

        return Redirect::to('admin/games')->withStatus('Game Deleted');
    }

    protected function validate($data)
    {
        $rules = [
            'title'       => 'required|min:3',
            'platform_id' => 'required|integer',
            'type_id'     => 'required|integer'
        ];

        $attributes = [
            'platform_id'  => 'platform',
            'type_id'      => 'type'
        ];

        return Validator::make($data, $rules, [], $attributes);
    }
}
