<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
                'name'=>'Opoo mobile',
                "price"=>"250",
                "units"=>"8",
                "category"=>"mobile",
                "description"=>"A smartphone with 8gb of RAM and IPS display",
                "gallery"=>"https://image.oppo.com/content/dam/oppo/common/mkt/v2-2/a15s/navigation/A15s-navigation-white-v2.png.thumb.webp"
            ],
            [
                'name'=>'LG TV',
                "price"=>"800",
                "units"=>"4",
                "category"=>"tv",
                "description"=>"A smart TV with alot of features",
                "gallery"=>"https://webcdn.hellotv.nl/resize?type=auto&stripmeta=true&url=https%3A%2F%2Fpimcore.hellotv.nl%2F%2FPlatteTV%2F_default_upload_bucket%2FLG-86UN85006LA-PlatteTV.nl-11.png&width=871&height=473&extend=white"
            ],
            [
                'name'=>'Sony TV',
                "price"=>"700",
                "units"=>"3",
                "category"=>"tv",
                "description"=>"A smart TV with much more features",
                "gallery"=>"https://cdn-files.kimovil.com/default/0007/16/thumb_615018_default_big.png"
            ],
            [
                'name'=>'LG fridge',
                "price"=>"600",
                "units"=>"2",
                "category"=>"fridge",
                "description"=>"A fridge with a freezer",
                "gallery"=>"https://cdn.shopify.com/s/files/1/0447/6767/4533/products/4_5f3b8297-03b0-4e9d-be68-acba688efa01_800x.jpg?v=1654147224"
            ],
    
        ]);
    }
}
