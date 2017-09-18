<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Cookie\Models\User::class)->create([
            'email' => 'admin@user.com',
            'enrolment' => 100000
        ])->each(function (\Cookie\Models\User $user) {
            \Cookie\Models\User::assignRole($user, \Cookie\Models\User::ROLE_ADMIN);
            $user->save();
        });

        factory(\Cookie\Models\User::class,10)->create()->each(function (\Cookie\Models\User $user) {
            if (!$user->userable) {
                \Cookie\Models\User::assignRole($user, \Cookie\Models\User::ROLE_PROFESSOR);
                \Cookie\Models\User::assignEnrolment(new \Cookie\Models\User(), \Cookie\Models\User::ROLE_PROFESSOR);
                $user->save();
            }
        });

        factory(\Cookie\Models\User::class,10)->create()->each(function (\Cookie\Models\User $user) {
            if (!$user->userable) {
                \Cookie\Models\User::assignRole($user, \Cookie\Models\User::ROLE_STUDENT);
                \Cookie\Models\User::assignEnrolment(new \Cookie\Models\User(), \Cookie\Models\User::ROLE_STUDENT);
                $user->save();
            }
        });
    }
}
