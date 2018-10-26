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
        $user->email = "test@test.com";
        $user->name = "Test User";
        $user->password = bcrypt("password123");
        $user->save();
    }
}
