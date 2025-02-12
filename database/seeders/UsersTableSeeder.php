<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory;
use Illuminate\Support\Facades\Artisan;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        // Nonaktifkan foreign key constraints sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Hapus data lama
        DB::table('model_has_roles')->truncate();
        DB::table('users')->truncate();
        DB::table('roles')->truncate();

        // Aktifkan kembali foreign key constraints
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Buat role admin dan customer
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

        // Buat pengguna superadmin
        $adminId = Str::uuid();
        DB::table('users')->insert([
            'id' => $adminId,
            'username' => 'superadmin',
            'firstname' => 'Super',
            'lastname' => 'Admin',
            'email' => 'superadmin@zonakamera.id',
            'email_verified_at' => now(),
            'password' => Hash::make('superadmin'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Bind superadmin user to FilamentShield
        Artisan::call('shield:super-admin', ['--user' => $adminId]);

        DB::table('model_has_roles')->insert([
            'role_id' => $adminRoleId,
            'model_type' => 'App\Models\User',
            'model_id' => $adminId,
        ]);

        // Buat 10 pengguna customer secara acak
        for ($i = 0; $i < 10; $i++) {
            $customerId = Str::uuid();
            DB::table('users')->insert([
                'id' => $customerId,
                'username' => $faker->unique()->userName,
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
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
}
