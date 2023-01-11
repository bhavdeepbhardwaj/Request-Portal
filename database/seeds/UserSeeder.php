<?php

use Illuminate\Database\Seeder;
use App\Client;
use App\Admin;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = [
            [
               'name'=>'ASHPLAN Media',
               'email'=> 'info@ashplan.media',
               'password'=> bcrypt('Ashplan@1234'),
               'is_Super'=> '0',
               
            ],
        ];
        foreach ($admin as $key => $value) {
            Admin::create($value);
        }

        $client = [
            [
               'name'=>'AVITA India',
               'email'=> 'contact@avita-india.com',
               'password'=> bcrypt('Avita@1234'),
               'is_editor'=> '0',
               
            ],
            [
                'name'=>'MELIAURA',
                'email'=> 'admin@meliaura.com',
                'password'=> bcrypt('Meliaura@1234'),
                'is_editor'=> '0',
                
             ],
        ];
        foreach ($client as $key => $value) {
            Client::create($value);
        }
    }
}
