<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\City;
use App\Models\Config;
use App\Models\Country;
use App\Models\DeliveryNote;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * start Configs Add
         */
        $admin = Admin::create([
            'name' => 'Abdelrahman',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        $site_name = Config::create([
            'var' => 'site_name_ar',
            'display_name' => 'اسم الموقع باللغة العربية',
            'type' => 1,
            'value' => 'Site Name'
        ]);

        $site_name = Config::create([
            'var' => 'site_name_en',
            'display_name' => 'اسم الموقع باللغة الانجليزية',
            'type' => 1,
            'value' => 'Site Name'
        ]);

        $site_description = Config::create([
            'var' => 'site_desc_ar',
            'display_name' => 'نبذة عنا باللغة العربية',
            'type' => 3,
            'value' => 'Site Description'
        ]);

        $site_description = Config::create([
            'var' => 'site_desc_en',
            'display_name' => 'نبذة عنا باللغة الانجليزية',
            'type' => 3,
            'value' => 'Site Description'
        ]);

        $logo = Config::create([
            'var' => 'logo',
            'display_name' => 'لوجو ( Logo )',
            'type' => 2,
            'value' => 'default.png'
        ]);

        $phone = Config::create([
            'var' => 'phone',
            'display_name' => 'هاتف الشركة ( phone )',
            'type' => 1,
            'value' => '0123456789'
        ]);

        $email = Config::create([
            'var' => 'email',
            'display_name' => 'البريد الالكتروني ( Email )',
            'type' => 1,
            'value' => 'email@email.com'
        ]);

        $address = Config::create([
            'var' => 'address_ar',
            'display_name' => 'العنوان باللغة العربية',
            'type' => 1,
            'value' => 'Address'
        ]);

        $address = Config::create([
            'var' => 'address_en',
            'display_name' => 'العنوان باللغة الانجليزية',
            'type' => 1,
            'value' => 'Address'
        ]);

        $facebook = Config::create([
            'var' => 'facebook',
            'display_name' => 'فيس بوك ( facebook )',
            'type' => 1,
            'value' => 'facebook'
        ]);

        $twitter = Config::create([
            'var' => 'twitter',
            'display_name' => 'تويتر ( twitter )',
            'type' => 1,
            'value' => 'twitter'
        ]);

        $instagram = Config::create([
            'var' => 'instagram',
            'display_name' => 'انستجرام ( instagram )',
            'type' => 1,
            'value' => 'instagram'
        ]);

        /**
         * end Configs Add
         */


        $category = Category::create([
            'ar' => [
                'title' => 'القسم الاول',
            ],
            'en' => [
                'title' => 'First Category',
            ]
        ]);

        // Counties
        Country::create([
        'name_ar' => 'الإمارات العربية المتحدة',
        'name_en' => 'United Arab Emirates',
        ]);
        Country::create([
        'name_ar' => 'مصر',
        'name_en' => 'Egypt',
        ]);
        Country::create([
        'name_ar' => 'السعودية',
        'name_en' => 'Saudi Arabia',
        ]);
        Country::create([
        'name_ar' => 'العراق',
        'name_en' => 'Iraq',
        ]);

        // Cities
        City::create([
            'name_ar' => 'رأس الخيمة',
            'name_en' => 'Ras Al Khaimah',
            'country_id' => 1
        ]);
        City::create([
            'name_ar' => 'دبي',
            'name_en' => 'Dubai',
            'country_id' => 1
        ]);
        City::create([
            'name_ar' => 'القاهرة',
            'name_en' => 'Cairo',
            'country_id' => 2
        ]);
        City::create([
            'name_ar' => 'الاسكندرية',
            'name_en' => 'Alexandria',
            'country_id' => 2
        ]);

        State::create([
            'name_ar' => 'القصيم',
            'name_en' => 'Alcosaum',
            'country_id' => 1,
            'city_id' => 2
        ]);

        State::create([
            'name_ar' => 'الدمام',
            'name_en' => 'Aldamaam',
            'country_id' => 1,
            'city_id' => 2
        ]);

        Service::create([
           'name_ar' => 'شحن عادي',
           'name_en' => 'Normal Delivery',
           'type' => 1,
        ]);

        Service::create([
           'name_ar' => 'شحن طرد بريد ممتاز',
           'name_en' => 'Good Mail Delivery',
           'type' => 1,
        ]);

        Service::create([
           'name_ar' => 'شحن طعام',
           'name_en' => 'Delivery Food',
           'type' => 1,
        ]);

        Service::create([
           'name_ar' => 'شحن خاص',
           'name_en' => 'Private Delivery',
           'type' => 1,
        ]);

        // delivery notes
        DeliveryNote::create([
            'name_ar' => 'قابل للكسر',
            'name_en' => 'Is breakable',
        ]);
        DeliveryNote::create([
            'name_ar' => 'يحفظ في مكان بارد',
            'name_en' => 'Keep in a cool place',
        ]);
        DeliveryNote::create([
            'name_ar' => 'الاتصال قبل التوصيل',
            'name_en' => 'Contact before delivery',
        ]);
        DeliveryNote::create([
            'name_ar' => 'الاتصال بعد التوصيل',
            'name_en' => 'Contact after delivery',
        ]);
    }
}
