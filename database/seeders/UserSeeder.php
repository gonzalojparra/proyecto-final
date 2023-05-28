<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Team;
use Laravel\Jetstream\Jetstream;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /* public function run() {

        $rolAdmin = Role::create(['name' => 'Admin']);
        $rolProfesor = Role::create(['name' => 'Profesor']);

        // Creo permiso y se lo asigno al rol
        Permission::create(['name' => 'todos los permisos de admin'])->assignRole($rolAdmin);
        Permission::create(['name' => 'todos los permisos de profesor'])->assignRole($rolProfesor);


        // Creo usuario
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@email.com';
        $user->password = bcrypt('12345678');
        $user->save();
        // Asigno rol al usuario
        $user->assignRole($rolAdmin);

        $user1 = new User;
        $user1->name = 'Profesor';
        $user1->email = 'profesor@email.com';
        $user1->password = bcrypt('12345678');
        $user1->save();
        // Asigno rol al usuario
        $user1->assignRole($rolProfesor);
    } */

    public function run() {

        $users = [
            [
                'name' => 'Rodri',
                'lastname' => 'Pepi',
                'email' => 'rodri@example.com',
                'password' => Hash::make('secret')
            ],
            [
                'name' => 'Juan',
                'lastname' => 'Loa',
                'email' => 'juan@example.com',
                'password' => Hash::make('secret')
            ],
        ];

        User::insert($users);


        // Seeder para hacer funcionar los teams
        // Hay que adaptarlo a lo que está comentado arriba
        // $users = [
        //     'Admin' => 'admin@votetracker.org',
        //     'Owner' => 'owner@example.com',
        //     'Manager' => 'manager@example.com',
        //     'Staff' => 'staff@example.com',
        //     'Volunteer' => 'volunteer@example.com'
        // ];


        // foreach ($users as $name => $email) {
        //     DB::transaction(function () use ($name, $email) {
        //         return tap(User::create([
        //             'name' => $name,
        //             'email' => $email,
        //             'password' => Hash::make('secret'),
        //         ]), function (User $user) {
        //             $this->createTeam($user);
        //         });
        //     });
        // }

        // Create one team
        $team = $this->createBigTeam('owner@example.com');

        // assign to team
        $role = 'manager';
        $email = 'manager@example.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );
        $role = 'staff';
        $email = 'staff@example.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );
        $role = 'volunteer';
        $email = 'volunteer@example.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );
    }


    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user) {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => 'Personal',
            'personal_team' => true,
        ]));
    }

    /**
     * @param mixed $email
     * @return Team
     */
    protected function createBigTeam($email): Team {
        $user = Jetstream::findUserByEmailOrFail($email);
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => "Big Company",
            'personal_team' => false,
        ]);
        $user->ownedTeams()->save($team);
        return $team;
    }

}