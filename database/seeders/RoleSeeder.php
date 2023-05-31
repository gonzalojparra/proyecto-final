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
        $admin = Role::create(['name' => 'Admin']);
        $juez = Role::create(['name' => 'Juez']);
        $competidor = Role::create(['name' => 'Competidor']);

        Permission::create(['name' => 'competidores.index']);
        Permission::create(['name' => 'competidores.create']);
        Permission::create(['name' => 'competidores.edit']);
        Permission::create(['name' => 'competidores.show']);
        Permission::create(['name' => 'roles.index'])->assignRole($admin);
        Permission::create(['name' => 'roles.create'])->assignRole($admin);
        Permission::create(['name' => 'roles.edit'])->assignRole($admin);
        Permission::create(['name' => 'roles.show'])->assignRole($admin);
        Permission::create(['name' => 'teams.show']);
        Permission::create(['name' => 'teams.create']);
        Permission::create(['name' => 'teams.create-team-form']);
        Permission::create(['name' => 'teams.delete-team-form']);
        Permission::create(['name' => 'teams.team-member-manager']);
        Permission::create(['name' => 'teams.update-team-name-form']);



        // Creo un permiso y se lo asigno a un solo rol
        // Permission::create(['name' => 'competidores.index'])->assignRole($admin);
        // Creo un permiso y se lo asigno a dos roles (admin y juez)
        // Permission::create(['name' => 'ver reloj'])->syncRoles([$admin, $juez]);
        // Permission::create(['name' => 'ver form inscripcion'])->syncRoles([$competidor]);

    }

}