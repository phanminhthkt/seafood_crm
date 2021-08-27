<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\GroupMember;

class GroupMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $groups = [
        [
            'name' => 'Nhóm kỹ thuật',
            'is_status' => 1,
        ],
        [
            'name' => 'Nhóm kinh doanh',
            'is_status' => 1,
        ]
    ];

    public function run()
    {
        foreach($this->groups as $group) {
            GroupMember::create($group);
        }
    }
}
