<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin = Role::create(['name' => 'administrador']);
        $roleAdminPrestamos = Role::create(['name' => 'administrador_prestamos']);
        $roleVigilante = Role::create(['name' => 'vigilante']);
        $roleInstructor = Role::create(['name' => 'instructor']);

        $permission1 = Permission::create(['name' => 'crear, editar y eliminar usuarios']);
        $permission2 = Permission::create(['name' => 'crear, editar y eliminar llaves']);
        $permission3 = Permission::create(['name' => 'crear, editar y eliminar ambientes']);
        $permission4 = Permission::create(['name' => 'registrar, editar y eliminar instructores']);
        $permission5 = Permission::create(['name' => 'prestar llaves y ver historico']);
        $permission6 = Permission::create(['name' => 'devolver llave prestada']);

        $permission1->assignRole($roleAdmin);
        $permission2->assignRole($roleAdmin);
        $permission3->assignRole($roleAdmin);
        $permission4->assignRole($roleAdmin);
        $permission5->assignRole($roleAdmin);

        $permission5->assignRole($roleAdminPrestamos);
        $permission5->assignRole($roleVigilante);

        $permission6->assignRole($roleInstructor);

    }
}
