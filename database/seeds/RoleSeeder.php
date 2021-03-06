<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\User;

class RoleSeeder extends Seeder
{
    public function run()
    {
        if (!Role::where('name', 'admin')->exists()) {
        	Role::create([
        		'name' => 'admin'
        	]);
        }

        if (!Role::where('name', 'seller')->exists()) {
            Role::create([
                'name' => 'seller'
            ]);
        }

        if (!Role::where('name', 'buyer')->exists()) {
        	Role::create([
        		'name' => 'buyer'
        	]);
        }
    }
}
