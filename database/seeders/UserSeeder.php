<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $developer = Role::where('slug','web-developer')->first();
//        $manager = Role::where('slug', 'project-manager')->first();
//
//        $createTasks = Permission::where('slug','create-tasks')->first();
//        $manageUsers = Permission::where('slug','manage-users')->first();

//        $user2 = new User();
//        $user2->name = 'Mike Thomas';
//        $user2->email = 'mike@thomas.com';
//        $user2->password = bcrypt('secret');
//        $user2->save();
//        $user2->roles()->attach($manager);
//        $user2->permissions()->attach($manageUsers);


        $adminRole = Role::where('slug', 'admin')->first();
        $userRole = Role::where('slug', 'user')->first();

        //Права для роли админ
        foreach (Permission::all() as $permission){
            $adminRole->permissions()->attach($permission);
        }

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@email.net';
        $admin->password = bcrypt('password');
        $admin->save();

        $user = new User();
        $user->name = 'user';
        $user->email = 'user@email.net';
        $user->password = bcrypt('password');
        $user->save();

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);


        $imgs = [
            'just-coin.jpg',
            'just-penny.jpg',
            'just-rub.jpg'
        ];
        File::create([
            'morphable_type' => 'App\Models\User',
            'morphable_id' => $admin->id,
            'src' => '/assets/img/'.$imgs[rand(0,2)],
            'category' => 'avatar'
        ]);
    }
}
