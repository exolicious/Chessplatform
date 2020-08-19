<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
    		// Create one user for admin-login
    		$user = new User;
    		$user->firstname = 'Admin';
    		$user->lastname = 'PreAI';
    		$user->email = 'admin@admin.com';
    		$user->email_verified_at = null;
    		$user->password = bcrypt('123456789');
    		$user->remember_token = null;
    		$user->save();

            $user_amount = random_int(1, 10);
            factory(App\User::class, $user_amount)->create();

        }
}
