<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'first_name' => 'Phillip',
            'last_name' => 'Villarosa',
            'email' => 'phillip@advantageattorneymarketing.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::parse('01-01-2023')
        ]);
    }
}
