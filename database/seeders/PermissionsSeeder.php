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

        Permission::create(['name' => 'create_vehicle']);
        Permission::create(['name' => 'view_vehicle']);
        Permission::create(['name' => 'edit_vehicle']);
        Permission::create(['name' => 'delete_vehicle']);

        Permission::create(['name' => 'create_permanence_vehicle']);
        Permission::create(['name' => 'view_permanence_vehicle']);
        Permission::create(['name' => 'edit_permanence_vehicle']);
        Permission::create(['name' => 'delete_permanence_vehicle']);

        // cria a funcao para o usuario 1 - admin
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('create_vehicle');
        $role1->givePermissionTo('view_vehicle');
        $role1->givePermissionTo('edit_vehicle');
        $role1->givePermissionTo('delete_vehicle');
        $role1->givePermissionTo('create_permanence_vehicle');
        $role1->givePermissionTo('view_permanence_vehicle');
        $role1->givePermissionTo('edit_permanence_vehicle');
        $role1->givePermissionTo('delete_permanence_vehicle');

        // cria a funcao para o usuario 2 - colaborador
        $role2 = Role::create(['name' => 'collaborator']);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin teste',
            'email' => 'admin@example.com',
            'password' => bcrypt('abcd1234'),
        ]);

        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'collaborator teste',
            'email' => 'collaborator@example.com',
            'password' => bcrypt('abcd1234'),
        ]);

        $user->assignRole($role2);
    }
}
