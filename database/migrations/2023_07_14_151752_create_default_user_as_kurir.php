<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateDefaultUserAsKurir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(
            array(
                'name' => 'Kurir Melly',
                'email' => 'kurirmelly@mail.com',
                'password' =>  Hash::make('kurir123'),
                'api_token' => Str::random(60),
                'role' => 'kurir',
                'created_at' => Carbon::now()->toDateTimeLocalString(),
                'updated_at' => Carbon::now()->toDateTimeLocalString(),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
