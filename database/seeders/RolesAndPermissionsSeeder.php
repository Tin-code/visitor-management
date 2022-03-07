<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Réinitialiser les rôles et les autorisations mis en cache
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         // creer permissions
         $permissions = Permission::create(['name' => 'manager create']);
         $permissions =  Permission::create(['name' => 'manager edit']);
         $permissions =  Permission::create(['name' => 'manager udpate']);
         $permissions = Permission::create(['name' => 'manager delete']);

         // creer role et permission
         $role = Role::create(['name' => 'super-admin']);
         $role->givePermissionTo(['manager create', 'manager edit','manager udpate','manager delete']);

         $role = Role::create(['name' => 'admin'])
               ->givePermissionTo(['manager create', 'manager edit','manager udpate','manager delete']);
          $role = Role::create(['name' => 'réceptionniste'])
              ->givePermissionTo(['manager create', 'manager edit','manager udpate','manager delete']);
         $role = Role::create(['name' => 'agent'])
                ->givePermissionTo(['manager create', 'manager edit','manager udpate','manager delete']);

    }
}
