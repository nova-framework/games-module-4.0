<?php
namespace App\Modules\Games\Controllers\Admin;

use App\Core\BackendController;
use App\Modules\Games\Models\GamePlatform;
use Input;
use Redirect;
use Validator;

class Platforms extends BackendController
{
    public function index()
    {
        $platforms = GamePlatform::orderby('title')->paginate(25);
        return $this->getView()
            ->shares('title', 'Manage Platforms')
            ->with('platforms', $platforms);
    }

    public function create()
    {
        $platforms = GamePlatform::all();
        return $this->getView()
            ->shares('title', 'Create Platform')
            ->with('platforms', $platforms);
    }

    public function store()
    {
        $input = Input::all();

        $validate = $this->validate($input);

        if ($validate->passes()) {

            //save
            $platform              = new GamePlatform();
            $platform->title       = $input['title'];
            $platform->save();

            return Redirect::to('admin/games/platforms')->withStatus('Platform Created');
        }

        return Redirect::back()->withStatus($validate->errors(), 'danger')->withInput();

    }

    public function edit($id)
    {
        $platform = GamePlatform::find($id);

        if ($platform === null) {
            return Redirect::to('admin/games/platforms')->withStatus('Platform not found', 'danger');
        }

        return $this->getView()
            ->shares('title', 'Edit Platform')
            ->with('platform', $platform);
    }

    public function update($id)
    {
        $platform = GamePlatform::find($id);

        if ($platform === null) {
            return Redirect::to('admin/games/platforms')->withStatus('Platform not found', 'danger');
        }

        $input = Input::all();

        $validate = $this->validate($input);

        if ($validate->passes()) {

            //save
            $platform->title       = $input['title'];
            $platform->save();

            return Redirect::to('admin/games/platforms')->withStatus('Platform Updated');
        }

        return Redirect::back()->withStatus($validate->errors(), 'danger')->withInput();
    }

    public function destroy($id)
    {
        $platform = GamePlatform::find($id);

        if ($platform === null) {
            return Redirect::to('admin/games/platforms')->withStatus('Platform not found', 'danger');
        }

        $platform->delete();

        return Redirect::to('admin/games/platforms')->withStatus('Platform Deleted');
    }

    protected function validate($data)
    {
        $rules = [
            'title' => 'required|min:3'
        ];

        return Validator::make($data, $rules);
    }
}
