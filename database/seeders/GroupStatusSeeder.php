<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\GroupStatus;

class GroupStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $groups = [
    	[
            'name' => 'Trạng thái kho',
            'is_status' => 1,
        ],
        [
            'name' => 'Trạng thái vận chuyển',
            'is_status' => 1,
        ],
        [
            'name' => 'Trạng thái thanh toán',
            'is_status' => 1,
        ]
        
    ];

    public function run()
    {
        foreach($this->groups as $group) {
            GroupStatus::create($group);
        }
    }
}
