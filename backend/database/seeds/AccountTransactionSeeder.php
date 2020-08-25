<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AccountTransaction;

class AccountTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_transactions')->insert([
            array('user_id' => 1, 'operation_id' => 1, 'value' => 1000.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 1, 'operation_id' => 1, 'value' => 500.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 1, 'operation_id' => 2, 'value' => 150.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 1, 'operation_id' => 2, 'value' => 500.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 2, 'operation_id' => 1, 'value' => 500.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 2, 'operation_id' => 2, 'value' => 750.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 2, 'operation_id' => 2, 'value' => 599.99, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 3, 'operation_id' => 2, 'value' => 50.01, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 3, 'operation_id' => 2, 'value' => 321.45, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 3, 'operation_id' => 2, 'value' => 525.25, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 3, 'operation_id' => 1, 'value' => 300.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 4, 'operation_id' => 1, 'value' => 150.75, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 4, 'operation_id' => 3, 'value' => -50.25, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 4, 'operation_id' => 3, 'value' => 10.10, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 5, 'operation_id' => 1, 'value' => 12530.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 5, 'operation_id' => 2, 'value' => 5426.20, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 5, 'operation_id' => 2, 'value' => 1230.10, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 5, 'operation_id' => 3, 'value' => -25.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 6, 'operation_id' => 1, 'value' => 800.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 6, 'operation_id' => 1, 'value' => 200.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 1, 'value' => 50.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 1, 'value' => 150.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 1, 'value' => 300.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 1, 'value' => 400.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 1, 'value' => 100.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 2, 'value' => 10000.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 2, 'value' => 1500.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 2, 'value' => 25230.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 2, 'value' => 4510.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 2, 'value' => 1310.00, 'created_at' => date("Y-m-d H:i:s")),
            array('user_id' => 7, 'operation_id' => 1, 'value' => 12000.00, 'created_at' => date("Y-m-d H:i:s")),
        ]);
    }
}
