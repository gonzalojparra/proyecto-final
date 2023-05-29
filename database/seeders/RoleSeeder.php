<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        //
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $profesor = Role::create(['name' => 'Profesor']);
        $juez = Role::create(['name' => 'Juez']);
        $competidor = Role::create(['name' => 'Competidor']);

        $permisos = [
            'competidores.index',
            'competidores.create',
            'competidores.edit',
            'competidores.show',
            'teams.create-team-form',
            'teams.create',
            'teams.delete-team-form',
            'teams.show',
            'teams.team-member-manager',
            'teams.update-team-name-form',
        ];

        foreach( $permisos as $permiso ){
            Permission::create(['name' => $permiso])->assignRole($profesor);
        };



        // Creo un permiso y se lo asigno a un solo rol
        // Permission::create(['name' => 'competidores.index'])->assignRole($admin);
        // Creo un permiso y se lo asigno a dos roles (admin y juez)
        // Permission::create(['name' => 'ver reloj'])->syncRoles([$admin, $juez]);
        // Permission::create(['name' => 'ver form inscripcion'])->syncRoles([$competidor]);

    }

}