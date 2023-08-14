<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();

        User::factory()->create([
            'first_name' =>  "some",
            'last_name' => "one",
            'status' => Arr::random([1, 2]),
            'hak_akses' => Arr::random([1, 2]),
            'email' => "mail@mail.com",
            'password' => Hash::make('12345678'),
        ]);
    }
}
