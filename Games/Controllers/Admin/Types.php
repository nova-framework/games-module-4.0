<?php
namespace App\Modules\Games\Controllers\Admin;

use App\Core\BackendController;
use App\Modules\Games\Models\GameType;
use Input;
use Redirect;
use Validator;

class Types extends BackendController
{
    public function index()
    {
        $types = GameType::orderby('title')->paginate(25);
        return $this->getView()
            ->shares('title', 'Manage Types')
            ->with('types', $types);
    }

    public function create()
    {
        $types = GameType::all();
        return $this->getView()
            ->shares('title', 'Create Type')
            ->with('types', $types);
    }

    public function store()
    {
        $input = Input::all();

        $validate = $this->validate($input);

        if ($validate->passes()) {

            //save
            $type              = new GameType();
            $type->title       = $input['title'];
            $type->save();

            return Redirect::to('admin/games/types')->withStatus('Type Created');
        }

        return Redirect::back()->withStatus($validate->errors(), 'danger')->withInput();

    }

    public function edit($id)
    {
        $type = GameType::find($id);

        if ($type === null) {
            return Redirect::to('admin/games/types')->withStatus('Type not found', 'danger');
        }

        return $this->getView()
            ->shares('title', 'Edit Type')
            ->with('type', $type);
    }

    public function update($id)
    {
        $type = GameType::find($id);

        if ($type === null) {
            return Redirect::to('admin/games/types')->withStatus('Type not found', 'danger');
        }

        $input = Input::all();

        $validate = $this->validate($input);

        if ($validate->passes()) {

            //save
            $type->title       = $input['title'];
            $type->save();

            return Redirect::to('admin/games/types')->withStatus('Type Updated');
        }

        return Redirect::back()->withStatus($validate->errors(), 'danger')->withInput();
    }

    public function destroy($id)
    {
        $type = GameType::find($id);

        if ($type === null) {
            return Redirect::to('admin/games/types')->withStatus('Type not found', 'danger');
        }

        $type->delete();

        return Redirect::to('admin/games/types')->withStatus('Type Deleted');
    }

    protected function validate($data)
    {
        $rules = [
            'title' => 'required|min:3'
        ];

        return Validator::make($data, $rules);
    }
}
