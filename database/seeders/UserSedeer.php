<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //super-admin
        User::create([
            'name' => 'super-admin',
            'email'=>'superadmin@gmail.com',
            'password'=>'1234'
        ])->assignRole('admin');
        //admin/karyawan
        User::create([
            'name' => 'admin',
            'email'=>'admin@gmail.com',
            'password'=>'1234'
        ])->assignRole('admin');
        //mahasiswa
        User::create([
            'name' => 'mahasiswa',
            'email'=>'mahasiswa@gmail.com',
            'password'=>'1234'
        ])->assignRole('mahasiswa');
    }
}
