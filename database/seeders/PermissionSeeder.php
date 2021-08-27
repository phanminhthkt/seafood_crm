<?php

namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
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
		            'name' => 'Xem dự án',
		            'module' => 'project',
		            'slug' => 'view-project',
		            'action' => 'view',
		            'type' => null,
		        ],[
		            'name' => 'Tạo dự án',
		            'module' => 'project',
		            'slug' => 'create-project',
		            'action' => 'create',
		            'type' => null,
		        ],[
		            'name' => 'Sửa dự án',
		            'module' => 'project',
		            'slug' => 'update-project',
		            'action' => 'update',
		            'type' => null,
		        ],[
		            'name' => 'Sửa dự án dev',
		            'module' => 'project',
		            'slug' => 'update-dev-project',
		            'action' => 'update-dev',
		            'type' => null,
		        ],[
		            'name' => 'Sửa dự án sale',
		            'module' => 'project',
		            'slug' => 'update-sale-project',
		            'action' => 'update-sale',
		            'type' => null,
		        ],[
		            'name' => 'Xoá dự án',
		            'module' => 'project',
		            'slug' => 'delete-project',
		            'action' => 'delete',
		            'type' => null,
		        ],[
		            'name' => 'Gửi mail dự án',
		            'module' => 'project',
		            'slug' => 'send-mail-project',
		            'action' => 'send-mail',
		            'type' => null,
		        ],[
		            'name' => 'Xem nhóm trạng thái',
		            'module' => 'group_status',
		            'slug' => 'view-group_status',
		            'action' => 'view',
		            'type' => null,
		        ],[
		            'name' => 'Tạo nhóm trạng thái',
		            'module' => 'group_status',
		            'slug' => 'create-group_status',
		            'action' => 'create',
		            'type' => null,
		        ],[
		            'name' => 'Sửa nhóm trạng thái',
		            'module' => 'group_status',
		            'slug' => 'update-group_status',
		            'action' => 'update',
		            'type' => null,
		        ],[
		            'name' => 'Xoá nhóm trạng thái',
		            'module' => 'group_status',
		            'slug' => 'delete-group_status',
		            'action' => 'delete',
		            'type' => null,
		        ],[
		            'name' => 'Xem trạng thái',
		            'module' => 'status',
		            'slug' => 'view-status',
		            'action' => 'view',
		            'type' => null,
		        ],[
		            'name' => 'Tạo trạng thái',
		            'module' => 'status',
		            'slug' => 'create-status',
		            'action' => 'create',
		            'type' => null,
		        ],[
		            'name' => 'Sửa trạng thái',
		            'module' => 'status',
		            'slug' => 'update-status',
		            'action' => 'update',
		            'type' => null,
		        ],[
		            'name' => 'Xoá trạng thái',
		            'module' => 'status',
		            'slug' => 'delete-status',
		            'action' => 'delete',
		            'type' => null,
		        ],[
		            'name' => 'Xem quyền',
		            'module' => 'permission',
		            'slug' => 'view-permission',
		            'action' => 'view',
		            'type' => null,
		        ],[
		            'name' => 'Tạo quyền',
		            'module' => 'permission',
		            'slug' => 'create-permission',
		            'action' => 'create',
		            'type' => null,
		        ],[
		            'name' => 'Sửa quyền',
		            'module' => 'permission',
		            'slug' => 'update-permission',
		            'action' => 'update',
		            'type' => null,
		        ],[
		            'name' => 'Xoá quyền',
		            'module' => 'permission',
		            'slug' => 'delete-permission',
		            'action' => 'delete',
		            'type' => null,
		        ],[
		            'name' => 'Xem vai trò',
		            'module' => 'role',
		            'slug' => 'view-role',
		            'action' => 'view',
		            'type' => null,
		        ],[
		            'name' => 'Tạo vai trò',
		            'module' => 'role',
		            'slug' => 'create-role',
		            'action' => 'create',
		            'type' => null,
		        ],[
		            'name' => 'Sửa vai trò',
		            'module' => 'role',
		            'slug' => 'update-role',
		            'action' => 'update',
		            'type' => null,
		        ],[
		            'name' => 'Xoá vai trò',
		            'module' => 'role',
		            'slug' => 'delete-role',
		            'action' => 'delete',
		            'type' => null,
		        ],[
		            'name' => 'Xem nhóm thành viên',
		            'module' => 'group_member',
		            'slug' => 'view-group_member',
		            'action' => 'view',
		            'type' => null,
		        ],[
		            'name' => 'Tạo nhóm thành viên',
		            'module' => 'group_member',
		            'slug' => 'create-group_member',
		            'action' => 'create',
		            'type' => null,
		        ],[
		            'name' => 'Sửa nhóm thành viên',
		            'module' => 'group_member',
		            'slug' => 'update-group_member',
		            'action' => 'update',
		            'type' => null,
		        ],[
		            'name' => 'Xoá nhóm thành viên',
		            'module' => 'group_member',
		            'slug' => 'delete-group_member',
		            'action' => 'delete',
		            'type' => null,
		        ],[
		            'name' => 'Xem thành viên',
		            'module' => 'member',
		            'slug' => 'view-member',
		            'action' => 'view',
		            'type' => null,
		        ],[
		            'name' => 'Tạo thành viên',
		            'module' => 'member',
		            'slug' => 'create-member',
		            'action' => 'create',
		            'type' => null,
		        ],[
		            'name' => 'Sửa thành viên',
		            'module' => 'member',
		            'slug' => 'update-member',
		            'action' => 'update',
		            'type' => null,
		        ],[
		            'name' => 'Xoá thành viên',
		            'module' => 'member',
		            'slug' => 'delete-member',
		            'action' => 'delete',
		            'type' => null,
		        ],[
		            'name' => 'Xem người dùng',
		            'module' => 'user',
		            'slug' => 'view-user',
		            'action' => 'view',
		            'type' => null,
		        ],[
		            'name' => 'Tạo người dùng',
		            'module' => 'user',
		            'slug' => 'create-user',
		            'action' => 'create',
		            'type' => null,
		        ],[
		            'name' => 'Sửa người dùng',
		            'module' => 'user',
		            'slug' => 'update-user',
		            'action' => 'update',
		            'type' => null,
		        ],[
		            'name' => 'Xoá người dùng',
		            'module' => 'user',
		            'slug' => 'delete-user',
		            'action' => 'delete',
		            'type' => null,
		        ],
        ];
        foreach($data as $v) {
            Permission::create($v);
        }
    }
}
