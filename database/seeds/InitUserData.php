<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitUserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bs_user')->insert([

            ['username' => 'zmy'],
            ['username' => 'zmy'],
            ['username' => 'zmy'],
        ]);
       /* //
        DB::table('bp_user')
            ->insert(['username' => 'zmy']);

        DB::table('bp_user')
            ->insert(['username' => 'zmy']);

        DB::table('bp_user')
            ->insert(['username' => 'zmy']);*/
    }
}
