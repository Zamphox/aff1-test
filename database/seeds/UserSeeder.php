<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    protected $numberOfSeeds = 10;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $insert = [
            [
                'name' => 'Mike',
                'email' => 'zamphox@gmail.com',
                'timezone' => 'Europe/Kiev',
                'email_verified_at' => now(),
                'agrees_to_newsletter' => 1,
                'password' => Str::random(20),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        for ($i = 0; $i < $this->numberOfSeeds; $i++){
            $insert[] = [
                'name' => Str::random(5),
                'email' => Str::random(5) . '@gmail.com',
                'timezone' => 'GMT',
                'email_verified_at' => null,
                'agrees_to_newsletter' => 0,
                'password' => \Illuminate\Support\Str::random(20),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        \Illuminate\Support\Facades\DB::table('users')->insert($insert);
    }
}
