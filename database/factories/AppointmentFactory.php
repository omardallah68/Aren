<?php

namespace Database\Factories;



use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-5 Days', '+5 Days');

        return [
            'id' => $this->faker->buildingNumber,
            'title' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'start' => $start,
            'end' => $this->faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s').' +4 Hours'),
            'user_id' => User::factory(),
        ];
    }
}
