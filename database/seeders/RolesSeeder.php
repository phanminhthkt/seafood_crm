<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
	            'name' => 'Admin',
	            'slug' => 'admin',
	            'is_status' => 1,
        	]
        ];
        foreach($data as $v) {
            Role::create($v);
        }
    }
}
