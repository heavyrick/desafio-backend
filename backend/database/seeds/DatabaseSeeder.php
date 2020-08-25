<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = [ // Tabelas a serem truncadas
        'users',
        'operations',
        'account_transactions',
        'oauth_access_tokens'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard(); // Desabilita as restrições de 'mass assign'
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desabilita as chaves estrangeiras

        foreach ($this->toTruncate as $table) { // Limpa as tabelas antes de uma nova inserção
            DB::table($table)->truncate();
        }

        $this->call([
            UserSeeder::class,
            OperationSeeder::class,
            AccountTransactionSeeder::class
        ]);

        //DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Habilita as chaves estrangeiras
        Model::reguard(); // Reabilita as restrições de 'mass assign'
    }
}
