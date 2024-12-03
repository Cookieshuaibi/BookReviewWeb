<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use App\Models\User;
use Couchbase\Role;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Role as RoleModel;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // 开始一个数据库事务
        DB::beginTransaction();

        try {
            // 删除所有角色用户的关联记录
            RoleUser::truncate(); // 保持这个，因为它没有外键约束

            // 删除所有角色
            RoleModel::query()->delete();

            // 创建新的角色
            $roles = ['admin', 'user', 'author'];
            foreach ($roles as $role) {
                RoleModel::create(['name' => $role]);
            }

            // 获取所有用户
            $users = User::all();
            // 获取所有角色
            $roles = RoleModel::all();

            // 给每个用户随机分配一个角色
            foreach ($users as $user) {
                $user->roles()->attach($roles->random(1)->first());
            }

            // 提交事务
            DB::commit();
        } catch (\Exception $e) {
            // 回滚事务
            DB::rollBack();
            // 处理异常（可选）
            // Log::error($e); // 记录日志或抛出异常
        }
    }
}