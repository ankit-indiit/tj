<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('name', 'admin')->exists()) {
        	$user = User::create([
        		'name' => 'Developer'
                'email' => 'indiit@gmail.com'
                'password' => Hash::make('Indiit@123'),
        	]);
            $user->assignRole('admin');
        }
    }
}
