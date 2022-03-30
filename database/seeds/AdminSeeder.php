<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('name', 'Developer')->exists()) {
        	$user = User::create([
        		'name' => 'Developer',
                'email' => 'indiit@gmail.com',
                'password' => Hash::make('indiit@123'),
        	]);
            $user->assignRole('admin');
        }
    }
}
