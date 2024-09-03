<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $users = [
      [
        'nome'     => 'Henrique',
        'email'    => 'henrique@gmail.com',
        'password' => Hash::make('senha'),
        'saldo'    => 5000
      ],
      [
        'nome'     => 'Pedro',
        'email'    => 'peu@gmail.com',
        'password' => Hash::make('senha'),
        'saldo'    => 5000
      ]
    ];

    foreach ($users as $user) {
      User::create($user);
    }
  }
}
