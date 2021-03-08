<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\userLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends DashboardController {

    protected $name = 'categories';

    public function __construct(Category $row)
    {
        parent::__construct($row);
    }

    public function store(Request $request)
    {
        $arr = [];
        foreach (config('translatable.locales') as $locale)
        {
            $arr["$locale.*"] = "required";
        }

        $data = $request->validate($arr);

        Category::query()->create($data);
        userLog::create([
            'user_name'=>auth()->user()->name,
            'user_id'=>auth()->user()->id,
            'columnAction'=>$data['category_name'],
            'logMessage'=>"تـم انـشاء قسـم بواسطة".auth('admin')->user()->name,
                  ]);
       return redirect()->route('dashboard.'. $this->name .'.index')->with('success', __('admin.store_success'));
    }

    public function update(Request $request,$id)
    {
        $arr = [];
        foreach (config('translatable.locales') as $locale)
        {
            $arr["$locale.*"] = "required";
        }

        $data = $request->validate($arr);

        $row = Category::query()->find($id);
        $row->update($data);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
        userLog::create([
            'user_name'=>auth()->user()->name,
            'user_id'=>auth()->user()->id,
            'columnAction'=>$data['category_name'],
            'logMessage'=>"تـم تحديث قسـم بواسطة".auth('admin')->user()->name,
                  ]);
    }
}
