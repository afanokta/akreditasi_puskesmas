<?php

namespace Database\Factories;

use App\Models\PenilaianElemen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenilaianElemen>
 */
class PenilaianElemenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     private static $order = 1;
     protected $model = PenilaianElemen::class;

    public function definition(): array
    {
        $faker = $this->faker;
        return [
            'elemen_id' => self::$order++,
            'akreditasi_id' => 1,
            'nilai' => $faker->randomElement([0, 5, 10, null]),
            'fakta_analisis' => $faker->text(),
            'ketersediaan' => $faker->boolean(),
            'foto' => 'image-dummy.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
