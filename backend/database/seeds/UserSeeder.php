<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 50)->create();

        DB::table('users')->insert([
            'name' => 'Friedrich',
            'last_name' => 'Nietzsche',
            'email' => 'fwniti@email.com',
            'birthday' => '1844-10-15',
            'account_balance' => 1000.00,
            'status' => 1,
            'password' => '$2y$10$1Eo91um9gkB0zLo8b2QntOslSDAOjiExztOmIaM7I4M6ttH6NtTvy', // 123456
            'remember_token' => Str::random(10),
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
