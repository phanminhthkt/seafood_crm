<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call([
            GroupMemberSeeder::class,
            GroupStatusSeeder::class,
            MemberSeeder::class,
            StatusSeeder::class,
            UserSeeder::class,
            RolesSeeder::class,
            RoleUserSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
