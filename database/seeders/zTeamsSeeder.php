<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Team;
use App\Models\User;
use Laravel\Jetstream\Jetstream;

class zTeamsSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Team::forceCreate([
            'name' => "Asociación Civil Bom Do Kwan Taekwondo Tigres Neuquinos",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Asociación Civil Patagónica de Deportes de combate",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Asociación Civil Taekwondo Neuquén",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Asociación Club Amigos del Tang Soo Doo y el Taekwondo 'A.C.A.T.T'",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Asociación de Taekwondo Marcial y Deportiva Sayhueque",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Asociación Deportiva Centenario",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Asociación Taekwondo El Temple",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Asociación Patagónica de Taekwondo Chong Do He",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Asociación Simple de Taekwondo Chungdokwan",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Club Social y Deportivo Unión Zapala",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Club Social y Deportivo Vista Alegre Norte",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Escuela de Taekwondo del Sur Asociación Civil",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Club Tiro Federal de Zapala",
            'personal_team' => false,
        ]);
        Team::forceCreate([
            'name' => "Asociación Taekwondo Comahue",
            'personal_team' => false,
        ]);
        $teamX = Team::forceCreate([
            'name' => "Club San Francisco San Martín",
            'personal_team' => false,
        ]);
        
        /**
         * Asignarle una escuela a un usuario
         * Primero se busca el email del usuario a ingresar
         * Luego se lo añade
         */
        $rodriPepi = Jetstream::findUserByEmailOrFail('rodri@example.com');
        $teamX->users()->attach(
            $rodriPepi
        );
        
        //
        //Team::create(['user_id' => 1], ['name' => 'Los Capos'], ['personal_team' => false]);

        // Create one team
        /* $email = 'rodri@example.com'; // email hardcodeado pero esto tendría que ser dinámico
        $team = $this->createBigTeam($email);
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => 'Profesor']
        ); */

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
    /* protected function createBigTeam($email): Team {
        $user = Jetstream::findUserByEmailOrFail($email);
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => "Colegio X",
            'personal_team' => false,
        ]);
        $user->ownedTeams()->save($team);
        return $team;
    } */
}