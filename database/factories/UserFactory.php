<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $role = Role::query()->first();
        $user = [
            'first_name' => 'test_2',
            'last_name' => 'test_2',

            'phones' => [$this->faker->numerify("+237-#########")],

            'email' => $this->faker->unique()->safeEmail(),

            "roles_id" => $role['id'],


            // 'username' => $this->faker->userName(),

            // 'birthday' => $this->faker->date(),

            'password' => bcrypt('test'),

        ];

        return $user;
    }

    // /**
    //  * Indicate that the model's email address should be unverified.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Factories\Factory
    //  */
    // public function unverified()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'email_verified_at' => null,
    //         ];
    //     });
    // }
}
