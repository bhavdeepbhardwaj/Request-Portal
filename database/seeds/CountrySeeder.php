<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //      //
      $country = [
        [
           'name'=>'India',
           'user_id'=>'1',
          
        ],
        [
           'name'=>'Bangladesh',
           'user_id'=>'1',
         
        ],
        [
           'name'=>'Mauritius',
           'user_id'=>'1',
    
        ],
        [
            'name'=>'Srilanka',
            'user_id'=>'1',
     
         ],
        [
           'name'=>'Nepal',
           'user_id'=>'1',
         
        ],
        [
            'name'=>'India',
            'user_id'=>'2',
          
         ],
    ];

    foreach ($country as $key => $value) {
        Country::create($value);
      }
    }
}
