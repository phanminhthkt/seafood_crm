<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class MemberSeeder extends Seeder
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
            'name' => 'Phan Minh',
            'username' => 'phanminh',
            'email' => 'phanminh@gmail.com',
            'password' => Hash::make('123456'),
            'group_id' => 1,
            'is_status' => 1,
        ],
        [
            'name' => 'Phạm Nhi',
            'username' => 'phamnhi',
            'email' => 'phamnhi@gmail.com',
            'password' => Hash::make('123456'),
            'group_id' => 2,
            'is_status' => 1,
        ],
        [
            'name' => 'Võ Tú',
            'username' => 'votu',
            'email' => 'votu@gmail.com',
            'password' => Hash::make('123456'),
            'group_id' => 1,
            'is_status' => 1,
        ]
        ];
        foreach($data as $v) {
            Member::create($v);
        }
    }
}
