<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public const PASSWORD = 'password';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Administrator
        $admin = User::create([
            'name' => 'Tran Nam Dan',
            'email' => 'admin@comp1640.com',
            'gender' => 'Male',
            'phone' => '0963639070',
            'password' => Hash::make(self::PASSWORD)
        ]);
        $admin->assignRole('Super Administrator');
        // Quality Assurance Manager
        $qam = User::create([
            'name' => 'Quality Assurance Manager',
            'email' => 'qam@comp1640.com',
            'gender' => 'Female',
            'phone' => '0963639071',
            'password' => Hash::make(self::PASSWORD)
        ]);
        $qam->assignRole('Quality Assurance Manager');
        // Quality Assurance Coordinator
        $qa = User::create([
            'name' => 'Quality Assurance Coordinator',
            'email' => 'qa@comp1640.com',
            'gender' => 'Female',
            'phone' => '0963639072',
            'password' => Hash::make(self::PASSWORD)
        ]);
        $qa->assignRole('Quality Assurance Coordinator');
        // Staff
        $staff =  User::create([
            'name' => 'Staff',
            'email' => 'staff@comp1640.com',
            'gender' => 'Female',
            'phone' => '0963639073',
            'password' => Hash::make(self::PASSWORD)
        ]);
        $staff->assignRole('Staff');
        // Member
        $member = User::create([
            'name' => 'Member',
            'email' => 'member@comp1640.com',
            'gender' => 'Male',
            'phone' => '0963639074',
            'password' => Hash::make(self::PASSWORD)
        ]);
        $member->assignRole('Member');
    }
}
