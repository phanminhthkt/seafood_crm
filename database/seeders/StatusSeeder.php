<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $_status = [
        [
            'name' => 'Chưa lập trình',
            'group_id' => 1,
            'is_status' => 1,
        ],
        [
            'name' => 'Đang lập trình',
            'group_id' => 1,
            'is_status' => 1,
        ],
        [
            'name' => 'Đã lập trình',
            'group_id' => 1,
            'is_status' => 1,
        ],
        [
            'name' => 'Chưa bàn giao',
            'group_id' => 2,
            'is_status' => 1,
        ],
        [
            'name' => 'Đã bàn giao',
            'group_id' => 2,
            'is_status' => 1,
        ],
    ];

    public function run()
    {
        foreach($this->_status as $status) {
            Status::create($status);
        }
    }
}
