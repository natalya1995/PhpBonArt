<?php

namespace Database\Seeders;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FilamentAdminUserSeeder extends Seeder
{
    public function run()
    {
        AdminUser::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Aa12345678'),
            'is_admin' => true, 
        ]);
    }
}
