<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(DeptSeeder::class);
        $this->call(DeductItemSeeder::class);
        $this->call(PersonSeeder::class);
        $this->call(LeaveSeeder::class);
        Model::reguard();
    }
}
