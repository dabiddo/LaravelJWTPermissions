<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = "dabiddo@gmail.com";
        $user->name = "David Torres";
        $user->password = bcrypt("cocacola1");
        $user->save();
    }
}
