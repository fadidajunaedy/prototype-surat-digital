<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name'=>'Fadida Zanetti Junaedy',
            'email'=>'fadidajunaedy@gmail.com',
            'password'=>Hash::make('qq332211'),
            'role'=>'admin'
        ]);
    }
}
