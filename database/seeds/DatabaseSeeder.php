<?php

use App\Laravue\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Laravue\Models\Role;
use App\Model\Courses;
use App\Model\Enrolments;
use App\Model\EnrolmentStatus;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        EnrolmentStatus::create(['statusName'=>'not started']);
        EnrolmentStatus::create(['statusName'=>'in progress']);
        EnrolmentStatus::create(['statusName'=>'completed']);
        
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@laravue.dev',
            'password' => Hash::make('laravue'),
        ]);

        $adminRole = Role::findByName(\App\Laravue\Acl::ROLE_ADMIN);
        $admin->syncRoles($adminRole);
        $userRole = Role::findByName(\App\Laravue\Acl::ROLE_USER);
        for ($i=1; $i<=1000; $i++) {
            $user = User::create([
                'name' => 'firstName' . $i . 'lastName'.$i,
                'firstName' => 'firstName'.$i,
                'lastName' => 'lastName'.$i,
                'email' => 'nickName'.$i.'@test.com',
                'password' => Hash::make('password'),
            ]);
            $admin->syncRoles($userRole);
        }

        for ($j=1; $j<=100; $j++) {
            Courses::create([
                'courseName'=> \App\Laravue\Faker::randomString(30).' course Name ' . str_pad($j,3,'0',STR_PAD_LEFT),
                'Description' => 'Description' . $j,
            ]);
        }

        //Enrolments
        for ($i=2; $i<=1000; $i++) {
            for ($j=1; $j<=100; $j++) {
                Enrolments::create([
                    'userID'=>$i,
                    'courseID'=> $j,
                    'statusID' => random_int(1,3),
                ]);
            }
        }
    }
}
