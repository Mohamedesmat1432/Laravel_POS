<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => 'super admin',
            'email' => 'super_admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $user->attachRole('super_admin');

    }//end of run

}//end of seeder
