<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\EmployeeIndividualProfile;
use App\Models\PersonalProfile;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\userLog;

class UserController extends DashboardController {

    protected $name = 'users';

    public function __construct(User $row)
    {
        parent::__construct($row);
    }

    public function index(Request $request)
    {
        if ($request->has('type'))
        {
            $rows = User::query()->where('type',$request->type)->get();
        } else {
            $rows = User::query()->get();
        }
        return view('dashboard.'. $this->name .'.index',['rows' => $rows]);
    }

    public function store(Request $request)
    {
        switch ($request->type) {
            case 1:
            case 2:
                $this->insertEmployeeOrRepresentativeInformations($request);
                break;
            case 3:
                $this->insertCompanyInformations($request);
                break;
            case 4:
                $this->insertPersonalInformations($request);
                break;
        }
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> 'مستخدم جديد',
            'logMessage'=>"تم انشاء مستخدم جديد  بواسطة" . Auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.store_success'));
    }

    public function update(Request $request,$id)
    {
        $user = User::query()->find($id);
        switch ($request->type) {
            case 1:
            case 2:
                $this->updateEmployeeOrRepresentativeInformations($request,$user);
                break;
            case 3:
                $this->updateCompanyInformations($request,$user);
                break;
            case 4:
                $this->updatePersonalInformations($request,$user);
                break;
        }
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> 'مستخدم جديد',
            'logMessage'=>"تم تعديل مستخدم   بواسطة" . Auth('admin')->user()->name,
                  ]);
        return redirect()->route('dashboard.' . $this->name . '.index')->with('success', __('admin.update_success'));
    }

    public function insertEmployeeOrRepresentativeInformations(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|numeric',
            'name_ar' => 'required|max:180',
            'name_en' => 'required|max:180',
            'started_job_at' => 'required|date|max:180',
            'drive_license_end_at' => 'required|date|max:180',
            'national_license_end_at' => 'required|date|max:180',
            'passport_end_at' => 'required|date|max:180',
            'residence_end_at' => 'required|date|max:180',
            'personal_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'national_license_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'passport_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'residence_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'drive_license_number' => 'required|numeric',
            'passport_number' => 'required|string',
            'country_id' => 'required|numeric',
            'national_license_number' => 'required|numeric',
            'email' => 'sometimes|unique:users',
            'phone_number' => 'required|unique:users,phone|max:180',
            'password' => 'required|confirmed|min:6',
            'delivery_commission' => 'required',
            'receiving_commission' => 'required',
        ]);

        if ($request->hasFile('personal_photo')) {
            $image = $request->file('personal_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['personal_photo'] = $name;
        } else {
            $data['personal_photo'] = 'default.png';
        }

        if ($request->hasFile('national_license_photo')) {
            $image = $request->file('national_license_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['national_license_photo'] = $name;
        }

        if ($request->hasFile('passport_photo')) {
            $image = $request->file('passport_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['passport_photo'] = $name;
        }

        if ($request->hasFile('drive_license_photo')) {
            $image = $request->file('drive_license_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['drive_license_photo'] = $name;
        }

        if ($request->hasFile('residence_photo')) {
            $image = $request->file('residence_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['residence_photo'] = $name;
        }

        $data['password'] = bcrypt($data['password']);
        // Start the Trying to Save Data Without Error
        DB::beginTransaction();
        try {
            $user = User::query()->create([
                'email' => $data['email'],
                'phone' => $data['phone_number'],
                'type' => $data['type'],
                'password' => $data['password'],
            ]);

            $profile = EmployeeIndividualProfile::query()->create([
                'name_ar' => $data['name_ar'],
                'name_en' => $data['name_en'],
                'personal_photo' => $data['personal_photo'],
                'country_id' => $data['country_id'],
                'started_job_at' => $data['started_job_at'],
                'drive_license_photo' => $data['drive_license_photo'],
                'drive_license_end_at' => $data['drive_license_end_at'],
                'national_license_end_at' => $data['national_license_end_at'],
                'passport_end_at' => $data['passport_end_at'],
                'residence_end_at' => $data['residence_end_at'],
                'national_license_photo' => $data['national_license_photo'],
                'passport_photo' => $data['passport_photo'],
                'residence_photo' => $data['residence_photo'],
                'drive_license_number' => $data['drive_license_number'],
                'passport_number' => $data['passport_number'],
                'national_license_number' => $data['national_license_number'],
                'delivery_commission' => $data['delivery_commission'],
                'receiving_commission' => $data['receiving_commission'],
                'user_id' => $user->id,
            ]);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        DB::commit();

        return $profile;
    }
    public function updateEmployeeOrRepresentativeInformations(Request $request,$user)
    {
        $data = $request->validate([
            'type' => 'required|numeric',
            'name_ar' => 'required|max:180',
            'name_en' => 'required|max:180',
            'started_job_at' => 'required|date|max:180',
            'drive_license_end_at' => 'required|date|max:180',
            'national_license_end_at' => 'required|date|max:180',
            'passport_end_at' => 'required|date|max:180',
            'residence_end_at' => 'required|date|max:180',
            'personal_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'national_license_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'passport_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'residence_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'drive_license_number' => 'required|numeric',
            'passport_number' => 'required|string',
            'country_id' => 'required|numeric',
            'national_license_number' => 'required|numeric',
            'email' => 'sometimes|unique:users,email,'.$user->id,
            'phone_number' => 'required|max:180|unique:users,phone,'.$user->id,
            'password' => 'sometimes|nullable|confirmed|min:6',
            'delivery_commission' => 'required',
            'receiving_commission' => 'required',
        ]);

        if ($request->hasFile('personal_photo')) {
            $image = $request->file('personal_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['personal_photo'] = $name;
        } else {
            $data['personal_photo'] = $user->profile->personal_photo;
        }

        if ($request->hasFile('national_license_photo')) {
            $image = $request->file('national_license_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['national_license_photo'] = $name;
        } else {
            $data['national_license_photo'] = $user->profile->national_license_photo;
        }

        if ($request->hasFile('passport_photo')) {
            $image = $request->file('passport_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['passport_photo'] = $name;
        } else {
            $data['passport_photo'] = $user->profile->passport_photo;
        }

        if ($request->hasFile('drive_license_photo')) {
            $image = $request->file('drive_license_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['drive_license_photo'] = $name;
        } else {
            $data['drive_license_photo'] = $user->profile->drive_license_photo;
        }

        if ($request->hasFile('residence_photo')) {
            $image = $request->file('residence_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['residence_photo'] = $name;
        } else {
            $data['residence_photo'] = $user->profile->residence_photo;
        }

        if ($request->password !== null)
        {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        // Start the Trying to Save Data Without Error
        DB::beginTransaction();
        try {
            $user->update([
                'email' => $data['email'],
                'phone' => $data['phone_number'],
                'type' => $data['type'],
                'password' => $data['password'],
            ]);

            $profile = EmployeeIndividualProfile::query()->where('user_id',$user->id)->first()->update([
                'name_ar' => $data['name_ar'],
                'name_en' => $data['name_en'],
                'personal_photo' => $data['personal_photo'],
                'country_id' => $data['country_id'],
                'started_job_at' => $data['started_job_at'],
                'drive_license_photo' => $data['drive_license_photo'],
                'drive_license_end_at' => $data['drive_license_end_at'],
                'national_license_end_at' => $data['national_license_end_at'],
                'passport_end_at' => $data['passport_end_at'],
                'residence_end_at' => $data['residence_end_at'],
                'national_license_photo' => $data['national_license_photo'],
                'passport_photo' => $data['passport_photo'],
                'residence_photo' => $data['residence_photo'],
                'drive_license_number' => $data['drive_license_number'],
                'passport_number' => $data['passport_number'],
                'national_license_number' => $data['national_license_number'],
                'delivery_commission' => $data['delivery_commission'],
                'receiving_commission' => $data['receiving_commission'],
                'user_id' => $user->id,
            ]);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        DB::commit();

        return $profile;
    }

    public function insertCompanyInformations(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|numeric',
            'shop_name_ar' => 'required|max:180',
            'shop_name_en' => 'required|max:180',
            'shop_owner_name' => 'required|max:180',
            'shop_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'personal_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'contract_type' => 'required|in:1,2,3',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'contract_start_at' => 'required|date',
            'address' => 'required|max:180',
            'email' => 'sometimes|unique:users',
            'phone_number' => 'required|max:180',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($request->hasFile('personal_photo')) {
            $image = $request->file('personal_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['personal_photo'] = $name;
        } else {
            $data['personal_photo'] = 'default.png';
        }

        if ($request->hasFile('shop_photo')) {
            $image = $request->file('shop_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['shop_photo'] = $name;
        }

        $data['password'] = bcrypt($data['password']);
        // Start the Trying to Save Data Without Error
        DB::beginTransaction();
        try {
            $user = User::query()->create([
                'email' => $data['email'],
                'phone' => $data['phone_number'],
                'type' => $data['type'],
                'password' => $data['password'],
            ]);

            $profile = CompanyProfile::query()->create([
                'shop_name_ar' => $data['shop_name_ar'],
                'shop_name_en' => $data['shop_name_en'],
                'shop_owner_name' => $data['shop_owner_name'],
                'shop_photo' => $data['shop_photo'],
                'personal_photo' => $data['personal_photo'],
                'contract_type' => $data['contract_type'],
                'country_id' => $data['country_id'],
                'city_id' => $data['city_id'],
                'state_id' => $data['state_id'],
                'contract_start_at' => $data['contract_start_at'],
                'address' => $data['address'],
                'user_id' => $user->id,
            ]);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        DB::commit();

        return $profile;
    }
    public function updateCompanyInformations(Request $request,$user)
    {
        $data = $request->validate([
            'type' => 'required|numeric',
            'shop_name_ar' => 'required|max:180',
            'shop_name_en' => 'required|max:180',
            'shop_owner_name' => 'required|max:180',
            'shop_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'personal_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'contract_type' => 'required|in:1,2,3',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'contract_start_at' => 'required|date',
            'address' => 'required|max:180',
            'email' => 'sometimes|unique:users,email,'.$user->id,
            'phone_number' => 'required|max:180',
            'password' => 'sometimes|nullable|confirmed|min:6',
        ]);

        if ($request->hasFile('personal_photo')) {
            $image = $request->file('personal_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['personal_photo'] = $name;
        } else {
            $data['personal_photo'] = $user->profile->personal_photo;
        }

        if ($request->hasFile('shop_photo')) {
            $image = $request->file('shop_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['shop_photo'] = $name;
        } else {
            $data['shop_photo'] = $user->profile->shop_photo;
        }

        if ($request->password !== null)
        {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        // Start the Trying to Save Data Without Error
        DB::beginTransaction();
        try {
            $user->update([
                'email' => $data['email'],
                'phone' => $data['phone_number'],
                'type' => $data['type'],
                'password' => $data['password'],
            ]);

            $profile = CompanyProfile::query()->where('user_id',$user->id)->first()->update([
                'shop_name_ar' => $data['shop_name_ar'],
                'shop_name_en' => $data['shop_name_en'],
                'shop_owner_name' => $data['shop_owner_name'],
                'shop_photo' => $data['shop_photo'],
                'personal_photo' => $data['personal_photo'],
                'contract_type' => $data['contract_type'],
                'country_id' => $data['country_id'],
                'city_id' => $data['city_id'],
                'state_id' => $data['state_id'],
                'contract_start_at' => $data['contract_start_at'],
                'address' => $data['address'],
                'user_id' => $user->id,
            ]);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        DB::commit();

        return $profile;
    }

    public function insertPersonalInformations(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|numeric',
            'name' => 'required|max:180',
            'personal_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'address' => 'required|max:180',
            'email' => 'sometimes|unique:users',
            'phone_number' => 'required|max:180',
            'password' => 'required|confirmed|min:6',
        ]);


        if ($request->hasFile('personal_photo')) {
            $image = $request->file('personal_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['personal_photo'] = $name;
        } else {
            $data['personal_photo'] = 'default.png';
        }

        $data['password'] = bcrypt($data['password']);
        // Start the Trying to Save Data Without Error
        DB::beginTransaction();
        try {
            $user = User::query()->create([
                'email' => $data['email'],
                'phone' => $data['phone_number'],
                'type' => $data['type'],
                'password' => $data['password'],
            ]);

            $profile = PersonalProfile::query()->create([
                'name' => $data['name'],
                'personal_photo' => $data['personal_photo'],
                'country_id' => $data['country_id'],
                'city_id' => $data['city_id'],
                'state_id' => $data['state_id'],
                'address' => $data['address'],
                'user_id' => $user->id,
            ]);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        DB::commit();

        return $profile;
    }
    public function updatePersonalInformations(Request $request,$user)
    {
        $data = $request->validate([
            'type' => 'required|numeric',
            'name' => 'required|max:180',
            'personal_photo' => 'mimes:jpg,jpeg,png,gif|max:2000',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'state_id' => 'required|numeric',
            'address' => 'required|max:180',
            'email' => 'sometimes|unique:users,email,'.$user->id,
            'phone_number' => 'required|max:180',
            'password' => 'sometimes|nullable|confirmed|min:6',
        ]);

        if ($request->hasFile('personal_photo')) {
            $image = $request->file('personal_photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/dashboard/uploads/users');
            $image->move($destinationPath, $name);
            $data['personal_photo'] = $name;
        } else {
            $data['personal_photo'] = $user->profile->personal_photo;
        }

        if ($request->password !== null)
        {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        // Start the Trying to Save Data Without Error
        DB::beginTransaction();
        try {
            $user->update([
                'email' => $data['email'],
                'phone' => $data['phone_number'],
                'type' => $data['type'],
                'password' => $data['password'],
            ]);

            $profile = PersonalProfile::query()->where('user_id',$user->id)->first()->update([
                'name' => $data['name'],
                'personal_photo' => $data['personal_photo'],
                'country_id' => $data['country_id'],
                'city_id' => $data['city_id'],
                'state_id' => $data['state_id'],
                'address' => $data['address'],
                'user_id' => $user->id,
            ]);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
        DB::commit();

        return $profile;
    }

    public function relatedCountryCities(Request $request)
    {
        $cities = City::query()
            ->where('country_id',$request->country_id)
            ->where('status',1)
            ->has('states')
            ->select(['id','name_'.App()->getLocale().' as name'])
            ->get();

        return response()->json($cities);
    }

    public function relatedCityStates(Request $request)
    {
        $states = State::query()
            ->where('city_id',$request->city_id)
            ->where('status',1)
            ->select(['id','name_'.App()->getLocale().' as name'])
            ->get();

        return response()->json($states);
    }

    public function show($id)
    {
        $row = User::query()->find($id);

        $passParams = array_merge(['row' => $row],$this->setPassParams());
        return view('dashboard.' . $this->getFolderName() . '.show',$passParams);
    }

    public function addNewPersonForDelivery(Request $request)
    {
        $profile = $this->insertPersonalInformations($request);
        userLog::create([
            'user_name'=>Auth('admin')->user()->name,
            'user_id'=>Auth('admin')->user()->id,
            'columnAction'=> 'مستخدم جديد',
            'logMessage'=>"تم انشاء مستخدم جديد  بواسطة" . Auth('admin')->user()->name,
        ]);

        return response()->json($profile);
    }

    public function setPassParams($params = [])
    {
        $params['countries'] = Country::query()->where('status',1)->get();
        $params['cities'] = City::query()
            ->where('status',1)
            ->where('country_id',request('country_id'))
            ->get();
        $params['states'] = State::query()
            ->where('status',1)
            ->where('city_id',request('city_id'))
            ->get();
        return $params;
    }
}
