<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing data
        DB::table('model_has_roles')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create admin and customer roles
        $adminRoleId = DB::table('roles')->insertGetId([
            'name' => 'admin',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $customerRoleId = DB::table('roles')->insertGetId([
            'name' => 'customer',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create admin user
        $adminId = Str::uuid();
        DB::table('users')->insert([
            'id' => $adminId,
            'username' => 'superadmin',
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'email' => 'admin@zonakamera.id',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Bind admin user to FilamentShield
        Artisan::call('shield:super-admin', ['--user' => $adminId]);

        DB::table('model_has_roles')->insert([
            'role_id' => $adminRoleId,
            'model_type' => 'App\Models\User',
            'model_id' => $adminId,
        ]);

        // Create one customer user
        $customerId = Str::uuid();
        DB::table('users')->insert([
            'id' => $customerId,
            'username' => 'customer',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'customer@example.com',
            'phone' => '081234567891',
            'email_verified_at' => now(),
            'password' => Hash::make('customer123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => $customerRoleId,
            'model_type' => 'App\Models\User',
            'model_id' => $customerId,
        ]);
    }
}
