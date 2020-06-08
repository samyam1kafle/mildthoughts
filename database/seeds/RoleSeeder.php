<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array([
            'role' => 'Admin', 'access' => 'Has All Access', 'created_at' => \Carbon\Carbon::now(),

        ], ['role' => 'Author', 'access' => 'Can read \ write Thoughts', 'created_at' => \Carbon\Carbon::now()]);
        DB::table('roles')->insert($roles);
    }
}
