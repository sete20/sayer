<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\userLog;


class TermController extends DashboardController
{
    protected $name = 'terms';

    public function __construct(Term $model)
    {
        parent::__construct($model);
    }

    public function store(request $request)
    {
        // dd($request->all());
      $data=  $request->validate([
            'name_ar'=>'required|string|min:12',
            'name_en'=>'required|string|min:12'
        ]);

        Term::create($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> 'الشروط والاحكام',
            'logMessage'=>"تم انشاء شرط جديد بواسطة" . Auth('admin')->user()->name,
                  ]);
        return redirect()->route( 'dashboard.'.$this->name . '.index')->with('success', __('admin.store_success'));

    }

    public function update(Request $request, $id)
    {
       $term= Term::find($id);
        $data=  $request->validate([
            'name_ar'=>'required|string|min:12',
            'name_en'=>'required|string|min:12'
        ]);
        $term->update($data);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> 'الشروط الاحكام',
            'logMessage'=>"تم تحديث شرط بواسطة" . Auth('admin')->user()->name,
                  ]);
        return redirect()->route( 'dashboard.'.$this->name . '.index')->with('success', __('admin.update_success'));

    }

}
