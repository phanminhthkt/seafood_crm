<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
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
            'username' => 'admin',
            'email' => 'phanminh@gmail.com',
            'name' => 'Minh dev',
            'password' => Hash::make('123456'),
        ]
        ];
        foreach($data as $v) {
            User::create($v);
        }
    }
}
