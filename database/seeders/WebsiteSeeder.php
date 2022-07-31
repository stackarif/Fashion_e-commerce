<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Website;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Website::create([
            'logo' => 'storage/website/logo.png',
            'email' => 'arifmahmudaj6@gmail.com',
            'phone' => '+8801864160806',
            'address' => 'Mohakhali,Dhaka,Bangladesh',
            'fb' => '#',
            'tw' => '#',
            'link' => '#',
            'ins' => '#',
            'footer_1' => 'No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no',
            'footer_2' => '© All Rights Reserved. Designed and Developed by Arif'
        ]);

        Coupon::create([
            'name' => 'covid',
            'discount' => 5,
            'status' => true,
            'expired_date' => '2024-11-25'
        ]);
    }
}
