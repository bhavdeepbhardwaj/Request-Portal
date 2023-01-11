<?php

use Illuminate\Database\Seeder;
use App\Brand;


class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //
      $brand = [
        [
           'name'=>'AVITA',
           'user_id'=>'1',
          
        ],
        [
           'name'=>'NEXSTGO',
           'user_id'=>'1',
         
        ],
        [
           'name'=>'VAIO',
           'user_id'=>'1',
    
        ],
        [
           'name'=>'MELIAURA',
           'user_id'=>'2',
         
        ],
    ];

    foreach ($brand as $key => $value) {
        Brand::create($value);
      }
    }
}
