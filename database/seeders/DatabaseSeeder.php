<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Team;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([PermissionSeeder::class]);
        $this->call([ChatRoomSeeder::class]);


        $SuperAdminRole = Role::create(['name' => 'Super-Admin']);
        $user = \App\Models\User::factory()
            ->withPersonalTeam()
            ->hasAttached(Team::factory()->count(3))
            ->create([
                'name' => 'Super-Admin User',
                'email' => 'test@example.com',
                'password' => bcrypt('password')
            ]);
        $user->assignRole($SuperAdminRole);

        User::factory(['email' => 'info@geisi.dev'])
            ->withPersonalTeam()
            ->hasAttached(Team::factory()->count(3))
            ->create();


        Appointment::factory(50)->create();

    }
}
