<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminData = config('default_admin');

        User::where('email', $adminData['admin_email'])->delete();

        User::create([
            'name' => $adminData['admin_name'],
            'email' => $adminData['admin_email'],
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($adminData['admin_password']),
            'is_admin' => 1
        ]);
    }
}
