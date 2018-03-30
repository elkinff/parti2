<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder{
    
    public function run(){
        User::create(['nombre' => "Admin", 'email' => "hola@parti2.com", 'password' => '$2b$10$kgMs0v5UVtLzH88nAJ3LiOSIKMfH7LHOIZvPp/IpJTowBQbovAjey', 'validado' => 1, 'tipo' => 1]);
    }
}
