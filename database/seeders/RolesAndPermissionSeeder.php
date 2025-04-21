<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create Permissions
         $admin = Permission::create(['name'=>'admin']);
         $user = Permission::create(['name'=>'user']);
         $viewOrders = Permission::create(['name' => 'view-orders']);
         $manageOrders = Permission::create(['name' => 'manage-events']);
         $manageTransactions = Permission::create(['name' => 'manage-transactions']);
         $manageUsers = Permission::create(['name' => 'manage-users']);
 
         // Create Roles
         $adminRole = Role::create(['name' => 'admin']);
         $userRole = Role::create(['name' => 'user']);
 
         // Assign Permissions to Roles
         $adminRole->givePermissionTo([$admin, $viewOrders, $manageOrders, $manageTransactions, $manageUsers]);
         $userRole->givePermissionTo([$user, $viewOrders]);
 
         // Create Users
         $adminUser = User::create([
             'name' => 'admin',
             'email' => 'admin@gmail.com',
             'password' => bcrypt('admin111'),
         ]);
         $harvey = User::create([
             'name' => 'harvey',
             'email' => 'harvey@gmail.com',
             'password' => bcrypt('harvey111'),
         ]);
 
         // Assign Roles to Users
         $adminUser->assignRole($adminRole);
         $harvey->assignRole($userRole);
    }
}
