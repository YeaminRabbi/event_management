<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       if(!User::where('email', 'admin@gmail.com')->exists()){
            // Reset cached roles and permissions
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


            $admin = Role::firstOrCreate(['name' => 'admin']);
    
            //creating a admin account
            $AdminCount = new User;
            $AdminCount->name = 'Admin';
            $AdminCount->email = 'admin@gmail.com';
            $AdminCount->password =  Hash::make('123');
            $AdminCount->save();
    
            $AdminCount->assignRole($admin);
       }
    }
}
