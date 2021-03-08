<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\This;

class DashboardController extends Controller
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $rows = $this->model::query()->get();
        return view("dashboard.". $this->getFolderName() .".index",['rows' => $rows]);
    }

    public function create()
    {
        return view('dashboard.' . $this->getFolderName() . '.create',$this->setPassParams());
    }

    public function edit($id)
    {
        $row = $this->model::query()->find($id);

        $passParams = array_merge(['row' => $row],$this->setPassParams());
        return view('dashboard.' . $this->getFolderName() . '.edit',$passParams);
    }

    public function destroy($id)
    {
        $row = $this->model::query()->find($id);
        $row->delete();

        return redirect()->back()->with('success', __('admin.destroy_success'));
    }

    public function getFolderName()
    {
        $modelName = class_basename($this->model);
        return strtolower(Pluralizer::plural($modelName));
    }

    public function setPassParams($params = [])
    {
        return $params;
    }

}
