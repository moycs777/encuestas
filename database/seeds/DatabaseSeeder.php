<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('master_aplications')->insert([
            'start_date' => Carbon::createFromFormat('d/m/Y', '17/11/2017')->toDateTimeString(),
            'user_id' =>  1,
            'poll_id' =>  1,
            'status' =>  0,
        ]);
    }
}
