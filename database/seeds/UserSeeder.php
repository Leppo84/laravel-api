<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {
        $users = [
            [
                'name'      => 'fake',
                'email'     => 'fake@fake.fake',
                'password'  => Hash::make('fake'),
            ],
            [
                'name'      => 'doll',
                'email'     => 'doll@doll.doll',
                'password'  => Hash::make('doll'),
            ],
            [
                'name'      => 'john',
                'email'     => 'john@john.john',
                'password'  => Hash::make('john'),
            ],
            [
                'name'      => 'goat',
                'email'     => 'goat@goat.goat',
                'password'  => Hash::make('goat'),
            ],
            [
                'name'      => 'jane',
                'email'     => 'jane@jane.jane',
                'password'  => Hash::make('jane'),
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}