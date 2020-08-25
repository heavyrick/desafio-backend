<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operations')->insert([
            array(
                'id' => 1,
                'name' => 'Crédito',
                'symbol' => 'C',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ),
            array(
                'id' => 2,
                'name' => 'Débito',
                'symbol' => 'D',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ),
            array(
                'id' => 3,
                'name' => 'Estorno',
                'symbol' => 'E',
                'status' => 1,
                'created_at' => date("Y-m-d H:i:s")
            ),
        ]);
    }
}
