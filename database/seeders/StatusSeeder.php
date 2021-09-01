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
            'name' => 'Đã huỷ',
            'group_id' => 1,
            'is_status' => 1,
        ],
        [
            'name' => 'Nháp',
            'group_id' => 1,
            'is_status' => 1,
        ],
        [
            'name' => 'Hoàn thành',
            'group_id' => 1,
            'is_status' => 1,
        ],
        [
            'name' => 'Chưa giao',
            'group_id' => 2,
            'is_status' => 1,
        ],
        [
            'name' => 'Đã giao',
            'group_id' => 2,
            'is_status' => 1,
        ],[
            'name' => 'Đã thanh toán',
            'group_id' => 3,
            'is_status' => 1,
        ],[
            'name' => 'Chưa thanh toán',
            'group_id' => 3,
            'is_status' => 1,
        ]
    ];

    public function run()
    {
        foreach($this->_status as $status) {
            Status::create($status);
        }
    }
}
