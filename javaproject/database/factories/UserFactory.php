<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
  * The name of the factory's corresponding model.
  *
  * @var string
  */
 protected $model = \App\Models\User::class;

 /**
  * Define the model's default state.
  *
  * @return array
  */
 public function definition()
 {
     return [
         'name' => 'UnitTestName',
         'email' => 'UnitTest1@email.com',
         'username' => 'UnitTestUsername',
         'email_verified_at' => now(),
         'password' => '123', // default password
         'remember_token' => '232983',
     ];
 }
}
