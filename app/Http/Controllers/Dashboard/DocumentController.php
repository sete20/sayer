<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\document;
use App\Models\userLog;
use Illuminate\Http\Request;
use Auth;

class DocumentController extends DashboardController
{

    protected $name = 'documents';

    public function __construct(document $model)
    {
        parent::__construct($model);
    }
    public function store(Request $request)
    {
        $companyDocuments=$request->validate([
            "document_image"=>"nullable|image|mimes:png,jpg",
            "document_name"=>"required|string",
        ]);
        if ($request->hasFile('document_image')) {
            $image = $request->file('document_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/companyDocuments/DocumentImage');
            $image->move($destinationPath, $name);
            $companyDocuments['document_image'] = $name;
        }
           document::query()->create($companyDocuments);


           userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$companyDocuments['document_name'],
            'logMessage'=>"تـم انـشاء مستند بواسطة"  .auth('admin')->user()->name,
                  ]);
            return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.store_success'));
    }


    public function update(Request $request, $id)
    {
        $document =  document::query()->find($id);
        $companyDocuments =  $request->validate([
            "document_name"=>"required|string",
            "document_image"=>"nullable|image|mimes:png,jpg",

        ]);
        if ($request->hasFile('document_image')) {
            $image = $request->file('document_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/companyDocuments/DocumentImage');
            $image->move($destinationPath, $name);
            $companyDocuments['document_image'] = $name;
        }
        // dd($request->all());
        $document->update($companyDocuments);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=>$companyDocuments['document_name'],
            'logMessage'=>"تـم تحـديث مستند بواسطة"  .auth('admin')->user()->name,
                  ]);
            return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
    }

}
