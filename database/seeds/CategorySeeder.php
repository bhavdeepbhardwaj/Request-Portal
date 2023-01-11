<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      //
      $category = [
        [
           'name'=>'Social Media',
           'user_id'=>'1',
          
        ],
        [
           'name'=>'Retail Artwork',
           'user_id'=>'1',
         
        ],
        [
           'name'=>'Website / NEXSTMALL',
           'user_id'=>'1',
    
        ],
        [
           'name'=>'SEO',
           'user_id'=>'1',
         
        ],
        [
           'name'=>'Print Ads / Outdoor',
           'user_id'=>'1',
         
        ],
        [
            'name'=>'Content',
            'user_id'=>'1',
      
        ],
        [
            'name'=>'Reporting',
            'user_id'=>'1',
      
        ],
        [
            'name'=>'EDM',
            'user_id'=>'1',
      
        ],
        [
            'name'=>'3rd Party eCommerce',
            'user_id'=>'1',
      
        ],
        [
            'name'=>'Application Support',
            'user_id'=>'1',
      
        ],
        [
            'name'=>'Misc Work',
            'user_id'=>'1',
      
        ],
        [
            'name'=>'Social Media',
            'user_id'=>'2',
           
         ],
         [
            'name'=>'Website',
            'user_id'=>'2',
          
         ],
         [
            'name'=>'Amazon / Flipkart',
            'user_id'=>'2',
     
         ],
         [
            'name'=>'Misc',
            'user_id'=>'2',
          
         ],
    ];

    foreach ($category as $key => $value) {
        Category::create($value);
      }
    }
}
