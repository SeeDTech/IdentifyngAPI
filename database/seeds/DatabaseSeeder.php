<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class)->create([
            'email' => 'admin@identify.com',
            'is_admin' => true,
        ]);
        $this->call(LaratrustSeeder::class);
    }
}
