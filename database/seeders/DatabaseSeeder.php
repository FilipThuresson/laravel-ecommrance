<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Location::create(['name' => 'Vänersborg']);

        Role::create(['name' => 'super admin']);

        Permission::create(['name' => 'manage products']);

        $user = User::find(1);
        $user->assignRole('super admin');

        User::factory(10)->create();
    }
}
