<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\userLog;
use Illuminate\Support\Facades\Log;

class LogController extends Controller {

    public function logs()
    {
        $rows = userLog::query()->get();
        return view('dashboard.logs.index',compact('rows'));
    }

}
