<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * Nama model yang akan difactory-kan.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Definisikan model factory.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Gunakan password default
            'role' => $this->faker->randomElement(['admin', 'operator', 'dokter', 'kasir']),
            'remember_token' => Str::random(10),
        ];
    }
}
