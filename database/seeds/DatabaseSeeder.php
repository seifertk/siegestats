<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!User::where('email','=','root@siegestats.com')->first()){
            factory(User::class, 'admin')->create();
        }
    }
}
