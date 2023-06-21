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
                'apellido' => 'Pepi',
                'genero' => 'Masculino',
                'email' => 'rodri@example.com',
                'du'=>'12345678',
                'id_escuela' => 2,
                'id_graduacion' => 1,
                'gal' => NULL,
                'fecha_nac' => '2003-04-25',
                'clasificacion' => 1
            ],
            [
                'name' => 'Juan',
                'apellido' => 'Loa',
                'genero' => 'Masculino',
                'email' => 'juan@example.com',
                'du'=>'12345678',
                'id_escuela' => 4,
                'id_graduacion' => 1,
                'gal' => NULL,
                'fecha_nac' => '2003-07-19',
                'clasificacion' => 15
            ],
            [
                'name' => 'Vanesa',
                'apellido' => 'Rodriguez',
                'genero' => 'Femenino',
                'email' => 'vane@example.com',
                'du'=>'12345678',
                'id_escuela' => 3,
                'id_graduacion' => 7,
                'gal' => NULL,
                'fecha_nac' => '2003-12-19',
                'clasificacion' => 16
            ],
            [
                'name' => 'Juan',
                'apellido' => 'Larrilla',
                'genero' => 'Masculino',
                'email' => 'juanL@example.com',
                'du'=>'12345678',
                'id_escuela' => 2,
                'id_graduacion' => 9,
                'gal' => NULL,
                'fecha_nac' => '1998-07-19',
                'clasificacion' => 3
            ],
            [
                'name' => 'Marcia',
                'apellido' => 'Morales',
                'genero' => 'Femenino',
                'email' => 'M&M@example.com',
                'du'=>'12345678',
                'id_escuela' => 5,
                'id_graduacion' => 15,
                'gal' => 'ASD1658974',
                'fecha_nac' => '1998-06-28',
                'clasificacion' => 5
            ],
            [
                'name' => 'Juana',
                'apellido' => 'Martinez',
                'genero' => 'Femenino',
                'email' => 'juanita@example.com',
                'du'=>'12345678',
                'id_escuela' => 8,
                'id_graduacion' => 15,
                'gal' => 'FGH2365855',
                'fecha_nac' => '1998-07-22',
                'clasificacion' => 4
            ],
            [
                'name' => 'Isidro',
                'apellido' => 'Loa',
                'genero' => 'Masculino',
                'email' => 'ysy@example.com',
                'du'=>'12345678',
                'id_escuela' => 12,
                'id_graduacion' => 1,
                'gal' => NULL,
                'fecha_nac' => '2011-10-19',
                'clasificacion' => 6
            ],
            [
                'name' => 'Milagros',
                'apellido' => 'Padilla',
                'genero' => 'Femenino',
                'email' => 'mili.p@example.com',
                'du'=>'12345678',
                'id_escuela' => 6,
                'id_graduacion' => 1,
                'gal' => NULL,
                'fecha_nac' => '2011-07-02',
                'clasificacion' => 9
            ],
            [
                'name' => 'Paloma',
                'apellido' => 'Padilla',
                'genero' => 'Femenino',
                'email' => 'palo.p@example.com',
                'du'=>'12345678',
                'id_escuela' => 6,
                'id_graduacion' => 4,
                'gal' => NULL,
                'fecha_nac' => '2003-07-19',
                'clasificacion' => 12
            ],
            [
                'name' => 'Daniela',
                'apellido' => 'Martinez',
                'password'=>'12345678',
                'du'=>'12345678',
                'genero' => 'Femenino',
                'email' => 'dani@example.com',
                'id_escuela' => 4,
                'id_graduacion' => 6,
                'gal' => NULL,
                'fecha_nac' => '2003-09-28',
                'clasificacion' => 8
            ],
            [
                'name' => 'NombreCompetidor1',
                'apellido' => 'ApellidoCompetidor1',
                'password'=>'123',
                'du'=>'12345678',
                'genero' => 'Femenino',
                'email' => 'competidor1@competidor.com',
                'id_escuela' => 4,
                'id_graduacion' => 6,
                'gal' => NULL,
                'fecha_nac' => '2003-09-28',
                'clasificacion' => 8
            ],
            [
                'name' => 'NombreCompetidor2',
                'apellido' => 'ApellidoCompetidor2',
                'password'=>'123',
                'du'=>'12345678',
                'genero' => 'Femenino',
                'email' => 'competidor2@competidor.com',
                'id_escuela' => 3,
                'id_graduacion' => 3,
                'gal' => NULL,
                'fecha_nac' => '2003-09-28',
                'clasificacion' => 8
            ],
            [
                'name' => 'NombreCompetidor3',
                'apellido' => 'ApellidoCompetidor3',
                'password'=>'123',
                'du'=>'12345678',
                'genero' => 'Femenino',
                'email' => 'competidor3@competidor.com',
                'id_escuela' => 2,
                'id_graduacion' => 4,
                'gal' => NULL,
                'fecha_nac' => '2003-09-28',
                'clasificacion' => 8
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'apellido' => $user['apellido'],
                'genero' => $user['genero'],
                'email' => $user['email'],
                'password' => Hash::make('secret'),
                'id_escuela' => $user['id_escuela'],
                'id_graduacion' => $user['id_graduacion'],
                'gal' => $user['gal'],
                'du'=>$user['du'],
                'fecha_nac' => $user['fecha_nac'],
                'clasificacion' => $user['clasificacion'],
                'verificado' => 1
            ])->assignRole('Competidor');
        };

        // PARA REALIZAR REGISTROS DE LA TABLA COMPETENCIA_JUEZ
        // Nos traemos todos los registros que tengan rol_id 4 de la tabla model_has_roles
        // Tenemos la lista de todos los jueces, obtenemos el id del usuario


        User::create([
            'name' => 'Pepe',
            'apellido' => 'Argento',
            'email' => 'pepa@example.com',
            'password' => Hash::make('123'),
            'id_escuela' => 3,
            'verificado' => 1
        ])->assignRole('Juez');
        
        User::create([
            'name' => 'Lorenzo',
            'apellido' => 'Palma',
            'email' => 'loren@example.com',
            'password' => Hash::make('123'),
            'id_escuela' => 15,
            'verificado' => 1
        ])->assignRole('Juez');

        User::create([
            'name' => 'Mariela',
            'apellido' => 'Argento',
            'email' => 'mari.ar@example.com',
            'password' => Hash::make('123'),
            'id_escuela' => 3,
            'verificado' => 1
        ])->assignRole('Juez');

        User::create([
            'name' => 'Sofia',
            'apellido' => 'Fermopolis',
            'email' => 'soffer@example.com',
            'password' => Hash::make('123'),
            'id_escuela' => 7,
            'verificado' => 1
        ])->assignRole('Juez');

        User::create([
            'name' => 'NombreJuez1',
            'apellido' => 'ApellidoJuez1',
            'email' => 'juez1@juez.com',
            'password' => Hash::make('123'),
            'id_escuela' => 4,
            'verificado' => 1
        ])->assignRole('Juez');

        User::create([
            'name' => 'NombreJuez2',
            'apellido' => 'ApellidoJuez2',
            'email' => 'juez2@juez.com',
            'password' => Hash::make('123'),
            'id_escuela' => 3,
            'verificado' => 1
        ])->assignRole('Juez');

        User::create([
            'name' => 'NombreJuez3',
            'apellido' => 'ApellidoJuez3',
            'email' => 'juez3@juez.com',
            'password' => Hash::make('123'),
            'id_escuela' => 5,
            'verificado' => 1
        ])->assignRole('Juez');

        User::create([
            'name' => 'Admin',
            'apellido' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'id_escuela' => 4,
            'verificado' => 1
        ])->assignRole('Admin');


        // Seeder para hacer funcionar los teams
        // Hay que adaptarlo a lo que está comentado arriba

        
        

        // Create one team
        // $team = $this->createBigTeam('Equipo algo');

        // assign to team
        //     $role = 'manager';
        //     $email = 'manager@example.com';
        //     $team->users()->attach(
        //         Jetstream::findUserByEmailOrFail($email),
        //         ['role' => $role]
        //     );
        //     $role = 'staff';
        //     $email = 'staff@example.com';
        //     $team->users()->attach(
        //         Jetstream::findUserByEmailOrFail($email),
        //         ['role' => $role]
        //     );
        //     $role = 'volunteer';
        //     $email = 'volunteer@example.com';
        //     $team->users()->attach(
        //         Jetstream::findUserByEmailOrFail($email),
        //         ['role' => $role]
        //     );
        // }


    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    // protected function createTeam(User $user) {
    //     $user->ownedTeams()->save(Team::forceCreate([
    //         'user_id' => $user->id,
    //         'name' => 'Personal',
    //         'personal_team' => true,
    //     ]));
    // }

    /**
     * @param mixed $email
     * @return Team
     */
    // protected function createBigTeam($email): Team {
    //     $user = Jetstream::findUserByEmailOrFail($email);
    //     $team = Team::forceCreate([
    //         'user_id' => $user->id,
    //         'name' => "Big Company",
    //         'personal_team' => false,
    //     ]);
    //     $user->ownedTeams()->save($team);
    //     return $team;
    // }
    }

}