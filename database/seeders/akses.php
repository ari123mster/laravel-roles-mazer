<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class akses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        Permission::create(['name' => 'siswa-create']);
        Permission::create(['name' => 'siswa-edit']);
        Permission::create(['name' => 'siswa-delete']);
      

        //create roles and assign existing permissions
        $writerRole = Role::create(['name' => 'writer']);
        $writerRole->givePermissionTo('siswa-delete');
      

     
        $superadminRole = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule

        // create demo users
        $user = User::factory()->create([
            'name' => 'guru',
            'email' => 'guru@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($writerRole);

      
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        $user->assignRole($superadminRole);
    }
    }

