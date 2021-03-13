<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder{
    public function run(){
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //registro das permissoes
        Permission::create(['name' => 'create_user']);
        Permission::create(['name' => 'view_user']);
        Permission::create(['name' => 'edit_user']);
        Permission::create(['name' => 'delete_user']);

        Permission::create(['name' => 'create_vehicle']);
        Permission::create(['name' => 'view_vehicle']);
        Permission::create(['name' => 'edit_vehicle']);
        Permission::create(['name' => 'delete_vehicle']);

        Permission::create(['name' => 'create_permanence_vehicle']);
        Permission::create(['name' => 'view_permanence_vehicle']);
        Permission::create(['name' => 'edit_permanence_vehicle']);
        Permission::create(['name' => 'delete_permanence_vehicle']);

        // cria a funcao para o admin
        $role1 = Role::create(['name' => 'admin']);

        //atribui todas as permissoes para o admin
        foreach(Permission::all() as $permission){
            $role1->givePermissionTo($permission['name']);
        }

        // cria a funcao para o colaborador
        $role2 = Role::create(['name' => 'collaborator']);

        //atribui as funcoes para o colaborador
        $role2->givePermissionTo('create_vehicle');
        $role2->givePermissionTo('view_vehicle');
        $role2->givePermissionTo('edit_vehicle');
        $role2->givePermissionTo('delete_vehicle');

        //registro do usuario - admin
        $user = \App\Models\User::factory()->create([
            'name' => 'admin teste',
            'email' => 'admin@example.com',
            'password' => bcrypt('abcd1234'),
        ]);

        //atribuicao da funcao ao usuario - admin
        $user->assignRole($role1);

        //registro do usuario - collaborator
        $user = \App\Models\User::factory()->create([
            'name' => 'collaborator teste',
            'email' => 'collaborator@example.com',
            'password' => bcrypt('abcd1234'),
        ]);

        //atribuicao da funcao ao usuario - collaborator
        $user->assignRole($role2);
    }
}
