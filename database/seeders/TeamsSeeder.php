<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Team;
use App\Models\User;
use Laravel\Jetstream\Jetstream;

class TeamsSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        //
        //Team::create(['user_id' => 1], ['name' => 'Los Capos'], ['personal_team' => false]);

        // Create one team
        $email = 'rodri@example.com'; // email hardcodeado pero esto tendría que ser dinámico
        $team = $this->createBigTeam($email);
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => 'Profesor']
        );

        // assign to team
        /* $role = 'manager';
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
        ); */
    }


    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    /* protected function createTeam(User $user) {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => 'Personal',
            'personal_team' => true,
        ]));
    } */

    /**
     * @param mixed $email
     * @return Team
     */
    protected function createBigTeam($email): Team {
        $user = Jetstream::findUserByEmailOrFail($email);
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => "Colegio X",
            'personal_team' => false,
        ]);
        $user->ownedTeams()->save($team);
        return $team;
    }
}